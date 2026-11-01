<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Helpers\ImageOptimizer;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\BaseFileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\DateTimePicker;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationGroup = 'Konten & Informasi';

    protected static ?string $navigationLabel = 'Artikel & Tips Wisata';

    protected static ?string $modelLabel = 'Artikel';

    protected static ?string $pluralModelLabel = 'Artikel & Tips Wisata';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Konten Berita')
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul Berita')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                        TextInput::make('slug')
                            ->label('URL Slug')
                            ->required()
                            ->unique(ignoreRecord: true),
                        TextInput::make('category_name')
                            ->label('Kategori Berita')
                            ->placeholder('Ketik kategori sendiri (contoh: Tips Wisata, Edukasi, Promo, Event)')
                            ->maxLength(100)
                            ->afterStateHydrated(function ($component, $record) {
                                if ($record && empty($component->getState())) {
                                    $component->state($record->category_name ?: $record->category?->name);
                                }
                            }),
                        Textarea::make('excerpt')
                            ->label('Ringkasan / Excerpt')
                            ->rows(3),
                        RichEditor::make('content')
                            ->label('Isi Lengkap Berita')
                            ->required()
                            ->columnSpanFull(),
                    ]),

                Section::make('Pengaturan Publikasi & Media')
                    ->schema([
                        Grid::make(2)->schema([
                            FileUpload::make('cover_image')
                                ->label('Gambar Sampul Utama (Cover)')
                                ->image()
                                ->directory('posts')
                                ->maxSize(51200)
                                ->helperText('Maksimal ukuran berkas hingga 50 MB (mendukung foto 10-25 MB). Foto otomatis dikompresi tanpa mengurangi resolusi aslinya.')
                                ->imageEditor()
                                ->saveUploadedFileUsing(function (BaseFileUpload $component, TemporaryUploadedFile $file) {
                                    $storeMethod = $component->getVisibility() === 'public' ? 'storePubliclyAs' : 'storeAs';
                                    $path = $file->{$storeMethod}(
                                        $component->getDirectory(),
                                        $component->getUploadedFileNameForStorage($file),
                                        $component->getDiskName()
                                    );

                                    $fullPath = $component->getDisk()->path($path);
                                    ImageOptimizer::compress($fullPath);

                                    return $path;
                                }),
                            Grid::make(1)->schema([
                                TextInput::make('author')
                                    ->label('Penulis')
                                    ->default('Admin Nirwana'),
                                Toggle::make('is_featured')
                                    ->label('Berita Unggulan (Tampil di Beranda)')
                                    ->helperText('Jika aktif maka berita tampil di Beranda. Jika tidak aktif maka tampil di Halaman Berita.')
                                    ->default(false),
                                Toggle::make('is_published')
                                    ->label('Terbitkan Berita')
                                    ->default(true),
                                DateTimePicker::make('published_at')
                                    ->label('Tanggal Publikasi')
                                    ->default(now()),
                            ]),
                            FileUpload::make('gallery_images')
                                ->label('Foto Dokumentasi Tambahan (Opsional)')
                                ->multiple()
                                ->reorderable()
                                ->image()
                                ->directory('posts/gallery')
                                ->maxSize(51200)
                                ->maxFiles(8)
                                ->columnSpanFull()
                                ->helperText('Kosongkan jika hanya ingin menampilkan 1 foto sampul. Unggah beberapa foto hanya jika Anda ingin menampilkan galeri foto pendukung di dalam artikel.')
                                ->saveUploadedFileUsing(function (BaseFileUpload $component, TemporaryUploadedFile $file) {
                                    $storeMethod = $component->getVisibility() === 'public' ? 'storePubliclyAs' : 'storeAs';
                                    $path = $file->{$storeMethod}(
                                        $component->getDirectory(),
                                        $component->getUploadedFileNameForStorage($file),
                                        $component->getDiskName()
                                    );

                                    $fullPath = $component->getDisk()->path($path);
                                    ImageOptimizer::compress($fullPath);

                                    return $path;
                                }),
                        ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('cover_image')
                    ->label('Cover')
                    ->circular(),
                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                TextColumn::make('category_name')
                    ->label('Kategori')
                    ->getStateUsing(fn ($record) => $record->category_name ?: ($record->category->name ?? '-'))
                    ->badge(),
                ToggleColumn::make('is_featured')
                    ->label('Unggulan Beranda')
                    ->sortable(),
                TextColumn::make('author')
                    ->label('Penulis'),
                IconColumn::make('is_published')
                    ->label('Terbit')
                    ->boolean()
                    ->sortable(),
                TextColumn::make('published_at')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),
            ])
            ->defaultSort('published_at', 'desc')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}

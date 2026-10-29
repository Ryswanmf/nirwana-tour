<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
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
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\DateTimePicker;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationGroup = 'Publikasi & Konten';

    protected static ?string $navigationLabel = 'Berita';

    protected static ?string $modelLabel = 'Berita';

    protected static ?string $pluralModelLabel = 'Berita';

    protected static ?int $navigationSort = 1;

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
                        Select::make('category_id')
                            ->label('Kategori')
                            ->relationship('category', 'name', fn ($query) => $query->where('type', 'article'))
                            ->searchable()
                            ->preload(),
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
                                ->label('Gambar Sampul (Cover)')
                                ->image()
                                ->directory('posts'),
                            Grid::make(1)->schema([
                                TextInput::make('author')
                                    ->label('Penulis')
                                    ->default('Admin Nirwana'),
                                Toggle::make('is_published')
                                    ->label('Terbitkan Berita')
                                    ->default(true),
                                DateTimePicker::make('published_at')
                                    ->label('Tanggal Publikasi')
                                    ->default(now()),
                            ]),
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
                TextColumn::make('category.name')
                    ->label('Kategori')
                    ->badge(),
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

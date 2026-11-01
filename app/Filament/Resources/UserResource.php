<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-shield-check';

    protected static ?string $navigationGroup = 'Profil & Pengaturan';

    protected static ?string $navigationLabel = 'Kelola Administrator';

    protected static ?string $modelLabel = 'Pengguna Administrator';

    protected static ?string $pluralModelLabel = 'Pengguna Administrator';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Akun Administrator')
                    ->description('Kelola detail profil dan kredensial autentikasi pengguna.')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('name')
                                ->label('Nama Lengkap')
                                ->required()
                                ->maxLength(255)
                                ->placeholder('Contoh: Admin Operasional'),
                            TextInput::make('email')
                                ->label('Alamat Email')
                                ->email()
                                ->required()
                                ->unique(ignoreRecord: true)
                                ->maxLength(255)
                                ->placeholder('admin@nirwanatour.com'),
                        ]),
                        Grid::make(2)->schema([
                            TextInput::make('password')
                                ->label('Kata Sandi')
                                ->password()
                                ->revealable()
                                ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                                ->dehydrated(fn ($state) => filled($state))
                                ->required(fn (string $context): bool => $context === 'create')
                                ->confirmed()
                                ->helperText(fn (string $context): string => $context === 'edit' 
                                    ? 'Kosongkan jika tidak ingin mengubah kata sandi saat ini.' 
                                    : 'Gunakan minimal 8 karakter kombinasi huruf dan angka.'),
                            TextInput::make('password_confirmation')
                                ->label('Konfirmasi Kata Sandi')
                                ->password()
                                ->revealable()
                                ->required(fn (string $context): bool => $context === 'create')
                                ->dehydrated(false),
                        ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Pengguna')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('email')
                    ->label('Alamat Email')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->copyMessage('Alamat email berhasil disalin'),
                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->label('Terakhir Diperbarui')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn (User $record): bool => $record->id !== auth()->id()),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}

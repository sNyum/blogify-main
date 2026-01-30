<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExternalUserResource\Pages;
use App\Models\ExternalUser;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Grid;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Schemas\Schema;
use BackedEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash; // Add this import

class ExternalUserResource extends Resource
{
    protected static ?string $model = ExternalUser::class;

    protected static ?string $navigationLabel = 'Daftar Pengguna';
    
    protected static ?string $pluralLabel = 'Daftar Pengguna';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-users';

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Nama'),
                
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                
                TextInput::make('organization')
                    ->label('Instansi')
                    ->maxLength(255),
                
                TextInput::make('password')
                    ->password()
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $context): bool => $context === 'create')
                    ->label('Password'),

                Toggle::make('is_active')
                    ->label('Status Aktif')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')
                    ->label('No')
                    ->rowIndex(),
                
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('Nama'),
                
                // Kolom "User" (username) - kita ambil dari bagian depan email jika tidak ada username
                TextColumn::make('user_display')
                    ->label('User')
                    ->state(function (ExternalUser $record): string {
                        return explode('@', $record->email)[0];
                    }),
                
                TextColumn::make('organization')
                    ->label('Instansi')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->searchable()
                    ->label('Email'),

                // Kolom Akses (Hardcoded 1 sesuai gambar)
                TextColumn::make('role_display')
                    ->label('Akses')
                    ->default('1'),

                // Kolom Status (Kita pakai is_active tapi tampilkan sebagai angka/status)
                IconColumn::make('is_active')
                    ->boolean()
                    ->label('Status')
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle'),
            ])
            ->filters([
                //
            ])
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExternalUsers::route('/'),
            'create' => Pages\CreateExternalUser::route('/create'),
            'edit' => Pages\EditExternalUser::route('/{record}/edit'),
        ];
    }
}

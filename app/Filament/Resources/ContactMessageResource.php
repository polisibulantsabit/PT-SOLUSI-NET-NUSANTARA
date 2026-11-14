<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactMessageResource\Pages;
use App\Models\ContactMessage;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContactMessageResource extends Resource
{
    protected static ?string $model = ContactMessage::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-envelope';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationLabel = 'Pesan Masuk';

    protected static ?string $modelLabel = 'Pesan Masuk';

    protected static ?string $pluralModelLabel = 'Pesan Masuk';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable()
                    ->description(fn (ContactMessage $record): string => $record->email),
                TextColumn::make('subject')
                    ->label('Subjek')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('message')
                    ->label('Pesan')
                    ->limit(70)
                    ->wrap(),
                TextColumn::make('created_at')
                    ->label('Diterima')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->actions([
                ViewAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Detail Pesan')
                    ->schema([
                        TextEntry::make('name')->label('Nama'),
                        TextEntry::make('email')->label('Email'),
                        TextEntry::make('subject')->label('Subjek')->columnSpanFull(),
                        TextEntry::make('message')->label('Isi Pesan')->columnSpanFull(),
                        TextEntry::make('created_at')->label('Diterima')->dateTime('d M Y H:i'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactMessages::route('/'),
            'view' => Pages\ViewContactMessage::route('/{record}'),
        ];
    }
}

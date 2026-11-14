<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryResource\Pages;
use App\Models\Gallery;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class GalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-photo';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationLabel = 'Galeri';

    protected static ?string $modelLabel = 'Galeri';

    protected static ?string $pluralModelLabel = 'Galeri';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('title')
                    ->label('Judul Dokumentasi')
                    ->required()
                    ->maxLength(255),

                Select::make('category')
                    ->label('Kategori')
                    ->options([
                        'instalasi' => 'Instalasi',
                        'jaringan' => 'Jaringan',
                        'tim' => 'Tim',
                        'acara' => 'Acara',
                        'kantor' => 'Kantor',
                    ])
                    ->default('instalasi')
                    ->searchable()
                    ->preload(),

                FileUpload::make('image')
                    ->label('Gambar')
                    ->directory('galleries')
                    ->disk('public')
                    ->image()
                    ->visibility('public')
                    ->imageEditor()
                    ->maxSize(2048)
                    ->required(),

                Textarea::make('description')
                    ->label('Deskripsi')
                    ->rows(3)
                    ->maxLength(1000),

                TextInput::make('sort_order')
                    ->label('Urutan')
                    ->numeric()
                    ->default(0)
                    ->minValue(0),

                Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true),
            ])
            ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Gambar')
                    ->disk('public')
                    ->square()
                    ->height(56),

                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->description(fn (Gallery $record): string => $record->description ? \Illuminate\Support\Str::limit($record->description, 70) : ''),

                TextColumn::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->color('info')
                    ->sortable(),

                TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->label('Kategori')
                    ->options([
                        'instalasi' => 'Instalasi',
                        'jaringan' => 'Jaringan',
                        'tim' => 'Tim',
                        'acara' => 'Acara',
                        'kantor' => 'Kantor',
                    ]),

                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->placeholder('Semua status')
                    ->trueLabel('Aktif')
                    ->falseLabel('Nonaktif'),
            ])
            ->defaultSort('sort_order')
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ])
            ->emptyStateActions([
                CreateAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGalleries::route('/'),
            'create' => Pages\CreateGallery::route('/create'),
            'edit' => Pages\EditGallery::route('/{record}/edit'),
        ];
    }
}

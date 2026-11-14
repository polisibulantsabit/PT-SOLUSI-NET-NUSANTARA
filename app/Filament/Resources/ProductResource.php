<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
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

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-server-stack';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Produk';

    protected static ?string $modelLabel = 'Produk';

    protected static ?string $pluralModelLabel = 'Produk';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('name')
                    ->label('Nama Produk')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $state, $set) => $set('slug', \Illuminate\Support\Str::slug($state))),

                TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),

                TextInput::make('price')
                    ->label('Harga (Rp)')
                    ->numeric()
                    ->required()
                    ->minValue(0)
                    ->prefix('Rp'),

                TextInput::make('speed')
                    ->label('Kecepatan')
                    ->placeholder('cth: hingga 100 Mbps')
                    ->maxLength(255),

                Textarea::make('description')
                    ->label('Deskripsi')
                    ->rows(4)
                    ->maxLength(2000),

                Textarea::make('features')
                    ->label('Fitur (satu per baris)')
                    ->rows(5)
                    ->helperText('Isi fitur paket, satu baris per fitur')
                    ->maxLength(3000),

                FileUpload::make('image')
                    ->label('Gambar Produk')
                    ->directory('products')
                    ->disk('public')
                    ->image()
                    ->visibility('public')
                    ->imageEditor()
                    ->maxSize(2048),

                Toggle::make('is_featured')
                    ->label('Tampilkan di Home')
                    ->default(false),

                Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true),

                TextInput::make('sort_order')
                    ->label('Urutan')
                    ->numeric()
                    ->default(0)
                    ->minValue(0),
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
                    ->height(48),

                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable()
                    ->description(fn (Product $record): string => $record->speed),

                TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR', locale: 'id_ID')
                    ->sortable(),

                TextColumn::make('category')
                    ->label('Kategori')
                    ->state(fn (Product $record): string => $record->is_featured ? 'Unggulan' : 'Reguler')
                    ->badge()
                    ->color(fn (Product $record): string => $record->is_featured ? 'info' : 'gray'),

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
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status Aktif')
                    ->boolean()
                    ->placeholder('Semua status')
                    ->trueLabel('Aktif')
                    ->falseLabel('Nonaktif'),

                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Unggulan')
                    ->boolean()
                    ->placeholder('Semua')
                    ->trueLabel('Ya')
                    ->falseLabel('Tidak'),
            ])
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}

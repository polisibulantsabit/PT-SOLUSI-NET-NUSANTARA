<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubscriptionResource\Pages;
use App\Models\Subscription;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;

class SubscriptionResource extends Resource
{
    protected static ?string $model = Subscription::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Pengajuan Langganan';

    protected static ?string $modelLabel = 'Pengajuan Langganan';

    protected static ?string $pluralModelLabel = 'Pengajuan Langganan';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Data Pengajuan')
                    ->schema([
                        TextInput::make('full_name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('phone')
                            ->label('No. HP / WA')
                            ->required()
                            ->maxLength(30),
                        Select::make('product_id')
                            ->label('Paket Langganan')
                            ->relationship('product', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Select::make('status')
                            ->label('Status Pengajuan')
                            ->options(self::statusOptions())
                            ->required()
                            ->native(false),
                        Textarea::make('address')
                            ->label('Alamat Instalasi')
                            ->rows(4)
                            ->required()
                            ->columnSpanFull(),
                        Placeholder::make('payment_proof_preview')
                            ->label('Bukti Pembayaran')
                            ->content(fn (?Subscription $record): HtmlString => new HtmlString(
                                $record?->payment_proof_path
                                    ? '<img src="'.e(asset('storage/'.$record->payment_proof_path)).'" alt="Bukti Pembayaran" style="max-width: 320px; max-height: 320px; border-radius: 12px; object-fit: contain;">'
                                    : '<span>-</span>'
                            ))
                            ->columnSpanFull(),

                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('full_name')
                    ->label('Pelanggan')
                    ->searchable()
                    ->sortable()
                    ->description(fn (Subscription $record): string => $record->phone),
                TextColumn::make('product.name')
                    ->label('Paket')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('address')
                    ->label('Alamat Instalasi')
                    ->limit(45)
                    ->toggleable(),
                ImageColumn::make('payment_proof_path')
                    ->label('Bukti Pembayaran')
                    ->disk('public')
                    ->height(70)
                    ->width(70)
                    ->extraImgAttributes(['class' => 'object-cover rounded-lg']),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => self::statusOptions()[$state] ?? ucfirst($state))
                    ->color(fn (string $state): string => match ($state) {
                        'approved' => 'success',
                        'process' => 'warning',
                        'rejected' => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Diajukan')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options(self::statusOptions()),
                Tables\Filters\SelectFilter::make('product_id')
                    ->label('Paket')
                    ->relationship('product', 'name')
                    ->searchable()
                    ->preload(),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
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
                Section::make('Data Pengajuan')
                    ->schema([
                        TextEntry::make('full_name')->label('Nama Lengkap'),
                        TextEntry::make('phone')->label('No. HP / WA'),
                        TextEntry::make('product.name')->label('Paket Langganan'),
                        TextEntry::make('status')
                            ->label('Status')
                            ->badge()
                            ->formatStateUsing(fn (string $state): string => self::statusOptions()[$state] ?? ucfirst($state)),
                        TextEntry::make('address')->label('Alamat Instalasi')->columnSpanFull(),
                        // TextEntry::make('notes')->label('Catatan Pelanggan')->placeholder('-')->columnSpanFull(),
                        TextEntry::make('payment_proof_path')
                            ->label('Bukti Pembayaran')
                            ->formatStateUsing(fn (?string $state): HtmlString => new HtmlString(
                                $state
                                    ? '<a href="'.e(asset('storage/'.ltrim($state, '/'))).'" target="_blank" rel="noopener noreferrer"><img src="'.e(asset('storage/'.ltrim($state, '/'))).'" alt="Bukti Pembayaran" style="max-width: 480px; max-height: 480px; border-radius: 12px; object-fit: contain;"></a>'
                                    : '<span>-</span>'
                            ))
                            ->html()
                            ->columnSpanFull(),
                        TextEntry::make('created_at')->label('Diajukan')->dateTime('d M Y H:i'),
                        TextEntry::make('updated_at')->label('Terakhir Diperbarui')->dateTime('d M Y H:i'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function statusOptions(): array
    {
        return [
            'pending' => 'Menunggu',
            'process' => 'Diproses',
            'approved' => 'Disetujui',
            'rejected' => 'Ditolak',
            'menuju ke lokasi' => 'Menuju ke Lokasi',
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSubscriptions::route('/'),
            'view' => Pages\ViewSubscription::route('/{record}'),
            'edit' => Pages\EditSubscription::route('/{record}/edit'),
        ];
    }
}

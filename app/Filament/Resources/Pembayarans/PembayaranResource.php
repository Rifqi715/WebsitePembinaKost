<?php

namespace App\Filament\Resources\Pembayarans;

use App\Filament\Resources\Pembayarans\Pages\CreatePembayaran;
use App\Filament\Resources\Pembayarans\Pages\EditPembayaran;
use App\Filament\Resources\Pembayarans\Pages\ListPembayarans;
use App\Models\Pembayaran;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables\Table;
// Komponen input
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
// --- 1. SEKTOR IMPORT: Ditambahkan di sini agar class Action bisa dibaca ---
use Filament\Actions\Action;

class PembayaranResource extends Resource
{
    protected static ?string $model = Pembayaran::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-credit-card';

    public static function form(Schema $schema): Schema 
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label('Nama Penghuni')
                    ->relationship('user', 'name')
                    ->required(),
                Select::make('room_id')
                    ->label('Kamar')
                    ->relationship('room', 'nomor_kamar')
                    ->required(),
                TextInput::make('jumlah_bayar')
                    ->label('Jumlah Bayar')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),
                Select::make('status')
                    ->label('Status Pembayaran')
                    ->options([
                        'pending' => 'Pending',
                        'lunas' => 'Lunas',
                        'gagal' => 'Gagal',
                    ])
                    ->required(),
                FileUpload::make('bukti_bayar')
                    ->label('Bukti Pembayaran')
                    ->directory('bukti_pembayaran')
                    ->image()
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('user.name')
                    ->label('Nama Penghuni'),
                \Filament\Tables\Columns\TextColumn::make('jumlah_bayar')
                    ->label('Jumlah Bayar'),
                \Filament\Tables\Columns\TextColumn::make('status')
                    ->label('Status'),
            ])
            // --- 2. SEKTOR ACTIONS: Diperbarui dengan type-hinting (Pembayaran $record) agar tidak error 500 ---
            ->actions([
                Action::make('terima')
                    ->label('Terima')
                    ->color('success')
                    ->icon('heroicon-o-check-circle')
                    ->requiresConfirmation()
                    ->action(fn (Pembayaran $record) => $record->update(['status' => 'lunas'])),
                    
                Action::make('tolak')
                    ->label('Tolak')
                    ->color('danger')
                    ->icon('heroicon-o-x-circle')
                    ->requiresConfirmation()
                    ->action(fn (Pembayaran $record) => $record->update(['status' => 'ditolak'])),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPembayarans::route('/'),
            'create' => CreatePembayaran::route('/create'),
            'edit' => EditPembayaran::route('/{record}/edit'),
        ];
    }
}
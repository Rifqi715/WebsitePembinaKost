<?php

namespace App\Filament\Resources\Rooms\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class RoomForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nomor_kamar')
                    ->required(),
                Textarea::make('fasilitas')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('harga')
                    ->required()
                    ->numeric(),
                Select::make('status')
                    ->options(['tersedia' => 'Tersedia', 'terisi' => 'Terisi'])
                    ->default('tersedia')
                    ->required(),
            ]);
    }
}

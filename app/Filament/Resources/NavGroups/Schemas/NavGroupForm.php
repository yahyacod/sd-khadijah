<?php

namespace App\Filament\Resources\NavGroups\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class NavGroupForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Grup Menu')
                    ->description('Grup ini akan muncul sebagai dropdown di menu navigasi web. Halaman ditempelkan ke grup ini lewat form Halaman (field "Grup Menu").')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama grup')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: Kurikulum'),

                        TextInput::make('sort_order')
                            ->label('Urutan tampil di menu')
                            ->numeric()
                            ->default(0)
                            ->helperText('Angka lebih kecil tampil lebih kiri/dulu.'),
                    ]),

                Section::make('Link Tambahan (opsional)')
                    ->description('Kalau grup ini butuh 1 link tambahan di paling bawah dropdown yang BUKAN halaman biasa — misal link eksternal atau ke halaman Berita.')
                    ->schema([
                        TextInput::make('extra_link_label')
                            ->label('Teks link')
                            ->placeholder('Contoh: Daftar Online'),

                        TextInput::make('extra_link_url')
                            ->label('URL')
                            ->placeholder('Contoh: https://khareg.netlify.app atau /berita'),
                    ]),
            ]);
    }
}

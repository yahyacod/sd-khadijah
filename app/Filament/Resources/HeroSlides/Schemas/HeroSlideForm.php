<?php

namespace App\Filament\Resources\HeroSlides\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class HeroSlideForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Slide')
                    ->schema([
                        FileUpload::make('image')
                            ->label('Foto')
                            ->image()
                            ->required()
                            ->disk('public')
                            ->directory('hero-slides')
                            ->imageEditor()
                            ->imageEditorAspectRatios(['16:9'])
                            ->maxSize(4096)
                            ->helperText('Rasio 16:9 disarankan biar pas di background beranda. Bisa crop langsung setelah upload.'),

                        TextInput::make('caption')
                            ->label('Keterangan (opsional)')
                            ->maxLength(255)
                            ->helperText('Tidak tampil di layar, cuma buat catatan internal.'),

                        TextInput::make('sort_order')
                            ->label('Urutan tampil')
                            ->numeric()
                            ->default(0)
                            ->helperText('Angka lebih kecil tampil lebih dulu.'),

                        Toggle::make('is_active')
                            ->label('Aktif (tampil di beranda)')
                            ->default(true),
                    ]),
            ]);
    }
}

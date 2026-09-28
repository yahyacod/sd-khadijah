<?php

namespace App\Filament\Resources\Pages\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ViewField;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(['default' => 1, 'xl' => 3])
                    ->schema([
                        Group::make([
                            Section::make('Konten Halaman')
                                ->description('Isi judul dan teks utama yang akan dibaca pengunjung.')
                                ->schema([
                                    TextInput::make('title')
                                        ->label('Judul halaman')
                                        ->required()
                                        ->maxLength(255)
                                        ->live(debounce: 500)
                                        ->afterStateUpdated(function (string $state, Set $set, ?string $old, Get $get): void {
                                            if (blank($get('slug')) || $get('slug') === Str::slug($old)) {
                                                $set('slug', Str::slug($state));
                                            }
                                        }),

                                    TextInput::make('slug')
                                        ->label('Alamat halaman')
                                        ->required()
                                        ->unique(ignoreRecord: true)
                                        ->maxLength(255)
                                        ->prefix('/')
                                        ->helperText('Bagian alamat web setelah nama domain.'),

                                    TextInput::make('subtitle')
                                        ->label('Kalimat pengantar')
                                        ->maxLength(255)
                                        ->live(debounce: 500)
                                        ->helperText('Ditampilkan di bawah judul pada bagian atas halaman.'),

                                    FileUpload::make('featured_image')
                                        ->label('Foto utama halaman')
                                        ->image()
                                        ->disk('public')
                                        ->directory('pages')
                                        ->imageEditor()
                                        ->maxSize(4096)
                                        ->live()
                                        ->helperText('Foto ini tampil di area utama halaman. Anda bisa memotongnya setelah memilih file.'),

                                    RichEditor::make('body')
                                        ->label('Isi halaman')
                                        ->toolbarButtons([
                                            ['bold', 'italic', 'underline', 'strike', 'link'],
                                            ['h2', 'h3', 'blockquote'],
                                            ['alignStart', 'alignCenter', 'alignEnd'],
                                            ['bulletList', 'orderedList'],
                                            ['attachFiles'],
                                            ['undo', 'redo'],
                                        ])
                                        ->resizableImages()
                                        ->fileAttachmentsDisk('public')
                                        ->fileAttachmentsDirectory('pages/attachments')
                                        ->live(debounce: 1000)
                                        ->helperText('Gunakan judul, paragraf, daftar, dan foto untuk menyusun isi. Pratinjau di samping mengikuti perubahan Anda.'),
                                ]),

                            Section::make('Tampilan dan tombol')
                                ->schema([
                                    Select::make('template')
                                        ->label('Jenis halaman')
                                        ->options([
                                            'default' => 'Halaman biasa',
                                            'admissions' => 'SPMB (dengan tombol ajakan)',
                                        ])
                                        ->default('default')
                                        ->live()
                                        ->required()
                                        ->helperText('Pilih jenis SPMB untuk menambahkan tombol pendaftaran.'),

                                    TextInput::make('cta_label')
                                        ->label('Teks tombol pendaftaran')
                                        ->placeholder('Contoh: Daftar via WhatsApp')
                                        ->visible(fn (Get $get): bool => $get('template') === 'admissions'),

                                    TextInput::make('cta_url')
                                        ->label('Alamat tujuan tombol')
                                        ->placeholder('https://wa.me/62812xxxxxxx')
                                        ->url()
                                        ->visible(fn (Get $get): bool => $get('template') === 'admissions'),

                                    TextInput::make('video_url')
                                        ->label('Tautan video YouTube (opsional)')
                                        ->placeholder('https://www.youtube.com/watch?v=...')
                                        ->url()
                                        ->helperText('Jika tautan dan file video diisi, tautan YouTube yang akan digunakan.'),

                                    FileUpload::make('video_file')
                                        ->label('Atau unggah video')
                                        ->disk('public')
                                        ->directory('pages/videos')
                                        ->acceptedFileTypes(['video/mp4', 'video/webm'])
                                        ->maxSize(102400)
                                        ->helperText('Gunakan video MP4 atau WebM yang sudah dikompres.'),
                                ])
                                ->columns(2),

                            Section::make('Menu situs')
                                ->description('Atur lokasi halaman pada navigasi situs. Biarkan grup kosong jika halaman tidak perlu tampil di menu.')
                                ->schema([
                                    Select::make('nav_group_id')
                                        ->label('Grup menu')
                                        ->relationship('navGroup', 'name')
                                        ->searchable()
                                        ->preload()
                                        ->placeholder('Tidak ditampilkan di menu')
                                        ->native(false),

                                    Select::make('parent_id')
                                        ->label('Halaman induk (opsional)')
                                        ->relationship(
                                            name: 'parent',
                                            titleAttribute: 'title',
                                            modifyQueryUsing: fn ($query, $record) => $record ? $query->whereKeyNot($record->id) : $query,
                                        )
                                        ->searchable()
                                        ->preload()
                                        ->placeholder('Halaman utama')
                                        ->native(false),

                                    TextInput::make('menu_order')
                                        ->label('Urutan menu')
                                        ->numeric()
                                        ->default(0)
                                        ->helperText('Angka lebih kecil muncul lebih dahulu.'),

                                    TagsInput::make('nav_preview_items')
                                        ->label('Teks tambahan di menu (opsional)')
                                        ->placeholder('Ketik teks lalu tekan Enter')
                                        ->helperText('Teks ini hanya sebagai keterangan. Gunakan halaman induk jika setiap item perlu punya tautan sendiri.'),
                                ])
                                ->columns(2),

                            Section::make('Publikasi')
                                ->schema([
                                    Select::make('status')
                                        ->label('Status halaman')
                                        ->options([
                                            'draft' => 'Draft — hanya terlihat di admin',
                                            'publish' => 'Terbit — terlihat oleh pengunjung',
                                        ])
                                        ->default('draft')
                                        ->required(),
                                ]),
                        ])->columnSpan(['default' => 'full', 'xl' => 2]),

                        Section::make('Pratinjau langsung')
                            ->description('Perubahan terlihat di sini sebelum disimpan.')
                            ->schema([
                                ViewField::make('live_preview')
                                    ->label('')
                                    ->view('filament.forms.components.content-preview', fn (Get $get): array => [
                                        'contentType' => 'Halaman',
                                        'title' => $get('title'),
                                        'subtitle' => $get('subtitle'),
                                        'imageUrl' => filled($get('featured_image')) && is_string($get('featured_image'))
                                            ? Storage::disk('public')->url($get('featured_image'))
                                            : null,
                                        'body' => $get('body'),
                                        'slug' => $get('slug'),
                                        'status' => $get('status'),
                                        'template' => $get('template'),
                                        'ctaLabel' => $get('cta_label'),
                                    ])
                                    ->dehydrated(false),
                            ])
                            ->columnSpan(['default' => 'full', 'xl' => 1]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}

<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ViewField;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(['default' => 1, 'xl' => 3])
                    ->schema([
                        Group::make([
                            Section::make('Isi berita')
                                ->description('Tulis judul, ringkasan, dan isi yang akan dibaca pengunjung.')
                                ->schema([
                                    TextInput::make('title')
                                        ->label('Judul berita')
                                        ->required()
                                        ->maxLength(255)
                                        ->live(debounce: 500)
                                        ->afterStateUpdated(function (string $state, Set $set, ?string $old, Get $get): void {
                                            if (blank($get('slug')) || $get('slug') === Str::slug($old)) {
                                                $set('slug', Str::slug($state));
                                            }
                                        }),

                                    TextInput::make('slug')
                                        ->label('Alamat berita')
                                        ->required()
                                        ->unique(ignoreRecord: true)
                                        ->maxLength(255)
                                        ->prefix('/berita/')
                                        ->helperText('Alamat dibuat dari judul dan dapat disunting.'),

                                    TextInput::make('subtitle')
                                        ->label('Ringkasan singkat')
                                        ->maxLength(255)
                                        ->live(debounce: 500)
                                        ->helperText('Tampil sebagai pengantar berita.'),

                                    DateTimePicker::make('published_at')
                                        ->label('Tanggal terbit')
                                        ->default(now()),

                                    FileUpload::make('featured_image')
                                        ->label('Foto utama berita')
                                        ->image()
                                        ->disk('public')
                                        ->directory('posts')
                                        ->imageEditor()
                                        ->maxSize(4096)
                                        ->live()
                                        ->helperText('Foto ini menjadi gambar utama kartu berita dan bagian atas artikel.'),

                                    RichEditor::make('body')
                                        ->label('Isi berita')
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
                                        ->fileAttachmentsDirectory('posts/attachments')
                                        ->live(debounce: 1000)
                                        ->helperText('Pratinjau di samping mengikuti perubahan judul, foto, ringkasan, dan isi.'),
                                ]),
                        ])->columnSpan(['default' => 'full', 'xl' => 2]),

                        Group::make([
                            Section::make('Pratinjau langsung')
                                ->description('Perubahan terlihat di sini sebelum disimpan.')
                                ->schema([
                                    ViewField::make('live_preview')
                                        ->label('')
                                        ->view('filament.forms.components.content-preview', fn (Get $get): array => [
                                            'contentType' => 'Berita',
                                            'title' => $get('title'),
                                            'subtitle' => $get('subtitle'),
                                            'imageUrl' => filled($get('featured_image')) && is_string($get('featured_image'))
                                                ? Storage::disk('public')->url($get('featured_image'))
                                                : null,
                                            'body' => $get('body'),
                                            'slug' => $get('slug'),
                                            'status' => $get('status'),
                                            'template' => null,
                                            'ctaLabel' => null,
                                        ])
                                        ->dehydrated(false),
                                ]),

                            Section::make('Publikasi')
                                ->schema([
                                    Select::make('status')
                                        ->label('Status berita')
                                        ->options([
                                            'draft' => 'Draft — hanya terlihat di admin',
                                            'publish' => 'Terbit — terlihat oleh pengunjung',
                                        ])
                                        ->default('draft')
                                        ->required(),

                                    Toggle::make('is_featured_home')
                                        ->label('Tampilkan di beranda')
                                        ->helperText('Jika tidak ada berita yang dipilih, beranda menampilkan tiga berita terbaru.')
                                        ->default(false),
                                ]),
                        ])->columnSpan(['default' => 'full', 'xl' => 1]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}

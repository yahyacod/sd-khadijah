<?php

namespace App\Filament\Resources\NavGroups;

use App\Filament\Resources\NavGroups\Pages\CreateNavGroup;
use App\Filament\Resources\NavGroups\Pages\EditNavGroup;
use App\Filament\Resources\NavGroups\Pages\ListNavGroups;
use App\Filament\Resources\NavGroups\Schemas\NavGroupForm;
use App\Filament\Resources\NavGroups\Tables\NavGroupsTable;
use App\Models\NavGroup;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class NavGroupResource extends Resource
{
    protected static ?string $model = NavGroup::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBars3;

    protected static ?string $navigationLabel = 'Grup Navigasi';

    protected static ?string $modelLabel = 'Grup Navigasi';

    protected static string|UnitEnum|null $navigationGroup = 'Pengaturan';

    public static function form(Schema $schema): Schema
    {
        return NavGroupForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return NavGroupsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListNavGroups::route('/'),
            'create' => CreateNavGroup::route('/create'),
            'edit' => EditNavGroup::route('/{record}/edit'),
        ];
    }
}

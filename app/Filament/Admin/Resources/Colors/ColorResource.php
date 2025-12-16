<?php

namespace App\Filament\Admin\Resources\Colors;

use App\Filament\Admin\Resources\Colors\Pages\CreateColor;
use App\Filament\Admin\Resources\Colors\Pages\EditColor;
use App\Filament\Admin\Resources\Colors\Pages\ListColors;
use App\Filament\Admin\Resources\Colors\Schemas\ColorForm;
use App\Filament\Admin\Resources\Colors\Tables\ColorsTable;
use App\Models\Color;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ColorResource extends Resource
{
    protected static ?string $model = Color::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Swatch;
    protected static ?int $navigationSort = 2;
    protected static string|UnitEnum|null $navigationGroup = "Settings";


    public static function canCreate(): bool
    {
        return Color::count() == 0;
    }

    public static function form(Schema $schema): Schema
    {
        return ColorForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ColorsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListColors::route('/'),
            'create' => CreateColor::route('/create'),
            'edit' => EditColor::route('/{record}/edit'),
        ];
    }
}

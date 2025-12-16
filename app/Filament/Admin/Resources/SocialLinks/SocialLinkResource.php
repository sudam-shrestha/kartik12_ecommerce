<?php

namespace App\Filament\Admin\Resources\SocialLinks;

use App\Filament\Admin\Resources\SocialLinks\Pages\CreateSocialLink;
use App\Filament\Admin\Resources\SocialLinks\Pages\EditSocialLink;
use App\Filament\Admin\Resources\SocialLinks\Pages\ListSocialLinks;
use App\Filament\Admin\Resources\SocialLinks\Schemas\SocialLinkForm;
use App\Filament\Admin\Resources\SocialLinks\Tables\SocialLinksTable;
use App\Models\SocialLink;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class SocialLinkResource extends Resource
{
    protected static ?string $model = SocialLink::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::AtSymbol;

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'name';
    protected static string|UnitEnum|null $navigationGroup = "Settings";

    public static function form(Schema $schema): Schema
    {
        return SocialLinkForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SocialLinksTable::configure($table);
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
            'index' => ListSocialLinks::route('/'),
            'create' => CreateSocialLink::route('/create'),
            'edit' => EditSocialLink::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Admin\Resources\Companies;

use App\Filament\Admin\Resources\Companies\Pages\CreateCompany;
use App\Filament\Admin\Resources\Companies\Pages\EditCompany;
use App\Filament\Admin\Resources\Companies\Pages\ListCompanies;
use App\Filament\Admin\Resources\Companies\Schemas\CompanyForm;
use App\Filament\Admin\Resources\Companies\Tables\CompaniesTable;
use App\Models\Company;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::BuildingOffice2;

    protected static ?string $modelLabel = 'Company';
    protected static ?string $pluralModelLabel = 'Company';
    protected static ?int $navigationSort = 1;
    
    protected static string|UnitEnum|null $navigationGroup = "Settings";

    public static function canCreate(): bool
    {
        return Company::count() == 0;
    }

    public static function form(Schema $schema): Schema
    {
        return CompanyForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CompaniesTable::configure($table);
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
            'index' => ListCompanies::route('/'),
            'create' => CreateCompany::route('/create'),
            'edit' => EditCompany::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Admin\Resources\Colors\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ColorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ColorPicker::make('primary')
                    ->required(),
                ColorPicker::make('secondary')
                    ->required(),
                ColorPicker::make('text')
                    ->required(),
                ColorPicker::make('bg')
                    ->required(),
            ]);
    }
}

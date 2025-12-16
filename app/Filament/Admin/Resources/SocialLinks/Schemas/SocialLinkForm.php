<?php

namespace App\Filament\Admin\Resources\SocialLinks\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SocialLinkForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make([
                    TextInput::make('name')
                        ->required(),
                    TextInput::make('icon')
                        ->required(),
                    TextInput::make('link')
                        ->required(),
                ])->columnSpanFull()->columns(2),
            ]);
    }
}

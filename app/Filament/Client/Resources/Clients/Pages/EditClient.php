<?php

namespace App\Filament\Client\Resources\Clients\Pages;

use App\Filament\Client\Resources\Clients\ClientResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;

class EditClient extends EditRecord
{
    protected static string $resource = ClientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // DeleteAction::make(),
            EditAction::make()
                ->schema([
                    TextInput::make('password')
                        ->revealable()
                        ->label("Change Password")
                        ->required(),
                ]),
        ];
    }
}

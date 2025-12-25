<?php

namespace App\Filament\Client\Resources\Orders\Pages;

use App\Filament\Client\Resources\Orders\OrderResource;
use Filament\Resources\Pages\CreateRecord;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;
}

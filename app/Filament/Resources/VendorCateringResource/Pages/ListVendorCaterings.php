<?php

namespace App\Filament\Resources\VendorCateringResource\Pages;

use App\Filament\Resources\VendorCateringResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVendorCaterings extends ListRecords
{
    protected static string $resource = VendorCateringResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

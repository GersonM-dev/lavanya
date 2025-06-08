<?php

namespace App\Filament\Resources\VendorCateringResource\Pages;

use App\Filament\Resources\VendorCateringResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVendorCatering extends EditRecord
{
    protected static string $resource = VendorCateringResource::class;
    public static ?string $title = 'Edit Vendor Catering';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

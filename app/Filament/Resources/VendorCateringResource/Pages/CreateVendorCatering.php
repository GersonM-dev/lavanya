<?php

namespace App\Filament\Resources\VendorCateringResource\Pages;

use App\Filament\Resources\VendorCateringResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateVendorCatering extends CreateRecord
{
    protected static string $resource = VendorCateringResource::class;
    public static ?string $title = 'Add Vendor Catering';
}

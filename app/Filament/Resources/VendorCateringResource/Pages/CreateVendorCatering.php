<?php

namespace App\Filament\Resources\VendorCateringResource\Pages;

use Filament\Actions;
use App\Models\VendorCatering;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\VendorCateringResource;

class CreateVendorCatering extends CreateRecord
{
    protected static string $resource = VendorCateringResource::class;
    public static ?string $title = 'Add Vendor Catering';

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        unset($data['venue_id']); // Prevent inserting array into integer column
        return $data;
    }


    protected function handleRecordCreation(array $data): \Illuminate\Database\Eloquent\Model
    {
        $venueIds = $this->form->getState()['venue_id'];

        foreach ($venueIds as $venueId) {
            VendorCatering::create([
                ...$data,
                'venue_id' => $venueId,
            ]);
        }

        return VendorCatering::latest()->first();
    }
}

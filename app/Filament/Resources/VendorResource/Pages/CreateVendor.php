<?php

namespace App\Filament\Resources\VendorResource\Pages;

use Filament\Actions;
use App\Models\Vendor;
use App\Filament\Resources\VendorResource;
use Filament\Resources\Pages\CreateRecord;

class CreateVendor extends CreateRecord
{
    protected static string $resource = VendorResource::class;
    public static ?string $title = 'Add Vendor';

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        unset($data['venue_id']); // Prevent inserting array into integer column
        return $data;
    }


    protected function handleRecordCreation(array $data): \Illuminate\Database\Eloquent\Model
    {
        $venueIds = $this->form->getState()['venue_id'];

        foreach ($venueIds as $venueId) {
            Vendor::create([
                ...$data,
                'venue_id' => $venueId,
            ]);
        }

        return Vendor::latest()->first();
    }
}

<?php

namespace App\Filament\Resources\WeddingTransactionResource\Pages;

use Filament\Actions;
use App\Services\WhatsAppService;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\WeddingTransactionResource;

class CreateWeddingTransaction extends CreateRecord
{
    protected static string $resource = WeddingTransactionResource::class;
    public static ?string $title = 'Create Wedding Plan';

    protected function afterCreate(): void
    {
        $customer = $this->record->customer;
        $phone = preg_replace('/^0/', '62', $customer->phone_number);
        $message = "Hello {$customer->grooms_name} & {$customer->brides_name}, your wedding plan has been successfully submitted!";

        app(WhatsAppService::class)->sendMessage($phone, $message);
    }
}

<?php

namespace App\Filament\Resources\WeddingTransactionResource\Pages;

use App\Filament\Resources\WeddingTransactionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWeddingTransaction extends EditRecord
{
    protected static string $resource = WeddingTransactionResource::class;
    public static ?string $title = 'Create Wedding Plan';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

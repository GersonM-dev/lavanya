<?php

namespace App\Filament\Resources\WeddingTransactionResource\Pages;

use App\Filament\Resources\WeddingTransactionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWeddingTransactions extends ListRecords
{
    protected static string $resource = WeddingTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

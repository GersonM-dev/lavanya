<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WeddingTransactionResource\Pages;
use App\Filament\Resources\WeddingTransactionResource\RelationManagers;
use App\Models\WeddingTransaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WeddingTransactionResource extends Resource
{
    protected static ?string $model = WeddingTransaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $pluralLabel = 'Wedding Plan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('customer_id')
                    ->label('Customer')
                    ->relationship('customer', 'grooms_name')
                    ->required(),

                Forms\Components\Select::make('venue_type')
                    ->label('Venue Type')
                    ->options([
                        'Indoor' => 'Indoor',
                        'Outdoor' => 'Outdoor',
                    ])
                    ->reactive()
                    ->required(),

                Forms\Components\Select::make('venue_id')
                    ->label('Venue')
                    ->options(function ($get) {
                        $type = $get('venue_type');
                        if (!$type)
                            return [];
                        return \App\Models\Venue::where('type', $type)->pluck('nama', 'id');
                    })
                    ->required()
                    ->searchable()
                    ->disabled(fn($get) => !$get('venue_type')),

                Forms\Components\Repeater::make('vendors')
                    ->label('Vendors')
                    ->relationship('vendors')
                    ->schema([
                        Forms\Components\Select::make('vendor_id')
                            ->label('Vendor')
                            ->options(function ($get) {
                                $venueId = $get('../../venue_id');
                                return \App\Models\Vendor::when($venueId, function ($q) use ($venueId) {
                                    $q->where('id_venue', $venueId);
                                })->pluck('nama', 'id');
                            })
                            ->searchable()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                $vendor = \App\Models\Vendor::find($state);
                                if ($vendor) {
                                    $set('estimated_price', $vendor->harga);
                                } else {
                                    $set('estimated_price', null);
                                }

                                $vendors = $get('../../vendors') ?? [];
                                $total = collect($vendors)->sum('estimated_price');
                                $set('../../total_estimated_price', $total);
                            }),

                        Forms\Components\TextInput::make('estimated_price')
                            ->label('Estimated Price')
                            ->numeric()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                $vendors = $get('../../vendors') ?? [];
                                $total = collect($vendors)->sum('estimated_price');
                                $set('../../total_estimated_price', $total);
                            }),
                    ])
                    ->columnSpanFull()
                    ->collapsible()
                    ->defaultItems(2)
                    ->minItems(1)
                    ->grid(2)
                    ->itemLabel(function (array $state): ?string {
                        if (isset($state['vendor_id'])) {
                            $vendor = \App\Models\Vendor::find($state['vendor_id']);
                            return $vendor?->nama;
                        }
                        return null;
                    })
                    ->createItemButtonLabel('Add Vendor'),


                Forms\Components\TextInput::make('total_estimated_price')
                    ->label('Total Estimated Price')
                    ->numeric()
                    ->disabled()
                    ->dehydrated()
                    ->required(),

                Forms\Components\DateTimePicker::make('transaction_date')
                    ->label('Transaction Date')
                    ->required()
                    ->disabled()
                    ->dehydrated()
                    ->default(now()),

                Forms\Components\Textarea::make('notes')
                    ->label('Notes')
                    ->nullable()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer.name')
                    ->label('Customer')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('venue.name')
                    ->label('Venue')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('transaction_date')
                    ->label('Transaction Date')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\TextColumn::make('total_estimated_price')
                    ->label('Total Estimated Price')
                    ->money('usd')
                    ->sortable(),

                Tables\Columns\SelectColumn::make('status')
                    ->label('Status')
                    ->options([
                        'draft' => 'Draft',
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ])
                    ->sortable(),

                Tables\Columns\TextColumn::make('notes')
                    ->label('Notes')
                    ->limit(30)
                    ->wrap(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWeddingTransactions::route('/'),
            'create' => Pages\CreateWeddingTransaction::route('/create'),
            'edit' => Pages\EditWeddingTransaction::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Customers';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('grooms_name')
                    ->required()
                    ->label("Nama Pengantin Pria"),

                TextInput::make('brides_name')
                    ->required()
                    ->label("Nama Pengantin Wanita"),

                TextInput::make('guest_count')
                    ->numeric()
                    ->required()
                    ->label("Jumlah Tamu"),

                DatePicker::make('wedding_date')
                    ->required()
                    ->label("Tanggal Pernikahan"),

                TextInput::make('refferal_code')
                    ->nullable()
                    ->label("Kode Referral"),

                TextInput::make('phone_number')
                    ->required()
                    ->label("Nomor Telepon"),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('grooms_name')->sortable()->searchable(),
                TextColumn::make('brides_name')->sortable()->searchable(),
                TextColumn::make('guest_count')->label("Tamu"),
                TextColumn::make('wedding_date')->date()->sortable(),
                TextColumn::make('phone_number')->label("Telp"),
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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
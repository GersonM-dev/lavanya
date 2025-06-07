<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VendorCategoryResource\Pages;
use App\Filament\Resources\VendorCategoryResource\RelationManagers;
use App\Models\VendorCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class VendorCategoryResource extends Resource
{
    protected static ?string $model = VendorCategory::class;
    protected static ?string $pluralLabel = 'Kategori';
    protected static ?string $navigationGroup = 'Venue & Vendor';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('created_at')->dateTime('d-M-Y')->sortable(),
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
            'index' => Pages\ListVendorCategories::route('/'),
            'create' => Pages\CreateVendorCategory::route('/create'),
            'edit' => Pages\EditVendorCategory::route('/{record}/edit'),
        ];
    }
}
<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VendorResource\Pages;
use App\Filament\Resources\VendorResource\RelationManagers;
use App\Models\Vendor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

class VendorResource extends Resource
{
    protected static ?string $model = Vendor::class;

    protected static ?string $pluralLabel = 'Vendors';
    protected static ?string $navigationGroup = 'Venue & Vendor';
    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('nama')->required(),
            Select::make('venue_id')
                ->label('Venue')
                ->relationship('venue', 'nama')
                ->searchable()
                ->nullable(),
            Textarea::make('deskripsi')->required(),
            TextInput::make('harga')->numeric()->required(),
            TextInput::make('portofolio_link')->label('Portfolio URL'),
            FileUpload::make('image1')->image(),
            FileUpload::make('image2')->image(),
            FileUpload::make('image3')->image(),
            Toggle::make('is_active')->default(true),
            Toggle::make('is_mandatory')->default(false),
            Select::make('vendor_category_id')
                ->label('Kategori Vendor')
                ->relationship('category', 'name')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')->searchable(),
                TextColumn::make('venue.nama')->label('Venue'),
                TextColumn::make('category.name')->label('Kategori'),
                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
                IconColumn::make('is_mandatory')
                    ->label('Wajib')
                    ->boolean(),
                TextColumn::make('harga')->money('IDR'),
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
            'index' => Pages\ListVendors::route('/'),
            'create' => Pages\CreateVendor::route('/create'),
            'edit' => Pages\EditVendor::route('/{record}/edit'),
        ];
    }
}
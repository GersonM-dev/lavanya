<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use App\Models\VendorCatering;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\VendorCateringResource\Pages;
use App\Filament\Resources\VendorCateringResource\RelationManagers;

class VendorCateringResource extends Resource
{
    protected static ?string $model = VendorCatering::class;

    protected static ?string $pluralLabel = 'Catering';
    protected static ?string $navigationGroup = 'Venue & Vendor';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('nama')->required(),
            Select::make('venue_id')
                ->label('Venue')
                ->relationship('venue', 'nama')
                ->searchable()
                ->preload()
                ->multiple(),

            Select::make('type')
                ->options([
                    'Hotel' => 'Hotel',
                    'Resto' => 'Resto',
                    'Basic' => 'Basic',
                ])
                ->required()->reactive(),
            TextInput::make('buffet_price')
                ->label('Harga Buffet')
                ->numeric()
                ->nullable()
                ->visible(fn($get) => in_array($get('type'), ['Hotel', 'Resto'])),

            TextInput::make('gubugan_price')
                ->label('Harga Gubugan')
                ->numeric()
                ->nullable()
                ->visible(fn($get) => in_array($get('type'), ['Hotel', 'Resto'])),

            TextInput::make('dessert_price')
                ->label('Harga Dessert')
                ->numeric()
                ->nullable()
                ->visible(fn($get) => in_array($get('type'), ['Hotel', 'Resto'])),

            TextInput::make('base_price')
                ->label('Harga Base')
                ->numeric()
                ->nullable()
                ->visible(fn($get) => $get('type') === 'Basic'),

            RichEditor::make('deskripsi')->required()->columnSpanFull(),

            FileUpload::make('image1')->image()->label('Gambar 1')->columnSpanFull(),
            FileUpload::make('image2')->image()->label('Gambar 2'),
            FileUpload::make('image3')->image()->label('Gambar 3'),
            TextInput::make('portofolio_link')->label('Portfolio URL (Instagram)')
                ->url()
                ->nullable(),
            Toggle::make('is_active')->default(true)->hidden(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')->searchable(),
                TextColumn::make('venue.nama')->label('Venue'),
                TextColumn::make('type')->label('Tipe'),
                TextColumn::make('harga')->money('IDR', true),
                ToggleColumn::make('is_active'),
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
            'index' => Pages\ListVendorCaterings::route('/'),
            'create' => Pages\CreateVendorCatering::route('/create'),
            'edit' => Pages\EditVendorCatering::route('/{record}/edit'),
        ];
    }
}

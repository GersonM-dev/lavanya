<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VendorResource\Pages;
use App\Filament\Resources\VendorResource\RelationManagers;
use App\Models\Vendor;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
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
use Filament\Tables\Columns\ToggleColumn;

class VendorResource extends Resource
{
    protected static ?string $model = Vendor::class;

    protected static ?string $pluralLabel = 'Vendor';
    protected static ?string $navigationGroup = 'Venue & Vendor';
    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('nama')->required(),
            Select::make('venue_id')
                ->label('Venue')
                ->relationship('venue', 'nama')
                ->preload()
                ->multiple()
                ->required(),
            Select::make('vendor_category_id')
                ->label('Kategori')
                ->relationship('category', 'name')
                ->required(),
            TextInput::make('harga')->numeric()->required(),
            FileUpload::make('image1')->image()->label('Gambar 1')->columnSpanFull(),
            FileUpload::make('image2')->image()->label('Gambar 2'),
            FileUpload::make('image3')->image()->label('Gambar 3'),
            RichEditor::make('deskripsi')->required()->columnSpanFull(),
            TextInput::make('portofolio_link')->label('Portfolio URL')->columnSpanFull(),
            Toggle::make('is_active')->default(true)->hidden(),
            Toggle::make('is_mandatory')->default(false)->hidden(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')->searchable(),
                TextColumn::make('venue.nama')->label('Venue'),
                TextColumn::make('category.name')->label('Kategori'),
                ToggleColumn::make('is_active')
                    ->label('Aktif'),
                ToggleColumn::make('is_mandatory')
                    ->label('Wajib'),
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
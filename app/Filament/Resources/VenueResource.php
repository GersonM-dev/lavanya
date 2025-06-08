<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VenueResource\Pages;
use App\Filament\Resources\VenueResource\RelationManagers;
use App\Models\Venue;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;

class VenueResource extends Resource
{
    protected static ?string $model = Venue::class;

    protected static ?string $navigationLabel = 'Venues';
    protected static ?string $pluralModelLabel = 'Venues';
    protected static ?string $slug = 'venues';
    protected static ?string $navigationGroup = 'Venue & Vendor';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('nama')->required(),
            Select::make('type')
                ->options([
                    'Indoor' => 'Indoor',
                    'Outdoor' => 'Outdoor',
                ])
                ->required(),
            TextInput::make('harga')->numeric()->required(),
            TextInput::make('portofolio_link')->label('Link Portofolio')->url()->nullable(),
            FileUpload::make('image1')
                ->label('Gambar 1')
                ->image()
                ->directory('venues')
                ->required()->columnSpanFull(),
            FileUpload::make('image2')
                ->label('Gambar 2')
                ->image()
                ->directory('venues')
                ->required(),
            FileUpload::make('image3')
                ->label('Gambar 3')
                ->image()
                ->directory('venues')
                ->required(),
            RichEditor::make('deskripsi')->required()->columnSpanFull(),
            Toggle::make('is_active')->label('Aktif')->default(true)->hidden(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')->searchable()->sortable(),
                TextColumn::make('type'),
                TextColumn::make('harga')->money('IDR', true),
                ToggleColumn::make('is_active')->label('Aktif'),
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
            'index' => Pages\ListVenues::route('/'),
            'create' => Pages\CreateVenue::route('/create'),
            'edit' => Pages\EditVenue::route('/{record}/edit'),
        ];
    }
}
<?php

namespace App\Filament\Share;

use Filament\Forms;
use App\Models\Lookup\Country;
use Filament\Forms\Components\Section;

class AddressForm
{
    public static function getSchema(): array
    {

        return [Section::make(__('Address'))
            ->relationship('address')
            ->columns(2)
            ->description(__('Address information about the school'))
            ->schema([
                Forms\Components\Textarea::make('street')
                    ->label(__('Street Address'))
                    ->placeholder(__('e.g., 123 Main St, Apt 4B'))
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('city')
                    ->label(__('City'))
                    ->placeholder(__('e.g., New York'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('state')
                    ->label(__('State'))
                    ->placeholder(__('e.g., NY'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('zip_code')
                    ->label(__('Zip Code'))
                    ->placeholder(__('e.g., 10001'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('country')
                    ->required()
                    ->options(Country::all()->pluck('name', 'code_2'))
                    ->searchable()
                    ->placeholder('Select a country'),

                Forms\Components\TextInput::make('region')
                    ->label(__('Region'))
                    ->placeholder(__('e.g., North America'))
                    ->maxLength(255)->columnSpan(2),
                Forms\Components\TextInput::make('latitude')
                    ->label(__('Latitude'))
                    ->placeholder(__('e.g., 40.7128'))
                    ->maxLength(255),
                Forms\Components\TextInput::make('longitude')
                    ->label(__('Longitude'))
                    ->placeholder(__('e.g., -74.0060'))
                    ->maxLength(255),

            ])];
    }
}

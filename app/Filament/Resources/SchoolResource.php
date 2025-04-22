<?php

/**
 * @School Management System
 * @license MIT
 * @link https://faridmau.com
 * @author faridmau
 * @github https://github.com/faridmau/school-management-system
 * @license https://opensource.org/licenses/MIT
 */

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\School;
use Filament\Forms\Form;
use App\Enums\StatusEnum;
use Filament\Tables\Table;
use App\Enums\SchoolTypeEnum;
use App\Models\Lookup\Country;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\SchoolResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SchoolResource\RelationManagers;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class SchoolResource extends Resource
{
    protected static ?string $model = School::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('Basic Information'))
                    ->description('Basic information about the school')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Group::make()
                                    ->schema([
                                        Forms\Components\TextInput::make('name')
                                            ->label(__('School Name'))
                                            ->required()
                                            ->maxLength(255),
                                        Forms\Components\Select::make('status')
                                            ->label(__('Status'))
                                            ->required()
                                            ->options(StatusEnum::class)
                                            ->default(StatusEnum::ACTIVE->value),
                                        Forms\Components\Select::make('type')
                                            ->label(__('Type'))
                                            ->options(SchoolTypeEnum::class)
                                            ->required(),
                                        Forms\Components\TextInput::make('school_code')
                                            ->label(__('School Code'))
                                            ->maxLength(255),
                                    ])->columnSpan(1),
                                Group::make()
                                    ->schema([
                                        SpatieMediaLibraryFileUpload::make('logo')
                                            ->image()
                                            ->collection('school_logo')
                                            ->label(__('Logo')),

                                    ])->columnSpan(1),
                            ]),
                        Forms\Components\RichEditor::make('about')
                            ->columnSpanFull(),
                        Forms\Components\RichEditor::make('vision')
                            ->columnSpanFull(),
                        Forms\Components\RichEditor::make('mission')
                            ->columnSpanFull(),

                    ]),
                Section::make(__('Address'))
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

                        Grid::make(4)
                            ->schema([
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
                            ]),

                    ]),
                Section::make(__('Additional Information'))
                    ->columns(2)
                    ->description(__('Additional information about the school'))
                    ->schema([
                        Forms\Components\TextInput::make('phone_number')
                            ->maxLength(255),
                        Forms\Components\TagsInput::make('social_media_links')
                            ->placeholder(__('e.g., Facebook, Twitter, Instagram'))
                            ->label(__('Social Media Links')),
                        Forms\Components\TagsInput::make('facilities')
                            ->placeholder(__('e.g., Library, Gym, Playground'))
                            ->label(__('Facilities')),
                        Forms\Components\TextInput::make('email')
                            ->label(__('Email'))
                            ->email()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('website')
                            ->label(__('Website'))
                            ->maxLength(255)
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('city')
                    ->searchable(),
                Tables\Columns\TextColumn::make('state')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone_number')
                    ->searchable()
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
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
            'index' => Pages\ListSchools::route('/'),
            'create' => Pages\CreateSchool::route('/create'),
            'edit' => Pages\EditSchool::route('/{record}/edit'),
        ];
    }
}

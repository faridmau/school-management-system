<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Employee;
use Filament\Forms\Form;
use App\Enums\StatusEnum;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use App\Filament\Resources\EmployeeResource\Pages;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('Basic Information'))
                    ->description('Basic information about the employee')
                    ->schema([
                        Select::make('schools')
                            ->relationship('schools', 'name')
                            ->label(__('Schools'))
                            ->required()
                            ->searchable()
                            ->multiple()
                            ->preload()
                            ->placeholder('Select a school'),
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('employee_code')
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->rules(function($record){
                                return [
                                    'required',
                                    'email',
                                    \Illuminate\Validation\Rule::unique('users', 'email')->ignore($record?->user_id),
                                ];
                            })
                            ->label(__('Email'))
                            ->email()
                            ->maxLength(255),
                        Forms\Components\Select::make('status')
                            ->required()
                            ->options(StatusEnum::class)
                            ->label(__('Status'))
                            ->default(StatusEnum::ACTIVE->value),
                        Forms\Components\TextInput::make('password')
                            ->rule(\Illuminate\Validation\Rules\Password::default())
                            ->revealable()
                            ->confirmed()
                            ->password()
                            ->required(fn ($record) => ! $record)
                            ->revealable()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('password_confirmation')
                            ->revealable()
                            ->password()
                            ->required(fn ($record) => ! $record)
                            ->revealable()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('position')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('phone_number')
                            ->maxLength(255),
                        SpatieMediaLibraryFileUpload::make('profile_picture')
                            ->image()
                            ->collection('profile_pictures')
                            ->label(__('Profile Picture')),

                        Forms\Components\Textarea::make('notes'),

                    ])->columns(2),
                ...\App\Filament\Share\AddressForm::getSchema(),

                Section::make(__('Financial Information'))
                    ->description('Financial information about the employee')
                    ->schema([
                        Forms\Components\TextInput::make('salary')
                            ->numeric(),
                        Forms\Components\TextInput::make('bank_account_number')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('bank_name')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('bank_branch')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('tax_id')
                            ->maxLength(255),
                        Forms\Components\DatePicker::make('hire_date')
                            ->native(false)
                            ->label(__('Hire Date'))
                            ->placeholder('Select a date')
                            ->maxDate(now())
                            ->default(now()),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('city')
                    ->searchable(),
                Tables\Columns\TextColumn::make('state')
                    ->searchable(),
                Tables\Columns\TextColumn::make('zip_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('country')
                    ->searchable(),
                Tables\Columns\TextColumn::make('region')
                    ->searchable(),
                Tables\Columns\TextColumn::make('latitude')
                    ->searchable(),
                Tables\Columns\TextColumn::make('longitude')
                    ->searchable(),
                Tables\Columns\TextColumn::make('position')
                    ->searchable(),
                Tables\Columns\TextColumn::make('employee_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('emergency_contact_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('emergency_contact_phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('emergency_contact_relationship')
                    ->searchable(),
                Tables\Columns\TextColumn::make('medical_conditions')
                    ->searchable(),
                Tables\Columns\TextColumn::make('allergies')
                    ->searchable(),
                Tables\Columns\TextColumn::make('special_needs')
                    ->searchable(),
                Tables\Columns\TextColumn::make('salary')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('bank_account_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('bank_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('bank_branch')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tax_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('hire_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('notes')
                    ->searchable(),
                Tables\Columns\TextColumn::make('updated_by')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_by')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}

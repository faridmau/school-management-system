<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEmployee extends EditRecord
{
    protected static string $resource = EmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function mutateFormDataBeforeSave(array $data): array
    {
        $updateData = [
            'name' => $this->data['name'],
            'email' => $this->data['email'],
        ];

        if (!empty($this->data['password'])) {
            $updateData['password'] = bcrypt($data['password']);
        }
        $this->record->user->update($updateData);
        unset($data['name'], $data['email'], $data['password'], $data['password_confirmation']);
        return $data;
    }
}

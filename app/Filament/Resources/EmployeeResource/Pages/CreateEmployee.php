<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEmployee extends CreateRecord
{
    protected static string $resource = EmployeeResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Create the user first
        $user = \App\Models\User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        // Now update the main employee data to include user_id
        $data['user_id'] = $user->id;
        // Remove user array to avoid "unknown column" issues
        unset($data['name'], $data['email'], $data['password'], $data['password_confirmation']);

        return $data;
    }
}

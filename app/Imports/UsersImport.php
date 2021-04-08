<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Spatie\Permission\Models\Role;

class UsersImport implements ToModel, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user = User::create([
            'name'     => $row[0],
            'email'    => $row[1], 
            'password' => Hash::make($row[2]),
        ]);
        $role=Role::find(4);
        $user->assignRole($row[3]);
    }

    public function rules(): array
    {
        return [
            '0' => 'required|string',
            '1' => 'unique:users,email',
        ];
    }
    public function customValidationMessages()
{
    return [
        '0.required' => 'Names for all student is required',
        '1.unique' => 'Duplicate Entry for emails',
    ];
}
}

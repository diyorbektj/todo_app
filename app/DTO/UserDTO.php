<?php

namespace App\DTO;

use Illuminate\Support\Facades\Hash;

class UserDTO
{
    public static function toArray(array $data): array
    {
        return [
            'name' => $data['name'],
            'email' => $data['email'],
            'avatar' => "/storage/users/avatar/{$data['name']}.png",
            'password' => Hash::make($data['password']),
        ];
    }
}

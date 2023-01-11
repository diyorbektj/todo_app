<?php

namespace App\Services;

use App\DTO\UserDTO;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function register($request)
    {
        $path = storage_path('app/public/users/avatar/')."$request->name.png";
        \Avatar::create($request->name)
            ->setDimension(400, 400)
            ->setFontSize(200)
            ->save($path);
        $data = UserDTO::toArray($request->validated());
        $user = User::query()->create($data);

        Auth::login($user);

        return 0;
    }
}

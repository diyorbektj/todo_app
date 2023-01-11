<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile()
    {
        return view('users.profile', [
            'user' => Auth::user(),
        ]);
    }

    public function update()
    {
        return 1;
    }
}

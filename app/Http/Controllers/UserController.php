<?php

namespace App\Http\Controllers;

use App\Models\User;
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function profile()
    {
        return view('users.profile', [
            'user' => Auth::user(),
        ]);
    }

    public function update(Request $request, $id)
    {
        User::query()->find($id)->update([
            'name' => $request->name,
            'email' => $request->email
        ]);
        return response()->json(["message" => "Successful updateted"]);
    }
}

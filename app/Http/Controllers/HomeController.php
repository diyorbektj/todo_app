<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        if (\Illuminate\Support\Facades\Auth::check()) {
            return redirect('/dashboard');
        } else {
            return redirect('/login');
        }
    }
}

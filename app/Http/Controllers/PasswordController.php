<?php

namespace App\Http\Controllers;

use App\Rules\CurrentPassword;
use App\User;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function update()
    {
        $attributes = request()->validate([
            'current_password' => ['required', new CurrentPassword],
            'password' => 'required|string|min:8|confirmed'
        ]);

        auth()->user()->update([
            'password' => Hash::make($attributes['password'])
        ]);

        return auth()->user();
    }
}

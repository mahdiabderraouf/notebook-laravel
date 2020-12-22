<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Get the current User
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return auth()->user();
    }


    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        $attributes = request()->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore(auth()->id()),
            ]
        ]);

        auth()->user()->update($attributes);

        return auth()->user();
    }
}

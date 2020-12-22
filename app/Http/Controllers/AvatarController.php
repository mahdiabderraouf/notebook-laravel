<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AvatarController extends Controller
{


    public function update()
    {
        $attributes = request()->validate([
            'avatar' => 'required|image'
        ]);

        $attributes['avatar'] = '/storage/' . Storage::disk('public')->putFile(
            'avatars',
            request()->file('avatar')
        );

        // Orientate the image
        $avatar = \Image::make(public_path($attributes['avatar']))
            ->orientate()
            ->save();

        // Delete old avatar
        Storage::disk('public')->delete(Str::replaceFirst('/storage/', '', auth()->user()->avatar));

        auth()->user()->update($attributes);

        return auth()->user();
    }
}

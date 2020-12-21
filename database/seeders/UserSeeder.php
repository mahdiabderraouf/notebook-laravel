<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a user with 10 tags with 3 notes
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'john.doe@gmail.com',
            'password' => Hash::make('password'),
            'avatar' => '/images/default-avatar.png'
        ]);
        $tags = Tag::factory(5)->state([
            'user_id' => $user->id
        ])->create();
        $notes = Note::factory(3)->state([
            'user_id' => $user->id,
        ])->create();

        foreach($notes as $note) {
            $note->tags()->attach($tags->pluck('id')->toArray());
        }
    }
}

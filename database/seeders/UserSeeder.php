<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

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
        $user = User::factory()->create();
        $tags = Tag::factory(5)->state([
            'user_id' => $user->id
        ])->create();
        $notes = Note::factory(3)->state([
            'user_id' => $user->id,
            'tag_id' => $tags->first()->id
        ])->create();
    }
}

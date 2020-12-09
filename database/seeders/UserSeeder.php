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
        User::factory(10)
            ->has(Note::factory()->count(5))
            ->has(Tag::factory()->count(3))
            ->create();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Tag;
use Illuminate\Http\Request;

class NoteTagsController extends Controller
{    
    /**
     * Attach a tag to the given note
     *
     * @param \App\Models\Note $note
     * @return \App\Models\Note
     */
    public function store(Note $note) {
        $data = request()->validate([
            'title' => 'required|string'
        ]);

        $tag = Tag::firstOrCreate([
            'title' => $data['title']
        ], [
            // Add the user when creating
            'user_id' => auth()->id()
        ]);

        if(!$note->tags->contains($tag->id))
             $note->tags()->attach($tag->id);

        return $note->load('tags');
    }

    /**
     * Detach a tag to the given note
     *
     * @param \App\Models\Note $note
     * @return \App\Models\Note
     */
    public function destroy(Note $note, Tag $tag) {
        $note->tags()->detach($tag->id);

        return $note->load('tags');
    }
}

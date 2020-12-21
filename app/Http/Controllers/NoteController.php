<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Note::where('user_id', auth()->id())
            ->with('tags')
            ->latest()
            ->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $note = request()->validate([
            'title' => 'sometimes|string|nullable',
            'body' => 'sometimes|string|nullable'
        ]);

        $note['user_id'] = auth()->id();
        
        return Note::create($note);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        $this->authorize('view', $note);

        return $note->load('tags');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Note $note)
    {
        $this->authorize('update', $note);
        $data = request()->validate([
            'title' => 'sometimes|string|nullable',
            'body' => 'sometimes|string|nullable',
            'is_pinned' => 'sometimes|boolean'
        ]);

        $note->update($data);

        return $note->load('tags');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Note $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        $this->authorize('delete', $note);

        $note->delete();

        return response([
            'message' => 'Note deleted successfully'
        ], 200);
    }
}

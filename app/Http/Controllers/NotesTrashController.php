<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;

class NotesTrashController extends Controller
{
    /**
     * Get only soft-deleted notes.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return Note::onlyTrashed()->where('user_id', auth()->id())->get();
    }

    /**
     * Restore the given resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id) {
        $note = Note::withTrashed()->findOrFail($id);

        $this->authorize('update', $note);

        if($note->trashed()) {
            $note->restore();
        }

        return response([
            'message' => 'Note restored!'
        ], 200);
    }

    /**
     * Remove the specified resource from storage permanently.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $note = Note::withTrashed()->findOrFail($id);
        
        $this->authorize('delete', $note);

        $note->forceDelete();

        return response([
            'message' => 'Note deleted successfully'
        ], 200);
    }
}

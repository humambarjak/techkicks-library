<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;

class NoteController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'page' => 'required|integer',
            'content' => 'required|string',
        ]);
    
        $note = Note::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'book_id' => $request->book_id,
                'page' => $request->page
            ],
            ['content' => $request->content]
        );
    
        return response()->json(['message' => 'Saved!']);
    }
    
}

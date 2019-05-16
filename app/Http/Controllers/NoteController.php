<?php

namespace App\Http\Controllers;

use App\Note;
use App\User;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('home');
    }
    
    public function showall() {
        $notes = Note::where('user_id', '=', auth()->id())->orderBy('created_at', 'desc')->get();
        return $notes;
    }

    public function store(Request $request)
    {
        //
        $note = new Note;
        $note->label = "Notes";
        $note->user_id = auth()->id();
        $note->title = $request->title;
        $note->note = $request->note;
        $note->image = "ImageSample";
        $note->save();
    }

    public function editshow($id) {
        $note = Note::findOrFail($id);
        return $note;
    }

    public function updateNote(Request $request, $id) {
        $note = Note::findOrFail($id);
        $note->title = $request->title;
        $note->note = $request->note;
        $note->save();
    }

}

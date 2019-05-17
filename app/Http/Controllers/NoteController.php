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
        $note = new Note;
        $note->label = "Notes";
        $note->user_id = auth()->id();
        $note->title = $request->title;
        $note->note = $request->note;
        $note->color = "TestingColor"; 

        if ($request->get('images')) {
            foreach ($request->get('images') as $image) {
                $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
                //$path = public_path('images/').$name;
                $source = storage_path().'/app/public/images/'. $name;
                \Image::make($image)->fit(340, 340)->save($source);
                $data[] = $name;
            }
            $note->image = json_encode($data); 
        } 
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
        if ($request->get('images')) {
            foreach ($request->get('images') as $image) {
                $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
                $source = storage_path().'/app/public/images/'. $name;                
                \Image::make($image)->fit(340, 340)->save($source);
                $data[] = $name;
            }
            $note->image = json_encode($data); 
        } 
        $note->save();
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;

class NoteController extends Controller
{

    protected $user;

    public function __construct()
    {
        $this->user = User::where('id',1)->first();
    }
    public function index(){
        $note = Note::orderByDesc('id')->where('user_id',$this->user->id)->get();

        return response()->json($note);

    }
    public function add(){
        $note = Note::create([
            'user_id' => $this->user->id,
            'title' => request('title'),
            'content' => request('content'),
        ]);

        return response()->json($note);
    }

    public function remove($id){
        $note = Note::where('id',$id)->delete();

        return response()->json($note);

    }
}

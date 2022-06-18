<?php

namespace App\Http\Controllers;

use App\Models\Season;
use App\Models\User;
use Illuminate\Http\Request;

class SeasonController extends Controller
{

    protected $user;

    public function __construct()
    {
        $this->user = User::where('id',1)->first();
    }
    public function index(){
        $season = Season::with('getProducts')->orderByDesc('id')->where('user_id',$this->user->id)->get();

        return response()->json($season);

    }

    public function add(){
        $season = Season::create([
            'user_id' => $this->user->id,
            'name' => request('name') 
        ]);

        return response()->json($season);
    }

    public function detail($id){
        $season = Season::where('id',$id)->first();

        return response()->json($season);
    }
    public function edit($id){
        $season = Season::where('id',$id)->update([
            'name' => request('name')
        ]);

        return response()->json($season);
    }
    public function remove($id){
        $season = Season::where('id',$id)->delete();

        return response()->json($season);

    }
}

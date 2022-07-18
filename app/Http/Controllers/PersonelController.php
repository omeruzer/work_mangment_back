<?php

namespace App\Http\Controllers;

use App\Models\Personel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PersonelController extends Controller
{

    protected $user;

    public function __construct()
    {
        $this->user = User::where('id',1) ->first();
    }
    public function index(){
        $personel = Personel::with('getDepartman')->orderByDesc('id')->where('user_id',auth()->id())->get();

        return response()->json($personel);

    }

    public function add(){
        $personel = Personel::create([
            'user_id' => auth()->id(),
            'name' => request('name') ,
            'departman_id' => request('departman_id') ,
            'salary' => request('salary') ,
        ]);

        return response()->json($personel);
    }

    public function detail($id){
        $personel = Personel::where('id',$id)->first();

        return response()->json($personel);
    }
    public function edit($id){
        $personel = Personel::where('id',$id)->update([
            'name' => request('name'),
            'departman_id' => request('departman_id') ,
            'salary' => request('salary') ,
        ]);

        return response()->json($personel);
    }
    public function remove($id){
        $personel = Personel::where('id',$id)->delete();

        return response()->json($personel);

    }
}

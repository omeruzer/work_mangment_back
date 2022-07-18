<?php

namespace App\Http\Controllers;

use App\Models\Pattern;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\Auth;

class PatternController extends Controller
{

    protected $user;

    public function __construct()
    {
        $this->user = User::where('id',1) ->first();
    }
    public function index(){
        Limit::perMinute(3);
        $pattern = Pattern::with(["getProducts"])->orderByDesc('id')->where('user_id',auth()->id())->get();

        return response()->json($pattern);

    }

    public function add(){
        $pattern = Pattern::create([
            'user_id' => auth()->id(),
            'name' => request('name')
        ]);

        return response()->json($pattern);
    }

    public function detail($id){
        $pattern = Pattern::where('id',$id)->first();

        return response()->json($pattern);
    }
    public function edit($id){
        $pattern = Pattern::where('id',$id)->update([
            'name' => request('name')
        ]);

        return response()->json($pattern);
    }
    public function remove($id){
        $pattern = Pattern::where('id',$id)->delete();

        return response()->json($pattern);

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = User::where('id',1)->first();
    }

    public function userInfo(){
        $user= Auth::user();
        return response()->json($user);
    }

    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        if(Auth::attempt(['email' => $email, 'password' => $password])){
            $token = $this->user->createToken('myapp')->plainTextToken;

            return response()->json(['user'=>$this->user,'token'=>$token]);
        }else{
            return response()->json(['message'=>'Login Fail']);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function userUpdate(Request $request){

        User::where('id',Auth::id())->update([
            'name' => $request->name,
            'shop_name'=>$request->shop_name,
            'email'=>$request->email
        ]);

        return response()->json(['message'=>'Updated']);

    }

    public function userPass(Request $request){
        $userPass = $this->user->password;

        $pass = $request->old_pass;

        if(Hash::check($pass, $userPass)){

            $this->user->update([
                'password'=>Hash::make($request->new_pass)  
            ]);

            return response()->json(['msg'=>'Updated']);

        }else{
            return response()->json(['msg'=>'Fail']);
        }
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

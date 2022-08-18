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

        User::where('id',Auth::id()) ->update([
            'name' => $request->name,
            'shop_name'=>$request->shop_name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'shop_address'=>$request->shop_address,
            'money'=>$request->money,
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
        $data = [
            'email'=>  $request->email,
            'password'=> $request->password,
            'isActive'=>1
        ];
        if(Auth::attempt($data)){
            $token = auth()->user()->createToken('myapp')->plainTextToken;

            return response()->json(['message'=>'Success','user'=>$request->email,'token'=>$token]);
        }else{
            return response()->json(['message'=>'Login Fail']);
        }
    }

    public function register(Request $request){
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);

        return response()->json(['message'=>'Success','user'=>$user]);
    }
}

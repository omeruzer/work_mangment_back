<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{

    protected $user;

    public function __construct()
    {
        $this->user = User::where('id',1) ->first();
    }

    public function index(){
        $customer = Customer::orderByDesc('id')->where('user_id',auth()->id())->get();

        return response()->json($customer);

    }

    public function add(){
        $customer = Customer::create([
            'user_id' => auth()->id(),
            'name' => request('name'),
            'email' => request('email'),
            'phone' => request('phone'),
            'address' => request('address'),
        ]);

        return response()->json($customer);
    }
    public function detail($id){
        $customer = Customer::where('id',$id)->first();

        return response()->json($customer);
    }
    public function edit($id){
        $customer = Customer::where('id',$id)->update([
            'name' => request('name'),
            'email' => request('email'),
            'phone' => request('phone'),
            'address' => request('address'),
        ]);

        return response()->json($customer);
    }
    public function remove($id){
        $customer = Customer::where('id',$id)->delete();

        return response()->json($customer);

    }
}

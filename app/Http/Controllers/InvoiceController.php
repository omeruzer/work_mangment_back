<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    protected $user;

    public function __construct()
    {
        $this->user = User::where('id',1)->first();
    }
    
    public function index(){
        $invoice = Invoice::with('getCustomer','getDetail.getProduct')->orderByDesc('id')->where('user_id',$this->user->id)->get();

        return response()->json($invoice);

    }

    public function add(){
        $invoice = Invoice::create([
            'user_id' => $this->user->id,
            'invoice_no'=>'F-00'.rand(1000,99999),
            'type'=>request('type'),
            'customer_id' => request('customer_id') 
        ]);

        return response()->json($invoice);
    }
    public function detail($id){
        $invoice = Invoice::with("getDetail.getProduct")->where('id',$id)->first();

        return response()->json($invoice);
    }
    public function edit($id){
        $invoice = Invoice::where('id',$id)->update([
            'customer_id' => request('customer_id') ,
            'type'=>request('type'),
        ]);

        return response()->json($invoice);
    }
    public function remove($id){
        $invoice = Invoice::where('id',$id)->delete();

        return response()->json($invoice);

    }
}

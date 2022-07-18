<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{

    protected $user;

    public function __construct()
    {
        $this->user = User::where('id',1) ->first();
    }

    public function index(Request $request){
        Limit::perMinute(3);
        $invoice = Invoice::with('getCustomer','getDetail.getProduct')->orderByDesc('id')->where('user_id',auth()->id());

        if($request->has('type')){
            if($request->type=='1'){
                $invoice->where('type',1);
            }else if($request->type=='2'){
                $invoice->where('type',0);
            }
        }

        if($request->has('customer')){
            $invoice->where('customer_id',$request->customer);
        }
        if($request->has('price')){
            if($request->price=='1'){
                $invoice->where('amount_db','>=',1)->where('amount_db','<=',50);
            }else if($request->price=='2'){
                $invoice->where('amount_db','>=',50)->where('amount_db','<=',100);
            }else if($request->price=='3'){
                $invoice->where('amount_db','>=',100)->where('amount_db','<=',200);
            }else if($request->price=='4'){
                $invoice->where('amount_db','>=',200)->where('amount_db','<=',500);
            }else if($request->price=='5'){
                $invoice->where('amount_db','>=',500)->where('amount_db','<=',1000);
            }else if($request->price=='6'){
                $invoice->where('amount_db','>=',1000);
            }
        }

        if($request->has('code')){
            $invoice->where('invoice_no','LIKE', '%' . $request->code . '%');
        }

        if($request->has('date')){
            if($request->date=='1'){
                $invoice->whereDate('invoice_date','=',Carbon::now()->addDay(1));
            }else if($request->date=='2'){
                $invoice->whereDate('invoice_date','=',Carbon::now());
            }else if($request->date=='3'){
                $invoice->whereDate('invoice_date','<=',Carbon::now()->addDay(1))->whereDate('invoice_date','>=',Carbon::now()->addDay(1)->subDay(7));
            }else if($request->date=='4'){
                $invoice->whereDate('invoice_date','<=',Carbon::now()->addDay(1))->whereDate('invoice_date','>=',Carbon::now()->addDay(1)->subDay(14));
            }else if($request->date=='5'){
               $invoice->whereDate('invoice_date','<=',Carbon::now()->addDay(1))->whereDate('invoice_date','>=',Carbon::now()->addDay(1)->subDay(30));
            }
        }


        return response()->json($invoice->get());

    }

    public function add(){
        $invoice = Invoice::create([
            'user_id' => auth()->id(),
            'invoice_no'=>'F-00'.rand(1000,99999),
            'type'=>request('type'),
            'customer_id' => request('customer_id'),
            'invoice_date'=>request('invoice_date')
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
            'invoice_date'=>request('invoice_date')
        ]);

        return response()->json($invoice);
    }
    public function remove($id){
        $invoice = Invoice::where('id',$id)->delete();

        return response()->json($invoice);

    }
}

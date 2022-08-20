<?php

use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/invoice-pdf/{id}',function($id){
    $invoice = Invoice::with('getDetail.getProduct','getCustomer',"getShop")->find($id);

    $data=[
        'no'=>$invoice->invoice_no,
        'shop_logo'=>"http://localhost:8000/assets/images/logos/".$invoice->getShop->shop_logo,
        'shop_name'=>$invoice->getShop->shop_name,
        'shop_address'=>$invoice->getShop->shop_address,
        'shop_phone'=>$invoice->getShop->phone,
        "invoice_date"=>Carbon::parse($invoice->invoice_date)->format('d/m/y'),
        "today_date"=>Carbon::now()->format('d/m/y'),
        "customer_name"=>$invoice->getCustomer->name,
        "customer_phone"=>$invoice->getCustomer->phone,
        "customer_address"=>$invoice->getCustomer->address,
        "customer_email"=>$invoice->getCustomer->email,
        "money"=>$invoice->getShop->money,
        "invoice_detail"=>$invoice->getDetail,
        "invoice_total"=>$invoice->amount_db
    ];
        $pdf = Pdf::loadView('invoice.invoice-pdf', compact('data'));
        return $pdf->download('invoice.pdf');
    // return view('invoice.invoice-pdf',compact('data'));
});



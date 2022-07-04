<?php

namespace App\Http\Controllers;

use App\Models\InvoiceProducts;
use Illuminate\Http\Request;

class InvoiceProductsController extends Controller
{
    public function index(){
        $invoiceProducts = InvoiceProducts::orderByDesc('id')->get();

        return response()->json($invoiceProducts);

    }

    public function detail($id){
        $product = InvoiceProducts::find($id);

        return response()->json($product);
    }

    public function add(){
        $invoiceProducts = InvoiceProducts::create([
            'product_id' => request('product_id'),
            'invoice_id' => request('invoice_id') ,
            'qty' => request('qty') ,
            'price' => request('price') ,
        ]);

        return response()->json($invoiceProducts);
    }

    public function edit($id){
        $invoiceProducts = InvoiceProducts::where('id',$id)->update([
            'product_id' => request('product_id'),
            'invoice_id' => request('invoice_id') ,
            'qty' => request('qty') ,
            'price' => request('price') ,
        ]);

        return response()->json($invoiceProducts);
    }

    public function remove($id){
        $invoiceProducts = InvoiceProducts::where('id',$id)->delete();

        return response()->json($invoiceProducts);
    }

}

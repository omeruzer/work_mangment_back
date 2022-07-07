<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = User::where('id',1)->first();
    }

    public function itemCounts(){
        $data=[];

        $productCount = Product::where('user_id',$this->user->id)->count();
        $todayTotalSell = Invoice::where('user_id',$this->user->id)->whereDate('created_at',Carbon::now())->get();
        $weekTotalSell = Invoice::where('user_id',$this->user->id)->where('created_at','<=',Carbon::now())->where('created_at','>=',Carbon::now()->subDay(7))->get();
        $mounthTotalSell = Invoice::where('user_id',$this->user->id)->where('created_at','<=',Carbon::now())->where('created_at','>=',Carbon::now()->subDay(30))->get();
        $threeMounthTotalSell = Invoice::where('user_id',$this->user->id)->where('created_at','<=',Carbon::now())->where('created_at','>=',Carbon::now()->subDay(90))->get();

        $todayTotalSellPrice=0;
        foreach ($todayTotalSell as $value) {
            $todayTotalSellPrice=$todayTotalSellPrice+$value->amount;
        }
        $weekTotalSellPrice=0;
        foreach ($weekTotalSell as $value) {
            $weekTotalSellPrice=$weekTotalSellPrice+$value->amount;
        }
        $mounthTotalSellPrice=0;
        foreach ($mounthTotalSell as $value) {
            $mounthTotalSellPrice=$mounthTotalSellPrice+$value->amount;
        }
        $threeMounthTotalSellPrice=0;
        foreach ($threeMounthTotalSell as $value) {
            $threeMounthTotalSellPrice=$threeMounthTotalSellPrice+$value->amount;
        }

        $data['product_count']=$productCount;
        $data['today_total_sell']=$todayTotalSellPrice;
        $data['last_seven_day_total_sell']=$weekTotalSellPrice;
        $data['last_mount_total_sell']=$mounthTotalSellPrice;
        $data['last_three_mounth_total_sell']=$threeMounthTotalSellPrice;

        return response()->json($data);
    }

    public function decliningProductStock(){

        $products = Product::where('qty','<',20)->where('user_id',$this->user->id)->select('name','qty','code')->get();

        return response()->json($products);
    }

    public function topCustomer(){
        $data=[];
        $customer = Customer::with('getOrders')->orderByDesc('id')->where('user_id',$this->user->id)->select('id','name')->limit(9)->get();

        $data['customers']= $customer;

        return response()->json($data);

    }
}

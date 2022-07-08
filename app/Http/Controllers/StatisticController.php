<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Google\Service\HangoutsChat\Card;
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

        $products = Product::where('qty','<',20)->where('user_id',$this->user->id)->orderBy("qty",'ASC')->select('name','qty','code')->get();

        return response()->json($products);
    }

    public function topCustomer(){
        $data=[];
        $customer = Customer::where('user_id',$this->user->id)->select('id','name')->limit(9)->get();

        $data['customers']= $customer;

        return response()->json($data);

    }

    public function dailySell(){
        $data=[];

        $data["sell"]["period"]=$this->getDailyDate(14)->original;
        $data["sell"]["data"]=$this->getDailyInvoiceCount(1,14)->original;
        $data["return"]["period"]=$this->getDailyDate(14)->original;
        $data["return"]["data"]=$this->getDailyInvoiceCount(0,14)->original;

        return response()->json($data);
    }

    public function getDailyDate($selectedDay){
        $data=[];
        $now = Carbon::parse(Carbon::now()->addDay(1));
        $subDate = Carbon::parse(Carbon::now()->subDay($selectedDay));
        $period = CarbonPeriod::create($subDate,$now);

        $days=[];
        foreach ($period as  $day) {
            $days[]=$day->format('d/m/Y');
        }

        $data=$days;

        return response()->json($data);
    }

    public function getDailyInvoiceCount($type,$day){
        $data=[];

        $date = $this->getDailyDate($day)->original;

        foreach ($date as $key=>$value) {

            $sell = Invoice::where('user_id',$this->user->id)->whereDate('created_at','=',Carbon::today()->subDay($day)->addDay($key))->where('type',$type)->count();
            $data[]=$sell;
        }


        return response()->json($data);
    }

    public function mounthlySell(){
        $data=[];

        $data["sell"]["period"]=$this->getMounthlyDate(5)->original;
        $data["sell"]["data"]=$this->getMounthlyInvoiceCount(1,5)->original;
        $data["return"]["period"]=$this->getMounthlyDate(5)->original;
        $data["return"]["data"]=$this->getMounthlyInvoiceCount(0,5)->original;

        return response()->json($data);
    }

    public function getMounthlyDate($selectedMounth){
        $data=[];
        $now = Carbon::parse(Carbon::now()->addDay(1));
        $subDate = Carbon::parse(Carbon::now()->subMonths($selectedMounth));
        $period = CarbonPeriod::create($subDate,'1 month',$now);

        $days=[];
        foreach ($period as  $day) {
            $days[]=$day->format('d/m/Y');
        }

        $data=$days;

        return response()->json($data);
    }

    public function getMounthlyInvoiceCount($type,$mounth){
        $data=[];

        $date = $this->getMounthlyDate($mounth)->original;

        foreach ($date as $key=>$value) {
            $sell = Invoice::where('user_id',$this->user->id)->whereDate('created_at','<=',Carbon::now()->subMonth($mounth)->addMonth($key)->modify('last day of this month'))->whereDate('created_at','>=',Carbon::now()->subMonth($mounth)->addMonth($key)->modify('first day of this month'))->where('type',$type)->count();
            $data[]=$sell;
        }


        return response()->json($data);
    }

    public function lastInvoices(){
        $invoices = Invoice::with('getCustomer')->where('user_id',$this->user->id)->orderByDesc('id')->limit(10)->get();

        return response()->json($invoices);
    }
}

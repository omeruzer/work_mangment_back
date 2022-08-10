<?php

namespace App\Http\Controllers;

use App\Models\Current;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CurrentController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = User::where('id',1)->first();
    }

    public function index(){
        $current = Current::orderByDesc('id')->where('user_id',auth()->id());

        return response()->json($current->paginate(15));

    }

    public function add(){
        $current = Current::create([
            'user_id' => auth()->id(),
            'title' => request('title'),
            'type' => request('type'),
            'price' => request('price'),
            'desc' => request('desc'),
            'current_date' => request('current_date'),
        ]);

        return response()->json($current);
    }
    public function detail($id){
        $current = Current::where('id',$id)->first();

        return response()->json($current);
    }
    public function edit($id){
        $current = Current::where('id',$id)->update([
            'title' => request('title'),
            'type' => request('type'),
            'price' => request('price'),
            'desc' => request('desc'),
            'current_date' => request('current_date'),
        ]);

        return response()->json($current);
    }
    public function remove($id){
        $current = Current::where('id',$id)->delete();

        return response()->json($current);

    }

    public function currentCount(){
        $data=[];

        $todayTotalSell = Current::where('type',1)->where('user_id',auth()->id())->whereDate('current_date',Carbon::now())->get();
        $todayTotalReturn = Current::where('type',0)->where('user_id',auth()->id())->whereDate('current_date',Carbon::now())->get();
        $mounthTotalSell = Current::where('type',1)->where('user_id',auth()->id())->where('current_date','<=',Carbon::now())->where('current_date','>=',Carbon::now()->subDay(30))->get();
        $mounthTotalReturn = Current::where('type',0)->where('user_id',auth()->id())->where('current_date','<=',Carbon::now())->where('current_date','>=',Carbon::now()->subDay(30))->get();

        $todayTotalSellPrice=0;
        foreach ($todayTotalSell as $value) {
            $todayTotalSellPrice=$todayTotalSellPrice+$value->price;
        }

        $todayTotalReturnPrice=0;
        foreach ($todayTotalReturn as $value) {
            $todayTotalReturnPrice=$todayTotalReturnPrice+$value->price;
        }

        $mounthTotalSellPrice=0;
        foreach ($mounthTotalSell as $value) {
            $mounthTotalSellPrice=$mounthTotalSellPrice+$value->price;
        }
        $mounthTotalReturnPrice=0;
        foreach ($mounthTotalReturn as $value) {
            $mounthTotalReturnPrice=$mounthTotalReturnPrice+$value->price;
        }

        $data['today_total_sell']=$todayTotalSellPrice;
        $data['today_total_return']=$todayTotalReturnPrice;
        $data['last_mount_total_sell']=$mounthTotalSellPrice;
        $data['last_mount_total_return']=$mounthTotalReturnPrice;

        return response()->json($data);

    }
}

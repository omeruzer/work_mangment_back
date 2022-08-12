<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Invoice;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function getReportsSellReturnDaily(){
        $data=[];

        $data["sell"]["period"]=$this->getDailyDate(29)->original;
        $data["sell"]["data"]=$this->getDailyInvoiceCount(1,29)->original;
        $data["return"]["period"]=$this->getDailyDate(29)->original;
        $data["return"]["data"]=$this->getDailyInvoiceCount(0,29)->original;

        return response()->json($data);

    }

    public function getReportsSellReturnMounthly(){
        $data=[];

        $data["sell"]["period"]=$this->getMounthlyDate(11)->original;
        $data["sell"]["data"]=$this->getMounthlyInvoiceCount(1,11)->original;
        $data["return"]["period"]=$this->getMounthlyDate(11)->original;
        $data["return"]["data"]=$this->getMounthlyInvoiceCount(0,11)->original;

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
            $money=0;
            $sell = Invoice::where('user_id',auth()->id())->whereDate('invoice_date','<=',Carbon::now()->subMonth($mounth)->addMonth($key)->modify('last day of this month'))->whereDate('invoice_date','>=',Carbon::now()->subMonth($mounth)->addMonth($key)->modify('first day of this month'))->where('type',$type)->get();
            foreach ($sell as $key => $value) {
                $money=$money+$value->amount_db;
            }
            $data[]=$money;
        }


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
            $money=0;
            $sell = Invoice::where('user_id',auth()->id())->whereDate('invoice_date','=',Carbon::today()->subDay($day)->addDay($key))->where('type',$type)->get();
            foreach ($sell as $key => $value) {
                $money=$money+$value->amount_db;
            }
            $data[]=$money;
        }


        return response()->json($data);
    }

    public function brandReport(){
        $data=[];
        $brands = Brand::all();

        foreach ($brands as $key => $value) {
            $data['brands'][]=$value->name;
        }

        $data['sell'][]=1;

        return response()->json($data);
    }

    public function getModelReport($model){
        $data= $model;

        return response()->json($data);
    }

}

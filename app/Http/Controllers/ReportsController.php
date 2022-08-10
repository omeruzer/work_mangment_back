<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function getReportsSellReturn(){
        $data=[];

        $data["sell"]["period"]=$this->getDailyDate(29)->original;
        $data["sell"]["data"]=$this->getDailyInvoiceCount(0,29)->original;
        $data["return"]["period"]=$this->getDailyDate(29)->original;
        $data["return"]["data"]=$this->getDailyInvoiceCount(0,29)->original;

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

            $sell = Invoice::where('user_id',auth()->id())->whereDate('invoice_date','=',Carbon::today()->subDay($day)->addDay($key))->where('type',$type)->first('amount_db');
            $data[]=$sell==null?0:$sell->amount_db;
        }


        return response()->json($data);
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Invoice;
use App\Models\InvoiceProducts;
use App\Models\Material;
use App\Models\Pattern;
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
            $days[]=$day->format('m/Y');
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
            $sellingBrandCount=0;
            $totalSellCount=0;
            $data['brands'][]=$value->name;

            $invoices = InvoiceProducts::with(array('getProduct'=>function($q)use($value){
                $q->where('brand_id',$value->id);
            }))->get();

            foreach ($invoices as $key1 => $invoice) {
                if($invoice->getProduct!=null){
                    $sellingBrandCount=$sellingBrandCount+$invoice->qty;
                }
            }
            foreach ($invoices as $key1 => $invoice) {
                $totalSellCount=$totalSellCount+$invoice->qty;
            }

            $data['sell'][]= $sellingBrandCount*100/$totalSellCount;
        }

        return response()->json($data);
    }

    public function categoryReport(){
        $data=[];
        $categories = Category::all();

        foreach ($categories as $key => $value) {
            $totalSellCount = 0;
            $sellingCategoryCount=0;
            $data['category'][]=$value->name;

            $invoices = InvoiceProducts::with(array('getProduct'=>function($q)use($value){
                $q->where('category_id',$value->id);
            }))->get();

            foreach ($invoices as $key1 => $invoice) {
                if($invoice->getProduct!=null){
                    $sellingCategoryCount=$sellingCategoryCount+$invoice->qty;
                }
            }

            foreach ($invoices as $key1 => $invoice) {
                $totalSellCount=$totalSellCount+$invoice->qty;
            }

            $data['sell'][]= $sellingCategoryCount*100/$totalSellCount;
        }
        // dd($totalSellCount);
        return response()->json($data);
    }

    public function patternReport(){
        $data=[];
        $patterns = Pattern::all();


        foreach ($patterns as $key => $value) {
            $sellingPatternCount=0;
            $totalSellCount=0;
            $data['pattern'][]=$value->name;

            $invoices = InvoiceProducts::with(array('getProduct'=>function($q)use($value){
                $q->where('pattern_id',$value->id);
            }))->get();

            foreach ($invoices as $key1 => $invoice) {
                if($invoice->getProduct!=null){
                    $sellingPatternCount=$sellingPatternCount+$invoice->qty;
                }
            }

            foreach ($invoices as $key1 => $invoice) {
                $totalSellCount=$totalSellCount+$invoice->qty;
            }

            $data['sell'][]= $sellingPatternCount*100/$totalSellCount;
        }

        return response()->json($data);
    }

    public function materialReport(){
        $data=[];
        $materials = Material::all();


        foreach ($materials as $key => $value) {
            $sellingMaterialCount=0;
            $totalSellCount =0;
            $data['material'][]=$value->name;

            $invoices = InvoiceProducts::with(array('getProduct'=>function($q)use($value){
                $q->where('material_id',$value->id);
            }))->get();

            foreach ($invoices as $key1 => $invoice) {
                if($invoice->getProduct!=null){
                    $sellingMaterialCount=$sellingMaterialCount+$invoice->qty;
                }
            }
            foreach ($invoices as $key1 => $invoice) {
                $totalSellCount=$totalSellCount+$invoice->qty;
            }

            $data['sell'][]= $sellingMaterialCount*100/$totalSellCount;
        }

        return response()->json($data);
    }

    public function getModelReport($model){
        $data= $model;

        return response()->json($data);
    }

}

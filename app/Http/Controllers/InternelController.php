<?php

namespace App\Http\Controllers;

use App\Models\Internel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;

class InternelController extends Controller
{

    protected $user;

    public function __construct()
    {
        $this->user = User::where('id',1) ->first();
    }

    public function index(Request $request){
        Limit::perMinute(3);
        $internel = Internel::with('getDetail.getProduct')->orderByDesc('id')->where('user_id',auth()->id());

        if($request->has('type')){
            if($request->type=='1'){
                $internel->where('type',1);
            }else if($request->type=='2'){
                $internel->where('type',0);
            }
        }

        if($request->has('code')){
            $internel->where('internel_no','LIKE', '%' . $request->code . '%');
        }

        if($request->has('date')){
            if($request->date=='1'){
                $internel->whereDate('internel_date','=',Carbon::now());
            }else if($request->date=='2'){
                $internel->whereDate('internel_date','=',Carbon::now()->subDay(1));
            }else if($request->date=='3'){
                $internel->whereDate('internel_date','<=',Carbon::now())->whereDate('internel_date','>=',Carbon::now()->subDay(7));
            }else if($request->date=='4'){
                $internel->whereDate('internel_date','<=',Carbon::now())->whereDate('internel_date','>=',Carbon::now()->subDay(14));
            }else if($request->date=='5'){
               $internel->whereDate('internel_date','<=',Carbon::now())->whereDate('internel_date','>=',Carbon::now()->subDay(30));
            }
        }

        return response()->json($internel->paginate(15));

    }

    public function add(){
        $internel = Internel::create([
            'user_id' => auth()->id(),
            'internel_no'=>'D-00'.rand(1000,99999),
            'type'=>request('type'),
            'internel_date'=>request('internel_date')
        ]);

        return response()->json($internel);
    }

    public function detail($id){
        $internel = Internel::with("getDetail.getProduct")->where('id',$id)->first();

        return response()->json($internel);
    }
    public function edit($id){
        $internel = Internel::where('id',$id)->update([
            'type'=>request('type'),
            'internel_date'=>request('internel_date')
        ]);

        return response()->json($internel);
    }
    public function remove($id){
        $internel = Internel::where('id',$id)->delete();

        return response()->json($internel);

    }
}

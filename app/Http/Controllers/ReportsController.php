<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Helper;
use Illuminate\Support\Facades\Auth;

class ReportsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        if(Auth::user()->type == 1){
            $norges = DB::table('norgesenergi')->where('created_date', '>=', '2021-04-01 00:00:00')->get();
            return view('power-report', ['records' => $norges]);
        }else{
            return redirect('/storage-update');
        }
    }
    public function salesReport()
    {
        if(Auth::user()->type == 1){
            $allSales = DB::table('sales')->get();
            $sales    = DB::table('sales')->select(DB::raw('count(*) as total'), DB::raw('DATE(sales_date) as date'))->groupByRaw(DB::raw("DATE(sales_date)"))->get();

            $visitors  = DB::table('conversion')->select(DB::raw('count(*) as total'), DB::raw('SUM(conversion.sale = 1) as sales'), DB::raw('DATE(created_at) as date'))->groupByRaw(DB::raw("DATE(created_at)"))->get();

            return view('sales-report', ['records' => $sales, 'allSales' => $allSales, "conversion" => $visitors]);
        }else{
            return redirect('/storage-update');
        }
    }
    public function offersReport()
    {
        if(Auth::user()->type == 1){
            $strom    = DB::table('offers')->select(DB::raw('count(*) as total'), DB::raw('DATE(created_at) as date'))->where("service", "Strom")->groupByRaw(DB::raw("DATE(created_at)"))->get();
            $tv    = DB::table('offers')->select(DB::raw('count(*) as total'), DB::raw('DATE(created_at) as date'))->where("service", "TV")->groupByRaw(DB::raw("DATE(created_at)"))->get();
            $flyttevask    = DB::table('offers')->select(DB::raw('count(*) as total'), DB::raw('DATE(created_at) as date'))->where("service", "Flyttevask")->groupByRaw(DB::raw("DATE(created_at)"))->get();
            $boligalarm    = DB::table('offers')->select(DB::raw('count(*) as total'), DB::raw('DATE(created_at) as date'))->where("service", "Boligalarm")->groupByRaw(DB::raw("DATE(created_at)"))->get();

            return view('offers-report', ['stromObj' => $strom, 'tvObj' => $tv, 'flyttevaskObj' => $flyttevask, 'boligalarmObj' => $boligalarm]);
        }else{
            return redirect('/storage-update');
        }
    }

    public function conversionReport(){
        if(Auth::user()->type == 1){
            $strom    = DB::table('offers')->select(DB::raw('count(*) as total'), DB::raw('DATE(created_at) as date'))->where("service", "Strom")->groupByRaw(DB::raw("DATE(created_at)"))->get();
            $tv    = DB::table('offers')->select(DB::raw('count(*) as total'), DB::raw('DATE(created_at) as date'))->where("service", "TV")->groupByRaw(DB::raw("DATE(created_at)"))->get();
            $flyttevask    = DB::table('offers')->select(DB::raw('count(*) as total'), DB::raw('DATE(created_at) as date'))->where("service", "Flyttevask")->groupByRaw(DB::raw("DATE(created_at)"))->get();
            $boligalarm    = DB::table('offers')->select(DB::raw('count(*) as total'), DB::raw('DATE(created_at) as date'))->where("service", "Boligalarm")->groupByRaw(DB::raw("DATE(created_at)"))->get();

            return view('offers-report', ['stromObj' => $strom, 'tvObj' => $tv, 'flyttevaskObj' => $flyttevask, 'boligalarmObj' => $boligalarm]);
        }else{
            return redirect('/storage-update');
        } 
    }

    public function updateNorges()
    {
        $sales = DB::table('norgesenergi')->where("responded", 0)->get();

        foreach ($sales as $sale) {
            $list =  Helper::storageStatus(Helper::getToken(), $sale->storage_token, "lead");
            $obj = json_decode($list);

            if($obj->_status != 150){
                foreach ($obj->_storage_status_list as $key => $value) {

                    if($value->detail == "+47".$sale->phone_number.":ja"){
                        DB::table('norgesenergi')->where('id', $sale->id)->update(['responded' => 1]);
                    }
                }
            }
        }

        return redirect('/power-report');
    }
}

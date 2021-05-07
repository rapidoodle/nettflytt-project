<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Helper;

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
        $norges = DB::table('norgesenergi')->where('created_date', '>=', '2021-04-01 00:00:00')->get();
        return view('power-report', ['records' => $norges]);
    }
    public function salesReport()
    {
        // $sales = DB::table('sales')->get();
        $sales = DB::table('sales')->select(DB::raw('count(*) as total'), DB::raw('DATE(sales_date) as date'))->groupByRaw(DB::raw("DATE(sales_date)"))->get();
        return view('sales-report', ['records' => $sales]);
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

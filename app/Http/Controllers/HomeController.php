<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Helper;

class HomeController extends Controller
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
        return view('home', ['records' => $norges]);
    }
    public function salesReport()
    {
        $sales = DB::table('sales')->get();
        return view('sales-report', ['records' => $sales]);
    }
    public function updateNorges()
    {
        $sales = DB::table('norgesenergi')->where("responded", 0)->get();

        // foreach ($sales as $sale) {
            // var_dump($sale->storage_token);
            // echo $sale->storage_token;
            echo $list =  Helper::storageStatus(Helper::getToken(), "GgV4j4X8VEXEL9xrMrmmu1qglw9NduRVpeFwdwawAaIl2np0b2abS66cWUrCbJFt
", "info");
            // echo "<br>";
        // }
        // return view('sales-report', ['records' => $sales]);
    }
}

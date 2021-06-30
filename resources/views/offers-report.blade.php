@extends('layouts.app')

@section('content')<?php
 
$strom      = array();
$tv         = array();
$flyttevask = array();
$boligalarm = array();
$allOffers  = array();

 foreach ($stromObj as $key => $value) {
        $strom[]      = array("y" => $value->total, "x" => strtotime($value->date) * 1000);
        $allOffers[]  = array("title" => "Strom", "total" => $value->total, "date" => $value->date);
 }

 foreach ($tvObj as $key => $value) {
        $tv[]         = array("y" => $value->total, "x" => strtotime($value->date) * 1000);
        $allOffers[]  = array("title" => "TV", "total" => $value->total, "date" => $value->date);
 }

 foreach ($flyttevaskObj as $key => $value) {
        $flyttevask[] = array("y" => $value->total, "x" => strtotime($value->date) * 1000);
        $allOffers[]  = array("title" => "Flyttevask", "total" => $value->total, "date" => $value->date);
 }

 foreach ($boligalarmObj as $key => $value) {
        $boligalarm[] = array("y" => $value->total, "x" => strtotime($value->date) * 1000);
        $allOffers[]  = array("title" => "Boligalarm", "total" => $value->total, "date" => $value->date);
 }

?>
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link active" id="offers-tab" data-toggle="tab" href="#offers" role="tab" aria-controls="offers" aria-selected="true">Offers Report</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="files-tab" data-toggle="tab" href="#files" role="tab" aria-controls="files" aria-selected="false">Downloads</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="chart-tab" data-toggle="tab" href="#chart" role="tab" aria-controls="chart" aria-selected="false">Chart</a>
    </li>
</ul>
<div class="tab-content w-100 pt-4" id="myTabContent">
    <div class="tab-pane fade show active" id="offers" role="tabpanel" aria-labelledby="offers-tab">
        <table id="offersTable1" class="display table mt-4" style="width:100%">
            <thead>
                <tr>
                    <th>Service</th>
                    <th>Total</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($allOffers as $offers)
                    <tr>
                        <td>{{$offers['title']}}</td>
                        <td>{{$offers['total']}}</td>
                        <td>{{$offers['date']}}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Service</th>
                    <th>Total</th>
                    <th>Date</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="tab-pane fade show" id="files" role="tabpanel" aria-labelledby="files-tab">
        <table>
            <tr>
                <th>Files</th>
            </tr>
            <tr>
                <td><a href="{{ asset('files/Strom.csv')}}" target="_blank">Strom</a></td>
            </tr>
            <tr>
                <td><a href="{{ asset('files/TV.csv')}}" target="_blank">TV</a></td>
            </tr>
            <tr>
                <td><a href="{{ asset('files/Flyttevask.csv')}}" target="_blank">Flyttevask</a></td>
            </tr>
            <tr>
                <td><a href="{{ asset('files/Boligalarm.csv')}}" target="_blank">Boligalarm</a></td>
            </tr>
        </table>
    </div>
    <div class="tab-pane fade show" id="chart" role="tabpanel" aria-labelledby="chart-tab">
        <div id="chartContainer" class="w-100 mt-4" style="width: 100%!important;"></div>
    </div>
</div>
<script type="application/javascript">
window.onload = function() {
    var chart = new CanvasJS.Chart("chartContainer", {
    title:{
        text: "Offers Total Report"
    },
    toolTip: {
        shared: true
    },
    legend: {
        cursor: "pointer"
    },
    data: [{
        type: "line",
        name: "Strom",
        color: "#369EAD",
        showInLegend: true,
        interval:1, 
        intervalType: "day",
        xValueType : "dateTime",
        dataPoints: <?php echo json_encode($strom); ?>
    },
    {
        type: "line",
        name: "TV",
        color: "#C24642",
        interval:1, 
        intervalType: "day",
        xValueType : "dateTime",
        showInLegend: true,
        dataPoints: <?php echo json_encode($tv); ?>
    },
    {
        type: "line",
        name: "Flyttevask",
        color: "#7F6084",
        interval:1, 
        intervalType: "day",
        xValueType : "dateTime",
        showInLegend: true,
        dataPoints: <?php echo json_encode($flyttevask); ?>
    },
    {
        type: "line",
        name: "Boligalarm",
        color: "#00ff00",
        interval:1, 
        intervalType: "day",
        xValueType : "dateTime",
        showInLegend: true,
        dataPoints: <?php echo json_encode($boligalarm); ?>
    }]
});
chart.render();
 
}


</script>
@endsection

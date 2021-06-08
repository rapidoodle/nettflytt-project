@extends('layouts.app')

@section('content')<?php
 
$strom      = array();
$tv         = array();
$flyttevask = array();
$boligalarm = array();

 foreach ($stromObj as $key => $value) {
        $strom[]      = array("y" => $value->total, "x" => strtotime($value->date) * 1000);
 }

 foreach ($tvObj as $key => $value) {
        $tv[]      = array("y" => $value->total, "x" => strtotime($value->date) * 1000);
 }

 foreach ($flyttevaskObj as $key => $value) {
        $flyttevask[]      = array("y" => $value->total, "x" => strtotime($value->date) * 1000);
 }

 foreach ($boligalarmObj as $key => $value) {
        $boligalarm[]      = array("y" => $value->total, "x" => strtotime($value->date) * 1000);
 }

?>
<div class="tab-content w-100 pt-4" id="myTabContent">
    <div id="chartContainer" class="w-100 mt-4" style="width: 100%!important;"></div>
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

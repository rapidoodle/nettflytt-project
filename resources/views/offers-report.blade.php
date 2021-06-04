@extends('layouts.app')

@section('content')<?php
 
$strom      = array();
$tv         = array();
$flyttevask = array();
$boligalarm = array();

 foreach ($stromObj as $key => $value) {
        $strom[]      = array("y" => $value->total, "x" => $value->date);
 }

 foreach ($tvObj as $key => $value) {
        $tv[]      = array("y" => $value->total, "x" => $value->date);
 }

 foreach ($flyttevaskObj as $key => $value) {
        $flyttevask[]      = array("y" => $value->total, "x" => $value->date);
 }

 foreach ($boligalarmObj as $key => $value) {
        $boligalarm[]      = array("y" => $value->total, "x" => $value->date);
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
        axisYIndex: 1,
        dataPoints: <?php echo json_encode($strom, JSON_NUMERIC_CHECK); ?>
    },
    {
        type: "line",
        name: "TV",
        color: "#C24642",
        axisYIndex: 0,
        showInLegend: true,
        dataPoints: <?php echo json_encode($tv, JSON_NUMERIC_CHECK); ?>
    },
    {
        type: "line",
        name: "Flyttevask",
        color: "#7F6084",
        axisYType: "secondary",
        showInLegend: true,
        dataPoints: <?php echo json_encode($flyttevask, JSON_NUMERIC_CHECK); ?>
    },
    {
        type: "line",
        name: "Boligalarm",
        color: "#7F6084",
        axisYType: "secondary",
        showInLegend: true,
        dataPoints: <?php echo json_encode($boligalarm, JSON_NUMERIC_CHECK); ?>
    }]
});
chart.render();
 
}


</script>
@endsection

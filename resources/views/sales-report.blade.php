@extends('layouts.app')

@section('content')<?php
 
$dataPoints = array();
 foreach ($records as $key => $value) {
     $dataPoints[] = array("y" => $value->total, "label" => $value->date);
 }
?>
<div class="card">
        <div id="chartContainer" style="width: 100%;"></div>
</div>

<script type="application/javascript">
window.onload = function() {
 
var chart = new CanvasJS.Chart("chartContainer", {
    animationEnabled: true,
    theme: "light2",
    title:{
        text: "Sales Report"
    },
    axisY: {
        title: "Total Sales Per Day"
    },
    data: [{
        type: "column",
        yValueFormatString: "#,##0.## sales",
        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
    }]
});
chart.render();
 
}
</script>
@endsection

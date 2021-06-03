@extends('layouts.app')

@section('content')<?php
 
$dataPoints = array();
 foreach ($records as $key => $value) {
     $dataPoints[] = array("y" => $value->total, "label" => $value->date);
 }
?>
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Sales Report</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Chart</a>
    </li>
</ul>
<div class="tab-content w-100 pt-4" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <table id="reportTable2" class="display table mt-4" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Total</th>
                    <th>Sales date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($allSales as $data)
                    <tr>
                        <td>{{$data->name}}</td>
                        <td>{{$data->phone_number}}</td>
                        <td>{{$data->email}}</td>
                        <td>{{$data->total_price}}</td>
                        <td>{{$data->sales_date}}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Total</th>
                    <th>Sales date</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <div id="chartContainer" class="w-100 mt-4" style="width: 100%!important;"></div>
    </div>
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

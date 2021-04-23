@extends('layouts.app')

@section('content')
<script type="application/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="application/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script type="application/javascript">
    $(document).ready(function() {
        $('#reportTable').DataTable( {
            columnDefs: [ { type: 'date', 'targets': [3] } ],
            order: [[ 4, 'desc' ]],
            "bDestroy": true 
        });
    });
</script>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">{{ __('Menu') }}</div>
                <div class="card-body">
                    <ul>
                        <li><a href="/sales-report">Sales Report</a></li>
                        <li class="active"><a href="/home">Norges Energi Subscription</a></li>
                    </ul>
                </div>
            </div>
            
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{ __('Sales Report') }}</div>
                <div class="card-body">
                    <table id="reportTable" class="display table" style="width:100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Postbox</th>
                                <th>No Advertisement</th>
                                <th>Total Price</th>
                                <th>Provider</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($records as $data)
                                <tr>
                                    <td>{{$data->name}}</td>
                                    <td>{{$data->email}}</td>
                                    <td>{{$data->phone_number}}</td>
                                    <td>{{$data->is_postbox}}</td>
                                    <td>{{$data->is_advertise}}</td>
                                    <td>{{$data->total_price}}</td>
                                    <td>{{$data->provider}}</td>
                                    <td>{{$data->sales_date}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Postbox</th>
                                <th>No Advertisement</th>
                                <th>Total Price</th>
                                <th>Provider</th>
                                <th>Date</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

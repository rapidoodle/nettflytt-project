@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">{{ __('Sales Report') }}</div>
    <div class="card-body">
        <table id="reportTable2" class="display table" style="width:100%">
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
@endsection

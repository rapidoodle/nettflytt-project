@extends('layouts.app')

@section('content')
<script type="application/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="application/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script type="application/javascript">
    $(document).ready(function() {
        $('#reportTable').DataTable( {
            columnDefs: [ { type: 'date', 'targets': [3] } ],
            order: [[ 5, 'desc' ]],
            "bDestroy": true 
        });
    });
</script>
<div class="card">
    <div class="card-header">
        <form action="/update-norges" method="post">
            @csrf
            <span class="float-left">{{ __('Norges Energi Subscription') }}</span>
            <button type="submit" value="submit" class="btn btn-info btn-md float-right">Refresh</button>
        </form>
    </div>
    <div class="card-body">
        <table id="reportTable" class="display table" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Responded</th>
                    <th>Type</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($records as $data)
                    <tr>
                        <td>{{$data->name}}</td>
                        <td>{{$data->email}}</td>
                        <td>{{$data->phone_number}}</td>
                        <td>{{$data->responded}}</td>
                        <td>{{$data->type == 1 ? "Topp 5 garanti" : ($data->type == 2 ? "Strøm til lavpris" : "N/A")}}</td>
                        <td>{{$data->created_date}}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Responded</th>
                    <th>Type</th>
                    <th>Date</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection

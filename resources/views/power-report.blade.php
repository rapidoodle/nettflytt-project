@extends('layouts.app')

@section('content')
<input type="hidden" id="csrf" value="{{ csrf_token() }}">
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
                    <th>Responded</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($records as $data)
                <?php
                    $type =$data->type == 1 ? "Topp 5 garanti" : ($data->type == 2 ? "Strøm til lavpris" : ($data->type == 3 ? "Strøm til Lavpris (Kampanje)" : ( $data->type == 4 ? "Sesongpris" : ($data->type == 5 ? "(Kampanje)" : "N/A"))));
                ?>
                    <tr>
                        <td>{{$data->name}}</td>
                        <td>{{$data->email}}</td>
                        <td>{{$data->responded}}</td>
                        <td>{{$type}}</td>
                        <td>{{$data->created_date}}</td>
                        <td><button class="btn btn-sm btn-success get-storage" data-token="{{$data->storage_token}}" data-modal="powerModal" data-table="powerTable" data-title="powerTitle" data-type="{{$type}}">View</button></td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Responded</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
    <!--CONFIRMATION MODAL-->
    <div class="modal fade" id="powerModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="text-center modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

          <div class="modal-body mt-4">
            <div class="text-center mb-4">
                <h5 class="modal-title powerTitle"></h5>            
            </div>
            <table class="table table-striped table-bordered powerTable text-align-left">
                <tr>
                    <td><b>LOADING CUSTOMER DATA..</b></td>
                </tr>
            </table>
          </div>
          <div class="modal-footer text-center">
          </div>
        </div>
      </div>
    </div>
@endsection

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
        <span class="float-left">{{ __('Storage Update By Search') }}</span>
    </div>
    <div class="card-body">
        <form action="/search-storage" method="post">
            @csrf
            <table>
                <tr>
                    <td><input type="text" name="query" class="form-control" id="query" placeholder="Search phone number"></td>
                    <td><input type="submit" name="submit" class="btn btn-info" value="Go"></td>
                </tr>
            </table>
        </form>

        @if(isset($response['searchResult']))
        <div class="card mt-4">
            <div class="card-header">
                Please select storage to edit:
            </div>
            <div class="card-body">
                @foreach($response['result']->sids as $key => $sid)
                <form action="/select-update" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="token" value="{{$sid}}">
                    <table>
                        <tr>
                            <td width="100"><b>{{$key}}</b></td>
                            <td><button type="submit" class="btn btn-danger btn-sm">Edit</button></td>
                        </tr>
                    </table>
                </form>
                @endforeach
            </div>
        </div>
        @endif

        @if(isset($response['error']) && $response['error'] == 0)
        <form action="/save-storage" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <table class="mt-4">
            <?php $count = 0; 
            $storage = json_decode($response['storage']);
            ?>
             @foreach( $storage as $key => $value)
                @if(!is_object($value) && !is_array($value))
                <?php 
                    $key = str_replace(array("_", "-"), " ", $key);
                    $key = ucfirst(strtolower($key));
                ?>
                <tr>
                    <td width="10%">{{$key}}</td>
                    <td><input type="text" name="{{strtolower($key)}}" value="{{$value}}" class="form-control"></td>
                </tr>
                @endif
            @endforeach

            </table>
            <button type="submit" name="submit" class="btn btn-primary">Update</button>
        </form>
        @endif
    </div>
</div>
@endsection

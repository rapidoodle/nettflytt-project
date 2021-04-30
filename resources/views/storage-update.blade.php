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
                    <td><input type="text" name="query" class="form-control" id="query" placeholder="Search"></td>
                    <td><input type="submit" name="submit" class="btn btn-info" value="Go"></td>
                </tr>
            </table>
        </form>
    </div>
</div>
@endsection

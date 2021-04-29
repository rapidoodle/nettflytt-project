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
            <span class="float-left">{{ __('Storage Update By Search') }}</span>
        </form>
    </div>
    <div class="card-body">
        <form action="/get-storage" method="post">
            
        </form>
    </div>
</div>
@endsection

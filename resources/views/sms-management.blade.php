@extends('layouts.app')

@section('content')<?php
 
?>
<div class="card">
    <div class="card-header">Norges Energi SMS List</div>
    <div class="card-body">

        <table class="w-100">
            <tr>
                <th width="50px">Type</th>
                <th width="100px">Sender</th>
                <th>Message</th>
            </tr>
        </table>
        @foreach($sms as $text)
        <form action="/save-sms" method="POST">
            @csrf
            <table class="table table-hovered">
                <tr>
                    <td width="50px"><input type="hidden" value="{{$text->id}}" name="id">{{$text->type}}</td>
                    <td width="100px"><input type="text" value="{{$text->sender}}" name="sender" class="form-control" required=""></td>
                    <td><textarea name="text" class="form-control h-150px" required="">{{$text->text}}</textarea></td>
                    <td><input type="submit" name="submit" class="btn btn-sm btn-info text-white" value="Save"></td>
                </tr>
            </table>
        </form>
            @endforeach
    </div>
</div>

@endsection

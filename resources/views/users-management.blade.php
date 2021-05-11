@extends('layouts.app')

@section('content')<?php
 
?>
<div class="card">
    <div class="card-header">Users Management</div>
    <div class="card-body">
        <h5>Add New User</h5>
        <form action="/create-user" method="POST">
            @csrf
            <table class="table table-hovered mb-4">
                <tr>
                    <td><input type="text" name="name" class="form-control" required placeholder="Full name"></td>
                    <td><input type="email" name="email" class="form-control" required placeholder="Email"></td>
                    <td><input type="password" name="password" class="form-control" required placeholder="Password"></td>
                    <td><select name="type" class="form-control" requred>
                        <option value="2">Customer Service</option>
                        <option value="1">Admin</option>
                    </select></td>
                    <td><input type="submit" class="btn btn-success btn-block btn-sm" name="add" value="Add New"></td>
                </tr>
            </table>
        </form>
        <h5>Edit Users</h5>
        <table class="table table-hovered">
        @foreach($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td><select name="type" class="form-control">
                    <option value="2" {{$user->type == 2 ? "selected='selected'" : ""}}>Customer Service</option>
                    <option value="1" {{$user->type == 1 ? "selected='selected'" : ""}}>Admin</option>
                </select></td>
                <td><input type="submit" class="btn btn-info btn-block btn-sm" name="add" value="Save"></td>
            </tr>
        @endforeach
        </table>
    </div>
</div>

@endsection

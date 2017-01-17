@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Dashboard</div>

        <div class="panel-body">
            <div class="jumbotron">
                <h1>Hello, {{ Auth::user()->name }}!</h1>
                <h3 class="text-primary">Welcome to Laravel 5.3 TODO APP</h3>
            </div>
        </div>
    </div>

@endsection

<!--@extends('layouts.apps')
@section('content')-->
@include('layouts.Sidebar')
@section('content')
<!--<h1>Home : {{ Auth::user()->name}}</h1>-->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    wellcome to user Dashboard.
                    <h1>Home : {{ Auth::user()->name}}</h1>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
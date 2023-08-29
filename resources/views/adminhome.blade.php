<!--@extends('layouts.apps')-->
@include('layouts.Sidebar')
@section('content')
<!--<h1>users: {{ Auth::user()->name}}</h1>-->
<div class="container">
    <!--<h1>users: {{ Auth::user()->name}}</h1>-->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    wellcome Admin Plane

                    <h1>user: {{ Auth::user()->name}}</h1>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
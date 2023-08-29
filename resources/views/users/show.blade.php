@extends('layouts.app')
@include('layouts.sidebar')
@section('content')

<h3>Users detail</h3>
<a href="{{ route('users.index') }}" class="btn btn-dark mb-2">BACK</a>

<div class="row">
    <div class="col-sm-4">
        <label>Name</label>
        <p>{{ $user->name }}</p>
    </div>
    <div class="col-sm-4">
        <label>Email</label>
        <p>{{ $user->email }}</p>
    </div>
    <div class="col-sm-4">
        <label>Image</label>
        <p>{{ $user->image }}</p>
        <img src="/images/{{ $user->image }}" width="300px">
    </div>
    <div class="col-sm-4">
        <label>Roles</label>
        <p>@foreach( $user->roles as $role )
            {{ $role->name }} {{ !$loop->last ? ',' : ''}}
            @endforeach
        </p>
    </div>
</div>

@endsection
@extends('layouts.app')
@include('layouts.sidebar')
@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit User</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
        </div>
    </div>
</div>


<!--@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif-->
<!--<h3>Edit Users</h3>-->
<!--<a href="{{ route('users.index') }}" class="btn btn-dark mb-2">BACK</a>-->

<form action="{{ route('users.update' , $user->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" value="{{$user->name}}" />
        @error('name')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="name">Email</label>
        <input type="text" name="email" class="form-control" value="{{$user->email}}" />
        @error('email')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="name">Password</label>
        <input type="password" name="password" class="form-control" value="{{$user->password}}" />
        @error('password')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" name="image" class="form-control" placeholder="image">
        <img src="/images/{{ $user->image }}" width="300px">
        @error('image')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
        <div class="form-group">
        <label for="roles">Role</label><br>
        <select id="exampleSelect" class="form-control" multiple="multiple" name="roles[]">
            @foreach( $roles as $role )
            <option value="{{$role->id}}" @if(in_array($role->id , $user->roles->pluck('id')->toArray()))
                selected @endif>{{ $role->name }}</option>
            @endforeach
        </select>
        @error('role')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <button type="submit" class="btn btn-dark px-4">update User</button>
</form>
@endsection
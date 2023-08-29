@extends('layouts.app')
@include('layouts.sidebar')
@section('content')

<!--<h3>Add New Users</h3>-->
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Create New Users</h2>
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
<!--<a href="{{ route('users.index') }}" class="btn btn-dark mb-2">BACK</a>-->

<form action="{{ route('users.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" />
        @error('name')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="name">Email</label>
        <input type="text" name="email" class="form-control" />
        @error('email')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="name">Password</label>
        <input type="password" name="password" class="form-control" />
        @error('password')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <!--<div class="form-group">
        <label for="roles"> Select Roles</label><br>
         <select name="roles" id="roles" multiple="multiple" name="roles[]">
        <select class="selectpicker" multiple="multiple" name="roles[]">
            @foreach( $roles as $role )
            <option value="{{$role->id}}">{{ $role->name }}</option>
            @endforeach
        </select>
        @error('role')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>-->
    
    <div class="form-group">
        <label for="roles">Role</label><br>
        <select id="exampleSelect"  class="form-control" multiple="multiple" name="roles[]">
            @foreach( $roles as $role )
            <option value="{{$role->id}}">{{ $role->name }}</option>
            @endforeach
        </select>
        @error('role')
            <span class="text-danger">{{ $message }}</span>
            @enderror
    </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" class="form-control" />
            @error('Image')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-dark px-4">Create User</button>
</form>
@endsection
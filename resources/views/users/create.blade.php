@extends('layouts.app')
@section('content')

<h3>Add New Users</h3>
<a href="{{ route('users.index') }}" class="btn btn-dark mb-2">BACK</a>

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

    <div class="form-group">
        <label for="roles">Roles</label>
        <select class="selectpicker " multiple name="roles[]">
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
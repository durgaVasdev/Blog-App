@extends('layouts.app')
@section('content')

<h3>Edit Users</h3>

<form action="{{ route('users.update' , $user->id)}}" method="POST" enctype="multipart/form-data">
    @csrf 
   @method('PUT')
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" value="{{$user->name}}"/>
        @error('name')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="name">Email</label>
        <input type="text" name="email" class="form-control" value="{{$user->email}}"/>
        @error('email')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="name">Password</label>
        <input type="password" name="password" class="form-control" value="{{$user->password}}"/>
        @error('password')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="name">Image</label>
        <input type="file" name="image" class="form-control" placeholder="image">
                    <img src="/image/{{ $user->image }}" width="300px">
        @error('password')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    
    <div class="form-group">
        <label for="roles">Roles</label>
        <select class="form-control" multiple name="roles[]">
            @foreach( $roles as $role )
            <option
             value="{{$role->id}}"
            @if(in_array($role->id , $user->roles->pluck('id')->toArray()))
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

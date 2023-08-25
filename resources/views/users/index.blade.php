@extends('layouts.app')
@include('layouts.sidebar')
@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>User Management</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('users.create') }}"> Create New Users</a>
        </div>
    </div>
</div>

<!--@if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif-->
@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif
<table class="table  table-bordered table-hover">
    <thead>
        <tr>
            <th>$.no</th>
            <th>Name</th>
            <th>Email</th>
            <th>Roles</th>
            <th>Image</th>
            <th>Action</th>

        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>

                @foreach( $user->roles as $role )
                {{ $role->name }} {{ !$loop->last ? ',' : ''}}
                @endforeach
            </td>
            <td><img src="{{ asset('images/'."$user->image") }}" width="100px"></td>

            <td>
                <a href="{{ route('users.show', $user->id)}}" class="btn btn-sm btn-dark">View</a>
                <a href="{{ route('users.edit',$user->id)}}" class="btn btn-sm btn-dark">Edit</a>
                <form action="{{ route('users.destroy', $user->id)}}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </td>
        </tr>
        @endforeach
    </tbody>

</table>
@endsection
@extends('layouts.Aapp')
@section('content')

<!--<h3 style="text-align: center;">All Users</h3>-->
<!--a href="{{ route('users.create') }}" class="btn btn-dark mb-2">Add User</a>-->

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
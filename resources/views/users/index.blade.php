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

<form id="search-form" action={{route("users.index") }}>
<label for="name">Name:</label>
<input type="text" id="name" name="name" placeholder="Enter Name">

<label for="email">Email:</label>
<input type="text" id="email" name="email" placeholder="Enter Email">

<label for="role">Select Role:</label>
<select id="role" name="role">
    <option value="">Select Role</option>
    @foreach ($roles as $role)
        <option value="{{ $role->id }}">{{ $role->name }}</option>
    @endforeach
</select>

<label for="last_seen">Select Last Seen:</label>
        <select id="last_seen" name="last_seen">
            <option value="">Select Last Seen</option>
            @foreach ($lastSeenOptions as $option)
                <option value="{{ $option }}">{{ $option }}</option>
            @endforeach
        </select>

<button type="submit">Search</button>
</form>










    


<table class="table  table-bordered table-hover">
    
        <tr>
            <th>$.no</th>
            <th>Name</th>
            <th>Email</th>
            <th>Roles</th>
            <th>Image</th>
            <th>Last Seen</th>
            <th></th>
            <th>product</th>
            <th>Action</th>

        </tr>
    </thead>
    <tbody id="search-results">
        
        
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
                @if(Cache::has('user-is-online-' . $user->id))
                    <span class="text-success">Online</span>
                @else
                    <span class="text-secondary">Offline</span>
                @endif
            </td>
            <td>{{ \Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}</td>
         
            <td>

                @foreach( $user->products as $product )
                {{ $product->name }} {{ !$loop->last ? ',' : ''}}
            
                @endforeach
            </td>


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
@push('script')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script type="text/javascript">
$(document).ready(function() {
            $('#search-form').submit(function(event) {
                event.preventDefault(); // Prevent the default form submission

                var formData = $(this).serialize(); // Serialize the form data
        
                 $.ajax({
                    type: 'GET',
                    url: $(this).attr('action'),
                    data: formData,
                    success: function(data) {
                        $('#search-results').html(data); // Display search results in the div
                    },
                    error: function(error) {
                        console.log(error);
                    }
                }); 
            });
        });


</script>
@endpush


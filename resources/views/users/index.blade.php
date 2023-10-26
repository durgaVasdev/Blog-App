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


    <form>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" id="name" placeholder="Enter Name">

        <label for="email">Email:</label>
        <input type="text" id="email" name="email" id="email" placeholder="Enter Email">

        <label for="role">Select Role:</label>
        <select id="role" name="role">
            <option value="">Select Role</option>
            @foreach ($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
        </select>

        <button id="search-form" type="submit">Search</button>
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
            <!-- <th>product</th>-->
            <th>Action</th>

        </tr>
        </thead>

        @include('users.user-list')
    </table>
    {{-- <script type="text/javascript">
        $(document).ready(function() {
            $('#search-form').on('click', function(e) {
                e.preventDefault();
                var name = $('#name').val();
                var email = $('#email').val();
                var role = $('#role').val();
                var last_seen = $('#last_seen').val();

                // Check if any search criteria is entered
                if (name || email || role ||last_seen) {
                    $.ajax({
                        type: 'GET',
                        url: '{{ route('users.index') }}',
                        data: {
                            name: name,
                            email: email,
                            role: role,
                            last_seen: last_seen
                        },
                        success: function(data) {
                            // Replace the user list with the updated data
                            $('#user-list').html(data);
                        },
                        error: function(xhr) {
                            // Handle errors if needed
                            console.log(xhr.responseText);
                        }
                    });
                } else {
                    // If no criteria entered, show all users
                    $.ajax({
                        type: 'GET',
                        url: '{{ route('users.index') }}',
                        success: function(data) {
                            // Replace the user list with the original data
                            $('#user-list').html(data);
                        },
                        error: function(xhr) {
                            // Handle errors if needed
                            console.log(xhr.responseText);
                        }
                    });
                }
            });
        });
    </script> --}}

    <!--jquery code-->

    <!--<script type="text/javascript">
        $(document).ready(function() {
            $('#search-form').on('click', function(e) {
                e.preventDefault();
                var name = $('#name').val();
                var email = $('#email').val();
                //var role = $('#role').val();


                // Check if any search criteria is entered
                if (name || email) {
                    $.ajax({
                        type: 'GET',
                        url: '{{ route('users.index') }}',
                        data: {
                            name: name,
                            email: email,
                            //role: role,
                            //last_seen: last_seen
                        },
                        success: function(response) {
                            // Replace the user list with the updated data

                            var users = response.data;

                            console.log(users);

                            var html = '';
                            if (users.length > 0) {
                                for (let i = 0; i < users.length; i++) {


                                    html += '<tr>\
                                                                <td>' + users[i]['id'] + '</td>\
                                                                <td>' + users[i]['name'] + '</td>\
                                                                <td>' + users[i]['email'] + '</td>\
                                                            <td>Admin</td>\


                                        <
                                        /tr>';
                                }

                            } else {
                                html += '<tr>\
                                                            <td> No users found </td>\
                                                            </tr>';
                            }
                            $('#user-list').html(html);
                        },
                        error: function(xhr) {
                            // Handle errors if needed
                            console.log(xhr.responseText);
                        }
                    });


                } else {
                    // If no criteria entered, show all users
                    $.ajax({
                        type: 'GET',
                        url: '{{ route('users.index') }}',
                        success: function(response) {
                            // Replace the user list with the original data
                            //$('#user-list').html(data);
                            var users = response.data;
                            console.log(users);

                            var html = '';
                            if (users.length > 0) {
                                for (let i = 0; i < users.length; i++) {

                                    html += '<tr>\
                                                                <td>' + users[i]['id'] + '</td>\
                                                                <td>' + users[i]['name'] + '</td>\
                                                                <td>' + users[i]['email'] + '</td>\
                                                                <td>Admin</td>\
                                                                 </tr>';
                                }

                            } else {
                                html += '<tr>\
                                                            <td> No users found </td>\
                                                            </tr>';
                            }
                            $('#user-list').html(html);
                        },
                        error: function(xhr) {
                            // Handle errors if needed
                            console.log(xhr.responseText);
                        }
                    });
                }

            });
        });
    </script>-->


    <!-- <script type="text/javascript">
        $(document).ready(function() {
            $('#search-form').on('click', function(e) {
                e.preventDefault();
                var name = $('#name').val();
                var email = $('#email').val();
                var role = $('#role').val();


                // Check if any search criteria is entered
                if (name || email) {
                    $.ajax({
                        type: 'GET',
                        url: '{{ route('users.index') }}',
                        data: {
                            name: name,
                            email: email,
                            //role: role,
                            //last_seen: last_seen
                        },
                        success: function(response) {
                            // Replace the user list with the updated data

                            var users = response.data;
                            console.log(users);

                            var html = '';
                            if (users.length > 0) {
                                for (let i = 0; i < users.length; i++) {
                                    var img = users[i]['image'];
                                    var src = `{{ asset('images/`+img+`') }}`
                                    var userId = users[i]['id'];
                                    var href = `{{ route('users.edit', ':userId') }}`;
                                    href = href.replace(':userId', userId);
                                    var userId = users[i]['id'];
                                    var href = `{{ route('users.show', ':userId') }}`;
                                    href = href.replace(':userId', userId);
                                    // var href = `{{ route('users.edit', 96) }}`;  

                                    html += '<tr>\
                                                                <td>' + users[i]['id'] + '</td>\
                                                                <td>' + users[i]['name'] + '</td>\
                                                                <td>' + users[i]['email'] + '</td>\
                                                                <td>Admin</td>\
                                                                <td><img src="' + src + '" alt="User Image" width="50"></td>\
                                                                <td>last_seen</td>\
                                                                <td></td>\
                                                                <td>product</td>\
                                                                <td><a href="' + href +
                                        '" class="edit-link" data-user-id="' +
                                        users[i][
                                            'id'
                                        ] + '">Edit</a></td>\
                                                                <td><a href="' + href +
                                        '" class="edit-link" data-user-id="' +
                                        users[i][
                                            'id'
                                        ] + '">View</a></td>\
                                                </tr>';
                                }

                            } else {
                                html += '<tr>\
                                                            <td> No users found </td>\
                                                            </tr>';
                            }
                            $('#user-list').html(html);
                        },
                        error: function(xhr) {
                            // Handle errors if needed
                            console.log(xhr.responseText);
                        }
                    });


                } else {
                    // If no criteria entered, show all users
                    $.ajax({
                        type: 'GET',
                        url: '{{ route('users.index') }}',
                        success: function(response) {
                            // Replace the user list with the original data
                            //$('#user-list').html(data);
                            var users = response.data;
                            console.log(users);

                            var html = '';
                            if (users.length > 0) {
                                for (let i = 0; i < users.length; i++) {
                                    // var edit = '<td><a href="users/'+users[i]['id']+'/edit" class="edit-link" data-user-id="' + users[i][
                                    //     'id'
                                    // ] + '">Edit</a></td>\'
                                    var img = users[i]['image'];
                                    var src = `{{ asset('images/`+img+`') }}`
                                    var a = users[i]['id'];
                                    var href = '';
                                    html += '<tr>\
                                                                <td>' + users[i]['id'] + '</td>\
                                                                <td>' + users[i]['name'] + '</td>\
                                                                <td>' + users[i]['email'] + '</td>\
                                                                 <td>Admin</td>\
                                                                <td><img src="' + src +
                                        '" alt="User Image" width="50"></td>\
                                                                <td>last_seen</td>\
                                                                <td></td>\
                                                                <td>product</td>\
                                                                <td><a href="users.show" class="edit-link" data-user-id="' +
                                        users[
                                            i][
                                            'id'
                                        ] + '">View</a></td>\
                                                                </tr>';
                                }

                            } else {
                                html += '<tr>\
                                                            <td> No users found </td>\
                                                            </tr>';
                            }
                            $('#user-list').html(html);
                        },
                        error: function(xhr) {
                            // Handle errors if needed
                            console.log(xhr.responseText);
                        }
                    });
                }
            });
        });
    </script>-->


    <script type="text/javascript">
        function updateUserList(name, email, role) {
            $.ajax({
                type: 'GET',
                url: '{{ route('users.index') }}',
                data: {
                    name: name,
                    email: email,
                    role: role
                    // last_seen: last_seen
                },
                success: function(response) {
                    var users = response.data;
                    // console.log(users);

                    var html = '';

                    if (users.length > 0) {
                        for (let i = 0; i < users.length; i++) {

                            var img = users[i]['image'];
                            var src = `{{ asset('images/`+img+`') }}`
                            var userId = users[i]['id'];
                            var href = `{{ route('users.edit', ':userId') }}`;
                            href = href.replace(':userId', userId);
                            var userId = users[i]['id'];
                            var href1 = `{{ route('users.show', ':userId') }}`;
                            href1 = href1.replace(':userId', userId);

                            var userId = users[i]['id'];
                            var userRoles = '';
                            if (users[i].roles && users[i].roles.length > 0) {
                                // Construct a string of role names, separated by commas
                                userRoles = users[i].roles.map(role => role.name).join(', ');
                            }
                            // Construct the HTML for the online status and last seen 



                            html += '<tr>\
                                    <td>' + users[i]['id'] + '</td>\
                                    <td>' + users[i]['name'] + '</td>\
                                    <td>' + users[i]['email'] + '</td>\
                                    <td>' + userRoles + '</td>\
                                    <td><img src="' + src + '" alt="User Image" width="50"></td>\
                                     <td>last_Seen</td>\
                                    <td></td>\
                                    <td><a href="' + href + '" class="edit-link" data-user-id="' + users[i][
                                'id'
                            ] + '">Edit</a></td>\
                                    <td><a href="' + href1 + '" class="edit-link" data-user-id="' + users[i][
                                'id'
                            ] + '">View</a></td>\
                                    </tr>';
                        }

                    } else {
                        html += '<tr>\
                                <td> No users found </td>\
                                </tr>';
                    }
                    $('#user-list').html(html);
                },
                error: function(xhr) {
                    // Handle errors if needed
                    // console.log(xhr.responseText);
                }
            });
        }

        $(document).ready(function() {
            $('#search-form').on('click', function(e) {
                e.preventDefault();
                var name = $('#name').val();
                var email = $('#email').val();
                var role = $('#role').val();

                if (name || email || role) {

                    updateUserList(name, email, role);
                } else {

                    updateUserList('', '');
                }
            });
        });
    </script>


@endsection
@push('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endpush

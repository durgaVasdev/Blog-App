<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
    <style>
        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #DB7093;
        }

        li {
            float: left;
        }

        li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        li a:hover:not(.active) {
            background-color: white;
        }

        .active {
            background-color: #DB7093;
        }
    </style>
</head>

<body>

    <ul>
        <!-- <li style="float:right"><a href="#">{{ Auth::user()->name}}</a></li>-->
        <li><a href="{{ route('users.create') }}">Add User</a></li>
        <li style="float:right"><a class="active" href="{{ route('logout') }}">logout</a></li>
    </ul>

    @yield('content')
</body>

</html>
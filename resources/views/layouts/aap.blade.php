<!DOCTYPE html>
<html>
<head>
    <!-- Head content -->
</head>
<body>
    <div class="sidebar">
        @if(Auth::check() && Auth::user()->hasRole('Admin'))
            @include('layouts.Sidebar')
        @else
            @include('layouts.user_sidebar')
        @endif
    </div>

    <div class="content">
        @yield('content')
    </div>
</body>
</html>
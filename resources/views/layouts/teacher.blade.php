<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <body>
    <div id="header">
    @if(Session::has('teacherid'))
    <a class="btn btn-info" href="/teacher">Home</a>
    <a class="btn btn-info"  href="{{route('teacher.courses')}}">All Course</a>
    <a class="btn btn-info"  href="{{route('teacher.anotices')}}">Admin Notices</a>
    <a class="btn btn-info"  href="{{route('teacher.profile')}}">Profile</a>
    <a class="btn btn-info"  href="{{route('teacher.logout')}}">Logout</a>@endif
    @if(!Session::has('teacherid'))<a class="btn btn-info"  href="{{route('teacher.login')}}">Login</a>@endif
</div><br/><br/>
        @yield('content')
        <br/><br/><br/><br/>
        <div id="footer">&copy; Advanced webtech project</div>
    </body>
</html>
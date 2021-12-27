<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Social Login App</title>
        <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet">
        <style></style>
        <script type="text/javascript" src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>


        <link rel="stylesheet" href="{{ mix('css/app.css') }}" />
        <script defer src="{{ mix('js/app.js') }}"></script>


        <script type="text/javascript"></script>
<!--        <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>-->
@section('head_content')
@stop
    </head>
    <body>

    <div id="app">
        <example-component></example-component>
    </div>

    <div id="app">
        <header-component></header-component>
    </div>
    <div class="container">
        <div align="center" style="font-family: 'Agency FB';background-color:#f7f4cf;height:50px"><h1>Social Login App</h1></div>
        <div class="navbar navbar-inverse">
            <div class="navbar-inner nav-collapse" style="height: auto;">
                <ul class="nav">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="/users/list/">Users List</a></li>
                    @if(Session::has('user'))
                        <li><a href="/profile/">Profile</a></li>
                        <li><a href="/logout">Log Out</a></li>
                    @else
                        <li><a href="/home"> Log In</a></li>
                    @endif
                </ul>
            </div>
        </div>
        @section('top_header')
            {{--This is the master sidebar.--}}
        @show
        <div id="content" class="row-fluid">
        @section('left_sidebar')
           {{-- This is the master sidebar.--}}
        @show



            @yield('middle_body')

        @section('right_sidebar')

            @show

        </div>
            <footer>
                <div align="center" style="font-family: 'Agency FB';background-color:#18373a;height:30px;color:#ffffff;font-size:20px;padding:5px 0 0 0;">
                    © All Right Reserved by SocialLoginApp
                </div>
            </footer>
    </div>
    </body>


</html>

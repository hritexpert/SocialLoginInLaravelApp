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
    <div class="container">
    <div id="app">
        <example-component></example-component>

        <div class="span8 main">
            <h2>Social Logins</h2>
            @if(Session::has('success'))
                <div class="alert alert-success">
                    <strong>Success!</strong> {{ Session::get('success') }}
                </div>
            @endif
            @if(Session::has('user'))
                you are already login
            @else
                <p><a href="/redirect/facebook"> <img src="{{asset('images/facebook.jpg')}}" width="40" height="40"/> Facebook</a></p>
                <p><a href="/redirect/google">   <img src="{{asset('images/gmail.png')}}" width="40" height="40"/> Gmail</a></p>
            @endif

        </div>


        <app-footer></app-footer>
    </div>
    </body>


</html>

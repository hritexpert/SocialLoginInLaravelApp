<html>
    <head>
        <title>@yield('page_title')</title>
 
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    </head>
    <body>
        @section('page_menu')
            This is the master sidebar.
        @show
        <div class="container">
            @yield('page_content')
        </div>
    </body>
	<footer>
	@yield('footer_content')
	</footer>
</html>
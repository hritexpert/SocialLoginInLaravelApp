<template>
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
</template>

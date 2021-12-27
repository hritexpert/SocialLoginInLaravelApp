@extends('layout')

@section('top_header')

@stop

@section('left_sidebar')
    <div class="span2 sidebar">
        <h3>Left Sidebar</h3>
        <ul class="nav nav-tabs nav-stacked">
            <li><a href="/home2">Home</a></li>
            <li><a href="/users/list">Users List</a></li>
            <li><a href="/users/list">Users List</a></li>
            <li><a href="/users/list">Users List</a></li>
            <li><a href="/users/list">Users List</a></li>
            <li><a href="/users/list">Users List</a></li>
            <li><a href="/users/list">Users List</a></li>
        </ul>
    </div>
@stop
@section('middle_body')
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
@stop
@section('right_sidebar')
    <h3>Sponsor</h3>
    <div class="span2 sidebar" style="height:500px!important;">
        <img src="{{asset('images/banner.jpg')}}" style="height:500px!important;"/>
    </div>
@stop
@section('bottom_footer')
    <div style="background-color:green;">It is footer</div>
@stop

@extends('layout')

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
        <h2>User Profile</h2>
        @if(Session::has('success'))
            <div class="alert alert-success">
                <strong>Success!</strong> {{ Session::get('success') }}
            </div>
        @endif
        <table class="table table-striped">
            <tr>
                <td>Avatar</td>
                <td><img src="{{ Session::get('social_user')->avatar_original }}" width="50" height="50"></td>
            </tr>
            <tr>
                <td>Name</td>
                <td>{{ Session::get('user')->username }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{{ Session::get('user')->email }}</td>
            </tr>
            <tr>
                <td>Social ID</td>
                <td>{{ Session::get('user')->socialid }}</td>
            </tr>
            <tr>
                <td>Phone</td>
                <td>{{ Session::get('user')->phone }}</td>
            </tr>
            <tr>
                <td>Join Date</td>
                <td>{{ Session::get('user')->created_at }}</td>
            </tr>
        </table>
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

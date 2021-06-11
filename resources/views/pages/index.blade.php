@extends('layouts.app')

@section('content')
    <div class="jumbotron text-center">
        <!-- pass title variable defined in PagesController -->
        <h1>{{$title}}</H1>
        <p>This is the Laravel App where I'm testing and figuring out Laravel</p>

        @if (Auth::check()) 
            <p>You are logged in, why don't you create a new post?</p>
            <a class="btn btn-primary" href="/posts/create">Create A New Post</a>
        @else
        <p><a class="btn btn-primary btn-lg" href="/login" role="button">Login</a> <a class="btn btn-success btn-lg" href="/register" role="button">Register</a></p>
        @endif
    </div>
@endsection
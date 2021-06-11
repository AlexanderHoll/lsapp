@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-secondary mb-2">Go Back</a>
    <h1>{{$post->title}}</h1>
    <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
    <div class="card">
        <img class="index-img card-img-top" src="/storage/cover_image/{{$post->cover_image}}">
    
        <div class="card-body">
            <!-- show post body with html parsing -->
            {!! $post->body !!}
        </div>

    </div>
    <hr>

    
    {{-- @if (Auth::user() == $post->user) --}}
    @auth
        {{--Check to ensure the only user who can edit is the user who made the post--}}
        @if(Auth::user()->id == $post->user_id)
            <a href="/posts/{{$post->id}}/edit" class="btn btn-dark">Edit</a>

            {!!Form::open(['action' => ['\App\Http\Controllers\PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!!Form::close()!!}
        @endif
    @endauth
    {{-- @endif --}}
@endsection
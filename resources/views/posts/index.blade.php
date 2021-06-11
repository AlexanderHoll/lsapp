@extends('layouts.app')

@section('content')
    <h1>Posts</h1>

    @if(count($posts) > 0)
        @foreach($posts as $post)
            <div class="card card-body mb-2">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <a href="/posts/{{$post->id}}">
                            <div class="card">
                                <img class="index-img" src="/storage/cover_image/{{$post->cover_image}}">
                            </div>
                        </a>
                    </div>

                    <div class="col-md-8 col-sm-8">
                        <h3 class="card-title"><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                        <small class="card-text">Written on {{$post->created_at}} by {{$post->user->name}}</small>
                    </div>
                </div>
            </div>

        @endforeach
        <!-- at the end of listing, create pagination -->
        <div class="card-body mt-2">
            {{$posts->links()}}
        </div>
    @else
        <p>No posts found</p>
    @endif

@endsection
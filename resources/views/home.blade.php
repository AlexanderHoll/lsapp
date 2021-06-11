@extends('layouts.app')

@section('content')
<div class="container">
    @if(session()->has('message'))
            <div class="alert alert-success" role="alert">
                {{ session()->get('message') }}
            </div>
        @endif

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    <div class="row justify-content-center">

        

        <div class="col flex">
            
            <div class="col col-3">
            <div class="card mb-2">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    {{ __('You are logged in!') }}
                </div>
            </div>

            <div class="card mb-2">
                <div class="panel-body mx-auto">
                    <ul class="pl-0 mb-0 no-point">
                        <li>
                            <a href="/posts/create" class="btn btn-primary mb-2 mt-2">Create A New Post</a>
                        </li>
                        <li>
                            <a href="/password/reset" class="btn btn-primary mb-2 fill">Reset Password</a>
                        </li>
                        <li>
                            <a class="btn btn-warning mb-2 fill" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                            </a>
                        </li>
                    </ul>


                </div>
            </div>

        </div>
        <div class="col col-9">
            <div class="card">
                <div class="card-header">
                    <h3>Your Posts</h3>
                    @if(count($posts) > 0)
                        <table class="table table-striped">
                            <tr>
                                <th>Title</th>
                                <th>Post Date</th>
                                <th colspan="2">Manage Post</th>
                            </tr>
    
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{$post->title}}</td>
                                    <td>{{$post->created_at}}</td>
                                    <td><a href="/posts/{{$post->id}}/edit" class="btn btn-dark">Edit</a></td>
                                    <td>

                                        {!!Form::open(['action' => ['\App\Http\Controllers\PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right'])!!}
                                        {{Form::hidden('_method', 'DELETE')}}
                                        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                        {!!Form::close()!!}

                                    </td>
                                </tr>
                            @endforeach
    
                        </table>
                    @else
                        <p>You have no posts to display</p>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
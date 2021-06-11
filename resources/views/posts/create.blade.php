@extends('layouts.app')

@section('content')
    <h1>Create Post</h1>
    <!-- Assign action to controller, then specify function submitting to -->
    <!-- Full namespace required as Posts Controller is not found otherwise -->

    <!-- enctype allows for image UI uploading -->
    <!-- Declare method used to submit form -->

    {!! Form::open(['action' => '\App\Http\Controllers\PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            <!-- Header and form entry fields, Title of post and entry form for title -->
            {{Form::label('title', 'Title')}}
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>

        <div class="form-group">
            <!-- Body title and body field for user to fill -->
            {{Form::label('body', 'Body')}}
            {{Form::textarea('body', '', ['id' => 'form-control', 'class' => 'form-control', 'placeholder' => 'Body Text'])}}
        </div>

        <script>
            CKEDITOR.replace( 'form-control' );
        </script>

        <div class="form-group">
            {{Form::file('cover_image')}}
        </div>
        {{Form::submit('Submit', ['class' =>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection
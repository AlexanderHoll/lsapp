@extends('layouts.app')

@section('content')
    <h1>@yield ('title', $page->title)</h1>
    {!!$page->content!!}
@endsection
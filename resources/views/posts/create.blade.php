@extends('layout')

@section('title')
    Blog
@endsection

@section('title_content')
    Write Your Blog
@endsection
@section('content')
    @error @enderror
    <form method="POST" action="{{ route('post.store') }}">
        @csrf

        @include('posts._form')
        
        <button type="submit" class="btn btn-success">Creat</button>
    </form>
@endsection
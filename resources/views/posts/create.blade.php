@extends('layout')

@section('title')
    Blog
@endsection

@section('title_content')
    Write Your Blog
@endsection
@section('content')
    @if ( $errors->any())
        <div class="alert alert-danger" role="alert">
            @foreach ($errors->all() as $error)
                <ul><li>{{ $error }}</li></ul>
            @endforeach
        </div>
    @endif
    <form method="POST" action="{{ route('post.store') }}">
        @csrf

        @include('posts._form')
        
        <button type="submit" class="btn btn-success">Creat</button>
    </form>
@endsection
@extends('layout')

@section('title')
    Blog
@endsection

@section('title_content')
    Edit Your Blog
@endsection
@section('content')
    @if ( $errors->any())
        <div class="alert alert-danger" role="alert">
            @foreach ($errors->all() as $error)
                <ul><li>{{ $error }}</li></ul>
            @endforeach
        </div>
    @endif
    <form method="POST" action="{{ route('post.update',['post'=>$post->id]) }}" enctype="multipart/form-data">
        @csrf

        @method('PUT')
        @include('posts._form')
        <button type="submit" class="btn btn-warning">Update</button>
    </form>
@endsection
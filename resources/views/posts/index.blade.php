@extends('layout')

@section('title')
    BLOG 
@endsection

@section('title_content')
    BLOG POSTS
@endsection

@section('content')
    @if(session()->has('status'))
    <div class="alert alert-success" role="alert">
        {{ session()->get('status') }}
    </div>
    @endif  
    @forelse ($posts as $post)
        <div class="container">
            <h2><a href="{{ route ('post.show', ['post'=>$post->id]) }}">{{ $post->title }}</a></h2>
            {{ \Illuminate\Support\Str::limit($post->content, 200, $end='...')}} <a href="{{ route ('post.show', ['post'=>$post->id]) }}"><strong> Read More </strong></a>
            <div class="">
                @if ($post->comments_count)
                    <a href="{{ route ('post.show', ['post'=>$post->id]) }}"><h5>{{$post->comments_count}} Comments</h5></a>
                @else
                    <a href="{{ route ('post.show', ['post'=>$post->id]) }}"><h5>No Comments Yet</h5></a>
                @endif
                <hr>
            </div>
        </div>
        
    @empty
        <h1>No Blog Post Submitted YET!!!!</h1>
    @endforelse
    {{-- {!! $post->render() !!} --}}
@endsection
@extends('layout')

@section('title')
    BLOG 
@endsection

@section('title_content')
    @if(isset($title))
        {{ $title }}
    @else
        BLOG POSTS
    @endif
@endsection

@section('content')
    @if(session()->has('status'))
    <div class="alert alert-success" role="alert">
        {{ session()->get('status') }}
    </div>
    @endif  
    <div class="row">
        <div class="col-8">
            @forelse ($posts as $post)
                <div class="container">
                    @if($post->trashed())
                        <del>
                    @endif
                        <h2><a class="{{ $post->trashed() ? 'text-muted' : '' }}" href="{{ route('post.show', ['post' => $post->id]) }}">{{ $post->title }}</a></h2>
                    @if($post->trashed())
                        </del>
                    @endif
                    @updated(['date' => $post->created_at, 'name' => $post->user->name, 'userId' => $post->user->id]) 
                    @endupdated
                    @tags(['tags' => $post->tag])
                    @endtags
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
        </div>
        <div class="col-4">
            @include('posts._activity')
        </div>
    </div>
    {{-- {!! $post->render() !!} --}}
@endsection
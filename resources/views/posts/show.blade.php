@extends('layout')

@section('title')
    BLOG 
@endsection
@section('title_content')
    BLOG
@endsection

@section('content')
    @if(session()->has('status'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('status') }}
        </div>
    @endif  
    <div class="row">
        <div class="col-8">
            <div class="card">
            <div class="card-body">
                <h2 class="card-title">{{ $post->title }}</h2>
                @tags(['tags' => $post->tag])
                @endtags
                @updated(['date' => $post->created_at, 'name' => $post->user->name, 'userId' => $post->user->id]) 
                @endupdated 
                @updated(['date' => $post->updated_at]) 
                    &#x0007C Updated
                @endupdated
                <p class="card-text">{{ $post->content }}</p>
                @if ($post->image)
                    <img src="{{ $post->image->url() }}" />
                @endif
                <u class="float-right">Currently read by {{ $counter }} people</u>
                <div class="row">
                    <div class="col-3">
                        @auth
                            @can('update', $post)
                                <a href="{{route('post.edit',['post'=>$post->id])}}" type="button" class="btn btn-secondary btn-block">Edit</a>
                            @endcan
                        @endauth
                    </div>
                    <div class="col-3">
                        @if(!$post->trashed())
                            @auth
                                @can('delete', $post)
                                    <form method="POST" action="{{ route('post.destroy', ['post' => $post->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" class="btn btn-danger btn-block" value="Delete" />
                                    </form>
                                @endcan
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
            </div>
            <h3 class="card-title" style="margin:0px 40px">Comments</h3>
            @include('comments._form')
            <div class="card" style="margin:0px 0px 0px 40px;">
                <div class="card-body">
                    @forelse ($post->comments as $comment)
                        <h5 class="card-text">{{ $comment->content }} &#x0007C 
                            @updated(['date' => $comment->created_at , 'name' => $comment->user->name]) 
                            @endupdated 
                        </h5>
                        <hr>
                    @empty
                        <h4 class="card-title">No Comments Yet.</h4>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-4">
            @include('posts._activity')
        </div>
    </div>
@endsection

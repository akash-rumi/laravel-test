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
    <div class="card">
       <div class="card-body">
            <h2 class="card-title">{{ $post->title }}</h2>
            <u > Added by {{ $post->user->name }}  at {{ $post->created_at->diffForHumans() }}
                &#x0007C Updated {{ $post->updated_at->diffForHumans() }}</u>
            <p class="card-text">{{ $post->content }}</p>
                <div class="row">
                    <div class="col-1">
                        @can('update', $post)
                            <a href="{{route('post.edit',['post'=>$post->id])}}" type="button" class="btn btn-secondary btn-block">Edit</a>
                        @endcan
                    </div>
                    <div class="col-1">
                        @if(!$post->trashed())
                            @can('delete', $post)
                                <form method="POST" action="{{ route('post.destroy', ['post' => $post->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn btn-danger btn-block" value="Delete" />
                                </form>
                            @endcan
                        @endif
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    <h3 class="card-title" style="margin:0px 40px">Comments</h3>
    <div class="card" style="margin:0px 40px;">
        <div class="card-body">
            @forelse ($post->comments as $comments)
                <h5 class="card-text">{{ $comments->content }} <u>&#x0007C Added {{ $comments->created_at->diffForHumans() }}</u>
                </h5>
                <hr>
            @empty
                <h4 class="card-title">No Comments Yet.</h4>
            @endforelse
        </div>
    </div>
@endsection

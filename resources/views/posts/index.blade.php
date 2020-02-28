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
                    <u> Added by {{ $post->user->name }} {{ $post->created_at->diffForHumans() }}</u><br>
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
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Most Commented</h4>
                    <h6 class="card-subtitle text-muted">
                        <u> What people are currently talking about </u>
                    </h6>
                </div>
                <ul class="list-group list-group-flush">
                    @foreach ($mostCommented as $post)
                        <li class="list-group-item">
                            <a href="{{ route('post.show', ['post' => $post->id]) }}">
                                {{ $post->title }} 
                                    @if ($post->comments_count)
                                        ( {{$post->comments_count}} Comments)
                                    @else
                                        (No Comments Yet)
                                @endif
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="card mt-4">
                <div class="card-body">
                    <h4 class="card-title">Most Active Users</h4>
                    <h6 class="card-subtitle text-muted">
                        <u> Users with most posts written </u>
                    </h6>
                </div>
                <ul class="list-group list-group-flush">
                    @foreach ($mostActive as $user)
                        <li class="list-group-item">
                            {{ $user->name }} 
                                 @if ($user->blog_posts_count)
                                    ( {{$user->blog_posts_count}} Posts)
                                @else
                                  (Did not post Yet)
                                @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    {{-- {!! $post->render() !!} --}}
@endsection
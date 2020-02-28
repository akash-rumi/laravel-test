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
                    @updated(['date' => $post->created_at, 'name' => $post->user->name]) 
                    @endupdated
                    <br>
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
                @card(['title' => 'Most Commented'])
                    @slot('subtitle')
                        What people are currently talking about
                    @endslot
                    @slot('items')
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
                    @endslot
                @endcard
            </div>
            <div class="card mt-4">
                @card(['title' => 'Most Active'])
                    @slot('subtitle')
                        Writers with most posts written
                    @endslot
                    @slot('items')
                        @foreach ($mostActive as $user)
                            <li class="list-group-item">
                                {{ $user->name }} 
                                @if ($user->blogposts_count)
                                    ( {{$user->blogposts_count}} Posts)
                                @else
                                    (Did not post Yet)
                                @endif
                            </li>
                        @endforeach
                    @endslot
                @endcard
            </div>
            <div class="card mt-4">
                @card(['title' => 'Most Active Last Month'])
                    @slot('subtitle')
                        Writers with most posts written in Last Month.
                    @endslot
                    @slot('items')
                        @foreach ($mostActiveLastMonth as $user)
                            <li class="list-group-item">
                                {{ $user->name }} 
                                @if ($user->blogposts_count)
                                    ( {{$user->blogposts_count}} Posts)
                                @else
                                    (Did not post Yet)
                                @endif
                            </li>
                        @endforeach
                    @endslot
                @endcard
            </div>
        </div>
    </div>
    {{-- {!! $post->render() !!} --}}
@endsection
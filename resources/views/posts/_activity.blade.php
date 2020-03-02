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
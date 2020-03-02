<p>
    @forelse ($tags as $tag)
        <a href="{{ route('post.tags.index', ['tag' => $tag->id]) }}" class="badge badge-success"> {{ $tag->name }}</a>
    @empty
        <u>No Tags</u>
    @endforelse
</p>

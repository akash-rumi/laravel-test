<div class="mb-2 mt-2">
    @auth
        <form method="POST" action="{{ $route  }}">
            @csrf
            <div class="form-group">
                <textarea type="text" name="content" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-success float-right" style="margin-left:10px">Add comment</button><hr>
        </form>
    @else
        <a href="{{ route('login') }}">Sign-in</a> to post comments!
    @endauth
</div>

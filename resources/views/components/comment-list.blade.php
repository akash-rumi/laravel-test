<div class="card" style="margin:0px 0px 0px 40px;">
    <div class="card-body">
        @forelse ($comments as $comment)
            <h5 class="card-text">{{ $comment->content }} &#x0007C 
                @updated(['date'=>$comment->created_at , 'name'=>$comment->user->name , 'userId'=>$comment->user->id]) 
                @endupdated 
            </h5>
            <hr>
        @empty
            <h4 class="card-title">No Comments Yet.</h4>
        @endforelse
    </div>
</div>
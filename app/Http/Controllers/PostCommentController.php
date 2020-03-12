<?php

namespace App\Http\Controllers;

use App\BlogPost;
use App\Http\Requests\StoreComment;
use App\Jobs\NotifyUsesPostWasCommented;
use App\Jobs\ThrottledMail;
use App\Mail\CommentPosted;
use App\Mail\CommentPostedMarkdown;
use Illuminate\Support\Facades\Mail;

class PostCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['store']);
    }

    public function store(BlogPost $post, StoreComment $request)
    {
        // Comment::create()
        $comment = $post->comments()->create([
            'content' => $request->input('content'),
            'user_id' => $request->user()->id
        ]);

        // Mail::to($post->user)->send(new CommentPostedMarkdown($comment));
        // Mail::to($post->user)->queue(new CommentPostedMarkdown($comment));

        ThrottledMail::dispatch(new CommentPostedMarkdown($comment), $post->user)->onQueue('low');


        NotifyUsesPostWasCommented::dispatch($comment)->onQueue('high');

        return redirect()->back()->withStatus('Comment was created!');
    }
}

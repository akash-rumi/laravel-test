<?php

namespace App\Listeners;

use App\Events\CommentPosted;
use App\Jobs\NotifyUsesPostWasCommented;
use App\Jobs\ThrottledMail;
use App\Mail\CommentPostedMarkdown;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyUsersAboutComment
{

    public function handle(CommentPosted $event)
    {
        // dd('Its done custom event and listener');
        ThrottledMail::dispatch(new CommentPostedMarkdown($event->comment), $event->comment->commentable->user)->onQueue('low');

        NotifyUsesPostWasCommented::dispatch($event->comment)->onQueue('high');
    }
}

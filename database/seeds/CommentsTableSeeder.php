<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = App\BlogPost::all();
        $user = App\User::all();

        if ($posts->count() === 0 || $user->count() === 0) {
            $this->command->info('There are no blog posts or no users, so no comments will be added');
            return;
        }

        $commentsCount = (int) $this->command->ask('How many comments would you like?', 90);


        factory(App\Comment::class, $commentsCount)->make()->each(function ($comment) use ($posts, $user) {
            $comment->commentable_id = $posts->random()->id;
            $comment->commentable_type = 'App\BlogPost';
            $comment->user_id = $user->random()->id;
            $comment->save();
        });

        $commentsCount = (int) $this->command->ask('How many Profile Post would you like?', 90);
        factory(App\Comment::class, $commentsCount)->make()->each(function ($comment) use ($user) {
            $comment->commentable_id = $user->random()->id;
            $comment->commentable_type = 'App\User';
            $comment->user_id = $user->random()->id;
            $comment->save();
        });
    }
}

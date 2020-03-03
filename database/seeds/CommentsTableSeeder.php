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

        if ($posts->count() === 0) {
            $this->command->info('There are no blog posts, so no comments will be added');
            return;
        }

        $commentsCount = (int) $this->command->ask('How many comments would you like?', 90);
        $user = App\User::all();

        factory(App\Comment::class, $commentsCount)->make()->each(function ($comment) use ($posts, $user) {
            $comment->blog_post_id = $posts->random()->id;
            $comment->user_id = $user->random()->id;
            $comment->save();
        });
    }
}

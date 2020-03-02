<?php

use App\BlogPost;
use App\Tag;
use Illuminate\Database\Seeder;

class BlogpostTagTableseedr extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tagCount = Tag::all()->count();

        if (0 === $tagCount) {
            $this->command->info('No Tags Found, skipping assigning TAGS');
            return;
        }

        $howManyMin = (int) $this->command->ask('Minimum tags on a blog post?', 1);
        $howManyMax = min((int) $this->command->ask('Maximum tags on a blog post?', $tagCount), $tagCount);

        BlogPost::all()->each(function (BlogPost $post) use ($howManyMax, $howManyMin) {
            $take = random_int($howManyMin, $howManyMax);
            $tags = Tag::inRandomOrder()->take($take)->get()->pluck('id');
            $post->tag()->sync($tags);
        });
    }
}

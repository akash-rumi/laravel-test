<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BlogPost;
use App\Events\BlogPostPosted;
use App\Http\Requests\StorePost;
use App\Image;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view(
            'posts.index',
            [
                'posts' => BlogPost::latestWithRelations()->get(),
            ]
        );
    }



    public function show($id)
    {
        // return view('posts.show', [
        //     'post' => BlogPost::with(['comments' => function ($query) {
        //         return $query->latest();
        //     }])->findOrFail($id),
        // ]);
        $blogPost = Cache::tags(['blog-post'])->remember("blog-post-{$id}", 60, function () use ($id) {
            return BlogPost::with('comments')->with('tag')->with('user')->findOrFail($id);
        });

        $sessionId = session()->getId();
        $counterKey = "blog-post-{$id}-counter";
        $userKey = "blog-post{$id}-users";

        $users = Cache::tags(['blog-post'])->get($userKey, []);
        $userUpdate = [];
        $difference = 0;
        $now = now();

        foreach ($users as $session => $lastVisit) {
            if ($now->diffInMinutes($lastVisit) >= 1) {
                $difference--;
            } else {
                $userUpdate[$session] = $lastVisit;
            }
        }

        if (!array_key_exists($sessionId, $users) || $now->diffInMinutes($users[$sessionId]) >= 1) {
            $difference++;
        }

        $userUpdate[$sessionId] = $now;
        Cache::tags(['blog-post'])->forever($userKey, $userUpdate);

        if (!Cache::tags(['blog-post'])->has($counterKey)) {
            Cache::tags(['blog-post'])->forever($counterKey, 1);
        } else {
            Cache::tags(['blog-post'])->increment($counterKey, $difference);
        }

        $counter = Cache::tags(['blog-post'])->get($counterKey);


        return view('posts.show', ['post' => $blogPost, 'counter' => $counter]);
    }

    public function store(StorePost $request)
    {
        $validatedData = $request->validated();

        $blogpost = new BlogPost();
        $blogpost->title = $request->input('title');
        $blogpost->content = $request->input('content');
        $blogpost->user_id = $request->user()->id;
        $blogpost->save();

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('public/thumbnails');
            $blogpost->image()->save(Image::make(['path' => $path]));
        }

        event(new BlogPostPosted($blogpost));

        $request->session()->flash('status', 'Blog Post Was Succesfully Created.');
        return redirect()->route('post.show', ['post' => $blogpost->id]);
    }
    public function create()
    {
        return view('posts.create');
    }

    public function edit($id)
    {
        $post = BlogPost::findOrFail($id);

        // if (Gate::denies('update-post', $post)) {
        //     abort(403, "You Are not Authorized to edit this POST!!");
        // }
        // $this->authorize('update-post', $post);
        $this->authorize($post);
        return view('posts.edit', ['post' => $post]);
    }

    public function update(StorePost $request, $id)
    {
        $post = BlogPost::findOrFail($id);
        $validatedData = $request->validated();

        $post->fill($validatedData);

        $post->save();
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('public/thumbnails');
            if ($post->image) {
                Storage::delete($post->image->path);
                $post->image->path = $path;
                $post->image->save();
            } else {
                $post->image()->save(Image::make(['path' => $path]));
            }
        }
        $request->session()->flash('status', 'Blog Post Is Succesfully Updated.');
        return redirect()->route('post.show', ['post' => $post->id]);
    }

    public function destroy(Request $request, $id)
    {
        $post = BlogPost::findOrFail($id);
        // if (Gate::denies('delete-post', $post)) {
        //     abort(403, "You Are not Authorized to DELETE this POST!!");
        // }
        // $this->authorize('delete-post', $post);
        $this->authorize($post);
        $post->delete();

        $request->session()->flash('status', 'Blog Post Is Succesfully Deleted.');
        return redirect()->route('post.index');
    }
}

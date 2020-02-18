<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BlogPost;
use App\Http\Requests\StorePost;
use Faker\Provider\Lorem;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Gate;

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
        return view('posts.index', ['posts' => BlogPost::withCount('comments')->get()]);
    }



    public function show($id)
    {
        return view('posts.show', ['post' => BlogPost::with('comments')->findOrFail($id)]);
    }

    public function store(StorePost $request)
    {
        $validatedData = $request->validated();

        $blogpost = new BlogPost();
        $blogpost->title = $request->input('title');
        $blogpost->content = $request->input('content');
        $blogpost->save();

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

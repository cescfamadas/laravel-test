<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Mail\PostMail;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendNewPostMailJob;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::paginate(4);

        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->check()) {
            return to_route('login');
        }
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => ['required', 'min:5', 'max:255'],
            'content' => ['required', 'min:10'],
            'thumbnail' => ['required', 'image'],
        ]);

        //$validatedData['thumbnail'] = $request->file('thumbnail')->store('thumbnails');
        // Store the file in the 'public' disk and get the path
        $path = $request->file('thumbnail')->store('thumbnails', 'public');

        // If you need to store the full URL instead, you can use Storage::url($path)
        // $validatedData['thumbnail'] = Storage::url($path);

        // Store just the path relative to the disk root
        $validatedData['thumbnail'] = $path;
        auth()->user()->posts()->create($validatedData);

        dispatch(new SendNewPostMailJob(['email' => auth()->user()->email, 'name' => auth()->user()->name, 'title' => $validatedData['title']]));
        return to_route('posts.index')->with('message', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post = Post::findOrFail($post->id);
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        Gate::authorize('update', $post);
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        Gate::authorize('update', $post);

        $validatedData = $request->validate([
            'title' => ['required', 'min:5', 'max:255'],
            'content' => ['required', 'min:10'],
            'thumbnail' => ['sometimes', 'image'],
        ]);

        if ($request->hasFile('thumbnail')) {
            File::delete(storage_path('app/public/' . $post->thumbnail));
            $validatedData['thumbnail'] = $request->file('thumbnail')->store('thumbnails');
        }
        $post->update($validatedData);
        return to_route('posts.show', ['post' => $post]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Gate::authorize('delete', $post);
        File::delete(storage_path('app/public/' . $post->thumbnail));
        $post->delete();
        return to_route('posts.index');
    }
}

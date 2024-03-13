<?php

namespace App\Http\Controllers\backend;

use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('category', 'user', 'tags')->latest()->paginate(10);
        return view('backend.pages.post.posts_list', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('role', 'admin')->get();
        $categories = Category::all();
        $tags = Tag::all();
        return view('backend.pages.post.post_add', compact('users', 'categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'category_id' => 'required',
            'title' => 'required|unique:posts,title',
            'slug' => 'required',
            'image' => 'required|image|max:10240',
            'content' => 'required',
            'status' => 'required'
        ]);
        if ($request->hasFile('image')) {
            $image_extension = $request->file('image')->getClientOriginalExtension();
            $image_name = date('YmdHis') . "." . $image_extension;
            $request->file('image')->storeAs('uploads/blog_images/', $image_name);
        } else {
            $image_name = null;
        }
        $post = Post::create([
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug(trim($request->slug)),
            'image' => $image_name,
            'content' => $request->content,
            'status' => $request->status
        ]);
        $post->tags()->attach($request->tags);
        session()->flash('success', 'Created 1 post successfully');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show($post_id)
    {
        $post = Post::where('id', $post_id)->with('user', 'category', 'tags')->first();
        return view('backend.pages.post.post_view', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($post_id)
    {
        $users = User::where('role', 'admin')->get();
        $categories = Category::all();
        $tags = Tag::all();
        $post = Post::where('id', $post_id)->with('user', 'category', 'tags')->first();
        return view('backend.pages.post.post_edit', compact('post', 'users', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $post_id)
    {
        $request->validate([
            'user_id' => 'required',
            'category_id' => 'required',
            'title' => 'required',
            'slug' => 'required',
            'image' => 'required',
            'content' => 'required',
            'status' => 'required'
        ]);
        $post = Post::findOrFail($post_id);
        $image_name = $post->image;
        if ($request->hasFile('image')) {
            if (!empty($image_name)) {
                $removeFile = public_path() . '/uploads/blog_images/' . $image_name;
                File::delete($removeFile);
            }
            $image_extension = $request->file('image')->getClientOriginalExtension();
            $image_name = date('YmdHis') . "." . $image_extension;
            $request->file('image')->storeAs('uploads/blog_images/', $image_name);
        } else {
            $image_name = $post->image;
        }
        $post->update([
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug(trim($request->slug)),
            'image' => $image_name,
            'content' => html_entity_decode($request->content),
            'status' => $request->status
        ]);
        $post->tags()->sync($request->tags);
        session()->flash('success', 'Updated 1 post successfully');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($post_id)
    {
        Post::findOrFail($post_id)->delete();
        session()->flash('success', 'Deleted 1 post successfully');
        return back();
    }
}

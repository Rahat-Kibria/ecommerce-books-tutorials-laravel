<?php

namespace App\Http\Controllers\frontend;

use App\Models\BlogComment;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * Website posts
     */
    private static function tree($categories, $allCategories)
    {
        foreach ($categories as $category) {
            $category->children = $allCategories->where('parent_id', $category->id)->values();
            if ($category->children->isNotEmpty()) {
                self::tree($category->children, $allCategories);
            }
        }
    }
    public function blog_home()
    {
        $allCategories = Category::with('children')->get();
        $rootCategories = $allCategories->whereNull('parent_id');
        self::tree($rootCategories, $allCategories);

        $posts = Post::where('status', 'completed')->latest()->paginate(9);

        $category_ids = Post::where('status', 'completed')->groupBy('category_id')->select('category_id')->pluck('category_id')->all();
        $categories = Category::whereIn('id', $category_ids)->select('name')->take(7)->inRandomOrder()->get();

        $group_years = Post::where('status', 'completed')->latest()->get()->groupBy(function ($date) {
            // return \Carbon\Carbon::parse($date->created_at)->format('Y');
            return $date->created_at->format('Y');
        });

        $tags = Tag::inRandomOrder()->get();

        return view('frontend.pages.blog.blog_list', compact('rootCategories', 'posts', 'categories', 'group_years', 'tags'));
    }
    public function blog_details($post_id)
    {
        $allCategories = Category::with('children')->get();
        $rootCategories = $allCategories->whereNull('parent_id');
        self::tree($rootCategories, $allCategories);

        $post = Post::where('id', $post_id)->with('user', 'category', 'tags')->first();

        $category_ids = Post::where('status', 'completed')->groupBy('category_id')->select('category_id')->pluck('category_id')->all();
        $categories = Category::whereIn('id', $category_ids)->take(7)->inRandomOrder()->get();

        $group_years = Post::where('status', 'completed')->latest()->get()->groupBy(function ($date) {
            // return \Carbon\Carbon::parse($date->created_at)->format('Y');
            return $date->created_at->format('Y');
        });

        $tags = Tag::inRandomOrder()->get();

        $comments_count = BlogComment::where('post_id', $post_id)->count();
        $comments = BlogComment::where('post_id', $post_id)->with([
            'user:id,first_name,last_name,image',
            'replies.user:id,first_name,last_name,image',
            'replies.replies.user:id,first_name,last_name,image',
            'replies.replies.replies.user:id,first_name,last_name,image'
        ])->get();

        return view('frontend.pages.blog.blog_single', compact('rootCategories', 'post', 'categories', 'group_years', 'tags', 'comments_count', 'comments'));
    }
    public function blog_search_post(Request $request)
    {
        $allCategories = Category::with('children')->get();
        $rootCategories = $allCategories->whereNull('parent_id');
        self::tree($rootCategories, $allCategories);

        $request->validate(['blog_post_search' => 'required']);

        $posts = Post::where('title', 'LIKE', '%' . $request->blog_post_search . '%')->paginate(9);

        $category_ids = Post::where('status', 'completed')->groupBy('category_id')->select('category_id')->pluck('category_id')->all();
        $categories = Category::whereIn('id', $category_ids)->take(7)->inRandomOrder()->get();

        $group_years = Post::where('status', 'completed')->latest()->get()->groupBy(function ($date) {
            // return \Carbon\Carbon::parse($date->created_at)->format('Y');
            return $date->created_at->format('Y');
        });

        $tags = Tag::inRandomOrder()->get();

        return view('frontend.pages.blog.blog_search_post', compact('rootCategories', 'posts', 'categories', 'group_years', 'tags'));
    }
    public function blog_posts_by_year($year)
    {
        $allCategories = Category::with('children')->get();
        $rootCategories = $allCategories->whereNull('parent_id');
        self::tree($rootCategories, $allCategories);

        $category_ids = Post::where('status', 'completed')->groupBy('category_id')->select('category_id')->pluck('category_id')->all();
        $categories = Category::whereIn('id', $category_ids)->take(7)->inRandomOrder()->get();

        $group_years = Post::where('status', 'completed')->latest()->get()->groupBy(function ($date) {
            // return \Carbon\Carbon::parse($date->created_at)->format('Y');
            return $date->created_at->format('Y');
        });

        $tags = Tag::inRandomOrder()->get();

        $posts = Post::where('status', 'completed')->whereYear('created_at', $year)->paginate(9);

        return view('frontend.pages.blog.blog_posts_by_year', compact('rootCategories', 'categories', 'group_years', 'posts', 'tags'));
    }
    public function blog_posts_by_category($category_id)
    {
        $allCategories = Category::with('children')->get();
        $rootCategories = $allCategories->whereNull('parent_id');
        self::tree($rootCategories, $allCategories);

        $category_ids = Post::where('status', 'completed')->groupBy('category_id')->select('category_id')->pluck('category_id')->all();
        $categories = Category::whereIn('id', $category_ids)->take(7)->inRandomOrder()->get();

        $group_years = Post::where('status', 'completed')->latest()->get()->groupBy(function ($date) {
            // return \Carbon\Carbon::parse($date->created_at)->format('Y');
            return $date->created_at->format('Y');
        });

        $tags = Tag::inRandomOrder()->get();

        $posts = Post::where('status', 'completed')->where('category_id', $category_id)->paginate(9);

        return view('frontend.pages.blog.blog_posts_by_category', compact('rootCategories', 'categories', 'group_years', 'posts', 'tags'));
    }
    public function blog_posts_by_tag($tag_id)
    {
        $allCategories = Category::with('children')->get();
        $rootCategories = $allCategories->whereNull('parent_id');
        self::tree($rootCategories, $allCategories);

        $category_ids = Post::where('status', 'completed')->groupBy('category_id')->select('category_id')->pluck('category_id')->all();
        $categories = Category::whereIn('id', $category_ids)->take(7)->inRandomOrder()->get();

        $group_years = Post::where('status', 'completed')->latest()->get()->groupBy(function ($date) {
            // return \Carbon\Carbon::parse($date->created_at)->format('Y');
            return $date->created_at->format('Y');
        });

        $tags = Tag::inRandomOrder()->get();

        $tag = Tag::where('id', $tag_id)->firstOrFail();
        $posts = $tag->posts()->paginate(9);

        return view('frontend.pages.blog.blog_posts_by_tag', compact('rootCategories', 'categories', 'group_years', 'posts', 'tags'));
    }
}

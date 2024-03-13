<?php

namespace App\Http\Controllers\frontend;

use App\Models\User;
use App\Models\BlogComment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogCommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function blog_comment_store(Request $request, $post_id)
    {
        $request->validate([
            'message' => 'required|between:5,500',
            'name' => 'required',
            'email' => 'required|email',
        ]);
        $splitName = explode(' ', $request->name, 2); // Restricts it to only 2 values
        $first_name = $splitName[0];
        $last_name = !empty($splitName[1]) ? $splitName[1] : '';
        $user = User::where('email', $request->email)->first();
        if (isset($user) && !empty($user)) {
            $user_id = $user->id;
        } else {
            $user_id = User::create([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $request->email,
            ])->id;
        }
        BlogComment::create([
            'post_id' => $post_id,
            'user_id' => $user_id,
            'parent_id' => $request->parent_id,
            'message' => $request->message,
        ]);
        session()->flash('success', 'Comment posted successfully');
        return back();
    }
}

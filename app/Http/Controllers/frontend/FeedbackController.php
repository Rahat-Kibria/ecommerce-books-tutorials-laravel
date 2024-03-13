<?php

namespace App\Http\Controllers\frontend;

use App\Models\User;
use App\Models\Category;
use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeedbackController extends Controller
{
    private static function tree($categories, $allCategories)
    {
        foreach ($categories as $category) {
            $category->children = $allCategories->where('parent_id', $category->id)->values();
            if ($category->children->isNotEmpty()) {
                self::tree($category->children, $allCategories);
            }
        }
    }
    public function contact()
    {
        $allCategories = Category::with('children')->get();
        $rootCategories = $allCategories->whereNull('parent_id');
        self::tree($rootCategories, $allCategories);
        return view('frontend.pages.contact', compact('rootCategories'));
    }
    public function feedback_submit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required'
        ]);
        $user = User::where('email', $request->email)->first();
        if (isset($user) && !empty($user)) {
            Feedback::create([
                //'database_column_name' => $request->form_column_name_or_value
                'user_id' => $user->id,
                'name' => $request->name,
                'email' => $request->email,
                'message' => $request->message
            ]);
        } else {
            Feedback::create([
                //'database_column_name' => $request->form_column_name_or_value
                'name' => $request->name,
                'email' => $request->email,
                'message' => $request->message
            ]);
        }
        session()->flash('success', 'We received your feedback');
        return redirect()->back();
    }
}

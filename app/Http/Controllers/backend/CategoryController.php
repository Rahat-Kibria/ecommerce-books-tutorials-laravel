<?php

namespace App\Http\Controllers\backend;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function categories_list()
    {
        // DB::enableQueryLog();
        $categories = Category::paginate(10);
        // dd(DB::getQueryLog());
        // "select count(*) as aggregate from `categories`"
        // "select * from `categories` limit 10 offset 0"
        return view('backend.pages.category.category_list', compact('categories'));
    }
    public function category_form()
    {
        // DB::enableQueryLog();
        $categories = Category::with('children')->get();
        // dd(DB::getQueryLog());
        // "select * from `categories` where `categories`.`parent_id` in (11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 83, 84, 85, 86, 87, 88, 89, 95)"
        return view('backend.pages.category.category_form', compact('categories'));
    }
    public function category_form_submit(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100|unique:categories,name',
            'slug' => 'required|max:100',
            'image' => 'image|max:10240',
            'status' => 'required',
        ]);
        $fileName = null;
        if ($request->hasFile('image')) {
            $fileName = date('YmdHis') . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('/uploads/category_images/', $fileName);
        }
        // DB::enableQueryLog();
        Category::create([
            //'database_column_name' => $request->form_column_name_or_value
            'parent_id' => $request->parent_id,
            'name' => $request->name,
            'slug' => Str::slug($request->slug),
            'description' => $request->description,
            'image' => $fileName,
            'status' => $request->status
        ]);
        // dd(DB::getQueryLog());
        // "insert into `categories` (`parent_id`, `name`, `slug`, `description`, `image`, `status`, `updated_at`, `created_at`) values (?, ?, ?, ?, ?, ?, ?, ?)"
        return redirect()->back()->with('success', 'Added 1 item successfully');
    }
    public function viewCategory(int $category_id)
    {
        // DB::enableQueryLog();
        $categories = Category::with('children')->get();
        // "select * from `categories` where `categories`.`parent_id` in (11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 83, 84, 85, 86, 87, 88, 89, 95, 97)"
        $category = Category::find($category_id);
        // "select * from `categories` where `categories`.`id` = ? limit 1"
        // dd(DB::getQueryLog());
        return view('backend.pages.category.view', compact('category', 'categories'));
    }
    public function deleteCategory(int $category_id)
    {
        // DB::enableQueryLog();
        $category = Category::findOrFail($category_id);
        // "select * from `categories` where `categories`.`id` = ? limit 1"
        if (!empty($category->image)) {
            $find_image = public_path() . '/uploads/category_images/' . $category->image;
            File::delete($find_image);
        }
        $category->delete();
        // "delete from `categories` where `id` = ?"
        // dd(DB::getQueryLog());
        return redirect()->back()->with('success', 'Deleted 1 item successfully');
    }
    public function updateCategory($category_id)
    {
        // DB::enableQueryLog();
        $categories = Category::with('children')->get();
        // "select * from `categories` where `categories`.`parent_id` in (11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 83, 84, 85, 86, 87, 88, 89, 95, 97)"
        $category = Category::find($category_id);
        // "select * from `categories` where `categories`.`id` = ? limit 1"
        // dd(DB::getQueryLog());
        return view('backend.pages.category.update', compact('category', 'categories'));
    }
    public function updateCategorySubmit(Request $request, $category_id)
    {
        $request->validate([
            'name' => 'required|max:100',
            'slug' => 'required|max:100',
            'image' => 'image|max:10240',
            'status' => 'required',
        ]);
        // DB::enableQueryLog();
        $category = Category::find($category_id);
        // "select * from `categories` where `categories`.`id` = ? limit 1"
        // $request->image and $request->file('image') are the same thing
        if ($request->hasFile('image')) {
            $removeFile = public_path() . '/uploads/category_images/' . $category->image;
            File::delete($removeFile);
            $fileName = date('YmdHis') . '.' . $request->file('image')->getClientOriginalExtension();
            // storeAs() and move() are the same thing
            $request->file('image')->storeAs('/uploads/category_images/', $fileName);
            $category->update([
                'parent_id' => $request->parent_id,
                'name' => $request->name,
                'slug' => Str::slug($request->slug),
                'description' => $request->description,
                'image' => $fileName,
                'status' => $request->status,
            ]);
            // "update `categories` set `slug` = ?, `image` = ?, `categories`.`updated_at` = ? where `id` = ?""update `categories` set `slug` = ?, `image` = ?, `categories`.`updated_at` = ? where `id` = ?"
            // dd(DB::getQueryLog());
            return redirect()->back()->with('success', 'Updated 1 item successfully');
        } else {
            $category->update([
                'parent_id' => $request->parent_id,
                'name' => $request->name,
                'slug' => $request->slug,
                'description' => $request->description,
                'status' => $request->status,
            ]);
            // "select * from `categories` where `categories`.`id` = ? limit 1"
            // dd(DB::getQueryLog());
            return redirect()->back()->with('success', 'Updated 1 item successfully except image');
        }
    }
    public function category_image_delete($category_id, $image_name)
    {
        // DB::enableQueryLog();
        $category = Category::findOrFail($category_id);
        // "select * from `categories` where `categories`.`id` = ? limit 1"
        $category->update([
            //'database_column_name' => $request->form_column_name_or_value
            'image' => null,
        ]);
        // "update `categories` set `image` = ?, `categories`.`updated_at` = ? where `id` = ?"
        // dd(DB::getQueryLog());
        $find_image = public_path() . '/uploads/category_images/' . $image_name;
        File::delete($find_image);
        session()->flash('success', 'File deleted successfully');
        return back();
    }
}

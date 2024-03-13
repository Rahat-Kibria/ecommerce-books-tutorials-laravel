<?php

namespace App\Http\Controllers\backend;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function products_list()
    {
        $products = Product::paginate(10);
        return view('backend.pages.products.products_list', compact('products'));
    }
    public function product_form()
    {
        $category = Category::all();
        return view('backend.pages.products.products_form', compact('category'));
    }
    public function product_form_submit(Request $request)
    {
        $request->validate([
            'category_id' => 'numeric',
            'name' => ' max:50|filled',
            'author' => ' max:50|filled',
            'short_description' => 'required',
            'description' => 'required',
            'type' => 'required',
            'purchase_price' => 'numeric|required',
            'price' => 'numeric|required',
            'image_1' => 'image|max:10240',
            'image_2' => 'image|max:10240',
            'image_3' => 'image|max:10240',
            'image_4' => 'image|max:10240',
            'image_5' => 'image|max:10240',
            'image_6' => 'image|max:10240',
            'image_7' => 'image|max:10240',
            'video_1' => 'mimes:mp4,flv',
            'video_2' => 'mimes:mp4,flv',
            'video_3' => 'mimes:mp4,flv',
            'video_4' => 'mimes:mp4,flv',
            'video_5' => 'mimes:mp4,flv',
            'video_6' => 'mimes:mp4,flv',
            'video_7' => 'mimes:mp4,flv',
            'discount' => 'numeric|required',
            'quantity' => 'numeric|required',
            'stock_status' => 'required',
            'featured' => 'required'
        ]);
        $image_1 = NULL;
        $image_2 = NULL;
        $image_3 = NULL;
        $image_4 = NULL;
        $image_5 = NULL;
        $image_6 = NULL;
        $image_7 = NULL;
        if ($request->hasFile('image_1')) {
            $image_1_ext = $request->file('image_1')->getClientOriginalExtension();
            $image_1 = date('YmdHis') . 'a' . '.' . $image_1_ext;
            $request->file('image_1')->storeAs('/uploads/product_images/', $image_1);
        }
        if ($request->hasFile('image_2')) {
            $image_2_ext = $request->file('image_2')->getClientOriginalExtension();
            $image_2 = date('YmdHis') . 'b' . '.' . $image_2_ext;
            $request->file('image_2')->storeAs('/uploads/product_images/', $image_2);
        }
        if ($request->hasFile('image_3')) {
            $image_3_ext = $request->file('image_3')->getClientOriginalExtension();
            $image_3 = date('YmdHis') . 'c' . '.' . $image_3_ext;
            $request->file('image_3')->storeAs('/uploads/product_images/', $image_3);
        }
        if ($request->hasFile('image_4')) {
            $image_4_ext = $request->file('image_4')->getClientOriginalExtension();
            $image_4 = date('YmdHis') . 'd' . '.' . $image_4_ext;
            $request->file('image_4')->storeAs('/uploads/product_images/', $image_4);
        }
        if ($request->hasFile('image_5')) {
            $image_5_ext = $request->file('image_5')->getClientOriginalExtension();
            $image_5 = date('YmdHis') . 'e' . '.' . $image_5_ext;
            $request->file('image_5')->storeAs('/uploads/product_images/', $image_5);
        }
        if ($request->hasFile('image_6')) {
            $image_6_ext = $request->file('image_6')->getClientOriginalExtension();
            $image_6 = date('YmdHis') . 'f' . '.' . $image_6_ext;
            $request->file('image_6')->storeAs('/uploads/product_images/', $image_6);
        }
        if ($request->hasFile('image_7')) {
            $image_7_ext = $request->file('image_7')->getClientOriginalExtension();
            $image_7 = date('YmdHis') . 'g' . '.' . $image_7_ext;
            $request->file('image_7')->storeAs('/uploads/product_images/', $image_7);
        }
        $images = array($image_1, $image_2, $image_3, $image_4, $image_5, $image_6, $image_7);
        $video_1 = NULL;
        $video_2 = NULL;
        $video_3 = NULL;
        $video_4 = NULL;
        $video_5 = NULL;
        $video_6 = NULL;
        $video_7 = NULL;
        if ($request->hasFile('video_1')) {
            $video_1_ext = $request->file('video_1')->getClientOriginalExtension();
            $video_1 = date('YmdHis') . 'a' . '.' . $video_1_ext;
            $request->file('video_1')->storeAs('/uploads/product_videos/', $video_1);
        }
        if ($request->hasFile('video_2')) {
            $video_2_ext = $request->file('video_2')->getClientOriginalExtension();
            $video_2 = date('YmdHis') . 'b' . '.' . $video_2_ext;
            $request->file('video_2')->storeAs('/uploads/product_videos/', $video_2);
        }
        if ($request->hasFile('video_3')) {
            $video_3_ext = $request->file('video_3')->getClientOriginalExtension();
            $video_3 = date('YmdHis') . 'c' . '.' . $video_3_ext;
            $request->file('video_3')->storeAs('/uploads/product_videos/', $video_3);
        }
        if ($request->hasFile('video_4')) {
            $video_4_ext = $request->file('video_4')->getClientOriginalExtension();
            $video_4 = date('YmdHis') . 'd' . '.' . $video_4_ext;
            $request->file('video_4')->storeAs('/uploads/product_videos/', $video_4);
        }
        if ($request->hasFile('video_5')) {
            $video_5_ext = $request->file('video_5')->getClientOriginalExtension();
            $video_5 = date('YmdHis') . 'e' . '.' . $video_5_ext;
            $request->file('video_5')->storeAs('/uploads/product_videos/', $video_5);
        }
        if ($request->hasFile('video_6')) {
            $video_6_ext = $request->file('video_6')->getClientOriginalExtension();
            $video_6 = date('YmdHis') . 'f' . '.' . $video_6_ext;
            $request->file('video_6')->storeAs('/uploads/product_videos/', $video_6);
        }
        if ($request->hasFile('video_7')) {
            $video_7_ext = $request->file('video_7')->getClientOriginalExtension();
            $video_7 = date('YmdHis') . 'g' . '.' . $video_7_ext;
            $request->file('video_7')->storeAs('/uploads/product_videos/', $video_7);
        }
        $videos = array($video_1, $video_2, $video_3, $video_4, $video_5, $video_6, $video_7);
        Product::create([
            //'database_column_name' => $request->form_column_name_or_value
            'category_id' => $request->category_id,
            'name' => $request->name,
            'author' => $request->author,
            'slug' => Str::slug($request->slug),
            'short_description' => $request->short_description,
            'description' => $request->description,
            'type' => $request->type,
            'purchase_price' => $request->purchase_price,
            'price' => $request->price,
            'image' => json_encode($images),
            'video' => json_encode($videos),
            'discount' => $request->discount,
            'quantity' => $request->quantity,
            'stock_status' => $request->stock_status,
            'featured' => $request->featured
        ]);
        return redirect()->back()->with('success', 'Added 1 product successfully');
    }
    public function view_product($product_id)
    {
        $categories = Category::with('children')->get();
        $product = Product::find($product_id);
        return view('backend.pages.products.product_view', compact('product', 'categories'));
    }
    public function delete_product($product_id)
    {
        $product = Product::find($product_id);
        if (!empty($product->image)) {
            $image = json_decode($product->image);
            for ($i = 0; $i <= 6; $i++) {
                if (!empty($image[$i])) {
                    $find_image = public_path() . '/uploads/product_images/' . $image[$i];
                    File::delete($find_image);
                }
            }
        }
        if (!empty($product->video)) {
            $video = json_decode($product->video);
            for ($i = 0; $i <= 6; $i++) {
                if (!empty($video[$i])) {
                    $find_video = public_path() . '/uploads/product_videos/' . $video[$i];
                    File::delete($find_video);
                }
            }
        }
        $product->delete();
        return redirect()->back()->with('success', 'Deleted 1 product successfully');
    }
    public function edit_product($product_id)
    {
        $product = Product::find($product_id);
        $category = Category::all();
        return view('backend.pages.products.products_edit', compact('category', 'product'));
    }
    public function update_product(Request $request, $product_id)
    {
        $request->validate([
            'category_id' => 'numeric',
            'name' => ' max:50|filled',
            'author' => ' max:50|filled',
            'short_description' => 'required',
            'description' => 'required',
            'type' => 'required',
            'purchase_price' => 'numeric|required',
            'price' => 'numeric|required',
            'discount' => 'numeric|required',
            'quantity' => 'numeric|required',
            'stock_status' => 'required',
            'featured' => 'required'
        ]);
        $product = Product::find($product_id);
        $product->update([
            //'database_column_name' => $request->form_column_name_or_value
            'category_id' => $request->category_id,
            'name' => $request->name,
            'author' => $request->author,
            'slug' => Str::slug($request->slug),
            'short_description' => $request->short_description,
            'description' => $request->description,
            'type' => $request->type,
            'purchase_price' => $request->purchase_price,
            'price' => $request->price,
            'discount' => $request->discount,
            'quantity' => $request->quantity,
            'stock_status' => $request->stock_status,
            'featured' => $request->featured
        ]);
        return redirect()->back()->with('success', 'Updated 1 product successfully');
    }
    public function update_product_image(Request $request, $product_id)
    {
        $request->validate([
            'image' => 'mimes:png,jpg,jpeg,gif'
        ]);
        $product = Product::find($product_id);
        $productImage = json_decode($product->image);
        (!empty($productImage[0])) ? $image_1 = $productImage[0] : $image_1 = NULL;
        (!empty($productImage[1])) ? $image_2 = $productImage[1] : $image_2 = NULL;
        (!empty($productImage[2])) ? $image_3 = $productImage[2] : $image_3 = NULL;
        (!empty($productImage[3])) ? $image_4 = $productImage[3] : $image_4 = NULL;
        (!empty($productImage[4])) ? $image_5 = $productImage[4] : $image_5 = NULL;
        (!empty($productImage[5])) ? $image_6 = $productImage[5] : $image_6 = NULL;
        (!empty($productImage[6])) ? $image_7 = $productImage[6] : $image_7 = NULL;
        if ($request->hasFile('image_1')) {
            if (!empty($productImage[0])) {
                $removeFile_1 = public_path() . '/uploads/product_images/' . $productImage[0];
                File::delete($removeFile_1);
            }
            $image_1_ext = $request->file('image_1')->getClientOriginalExtension();
            $image_1 = date('YmdHis') . 'a' . '.' . $image_1_ext;
            $request->file('image_1')->storeAs('/uploads/product_images/', $image_1);
        }
        if ($request->hasFile('image_2')) {
            if (!empty($productImage[1])) {
                $removeFile_2 = public_path() . '/uploads/product_images/' . $productImage[1];
                File::delete($removeFile_2);
            }
            $image_2_ext = $request->file('image_2')->getClientOriginalExtension();
            $image_2 = date('YmdHis') . 'b' . '.' . $image_2_ext;
            $request->file('image_2')->storeAs('/uploads/product_images/', $image_2);
        }
        if ($request->hasFile('image_3')) {
            if (!empty($productImage[2])) {
                $removeFile_3 = public_path() . '/uploads/product_images/' . $productImage[2];
                File::delete($removeFile_3);
            }
            $image_3_ext = $request->file('image_3')->getClientOriginalExtension();
            $image_3 = date('YmdHis') . 'c' . '.' . $image_3_ext;
            $request->file('image_3')->storeAs('/uploads/product_images/', $image_3);
        }
        if ($request->hasFile('image_4')) {
            if (!empty($productImage[3])) {
                $removeFile_4 = public_path() . '/uploads/product_images/' . $productImage[3];
                File::delete($removeFile_4);
            }
            $image_4_ext = $request->file('image_4')->getClientOriginalExtension();
            $image_4 = date('YmdHis') . 'd' . '.' . $image_4_ext;
            $request->file('image_4')->storeAs('/uploads/product_images/', $image_4);
        }
        if ($request->hasFile('image_5')) {
            if (!empty($productImage[4])) {
                $removeFile_5 = public_path() . '/uploads/product_images/' . $productImage[4];
                File::delete($removeFile_5);
            }
            $image_5_ext = $request->file('image_5')->getClientOriginalExtension();
            $image_5 = date('YmdHis') . 'e' . '.' . $image_5_ext;
            $request->file('image_5')->storeAs('/uploads/product_images/', $image_5);
        }
        if ($request->hasFile('image_6')) {
            if (!empty($productImage[5])) {
                $removeFile_6 = public_path() . '/uploads/product_images/' . $productImage[5];
                File::delete($removeFile_6);
            }
            $image_6_ext = $request->file('image_6')->getClientOriginalExtension();
            $image_6 = date('YmdHis') . 'f' . '.' . $image_6_ext;
            $request->file('image_6')->storeAs('/uploads/product_images/', $image_6);
        }
        if ($request->hasFile('image_7')) {
            if (!empty($productImage[6])) {
                $removeFile_7 = public_path() . '/uploads/product_images/' . $productImage[6];
                File::delete($removeFile_7);
            }
            $image_7_ext = $request->file('image_7')->getClientOriginalExtension();
            $image_7 = date('YmdHis') . 'g' . '.' . $image_7_ext;
            $request->file('image_7')->storeAs('/uploads/product_images/', $image_7);
        }
        $images = array($image_1, $image_2, $image_3, $image_4, $image_5, $image_6, $image_7);
        $product->update([
            //'database_column_name' => $request->form_column_name_or_value
            'image' => json_encode($images),
        ]);
        return redirect()->back()->with('success', 'Updated 1 product image successfully');
    }
    public function update_product_video(Request $request, $product_id)
    {
        $request->validate([
            'video' => 'mimes:mp4,flv'
        ]);
        $product = Product::find($product_id);
        $productVideo = json_decode($product->video);
        (!empty($productVideo[0])) ? $video_1 = $productVideo[0] : $video_1 = NULL;
        (!empty($productVideo[1])) ? $video_2 = $productVideo[1] : $video_2 = NULL;
        (!empty($productVideo[2])) ? $video_3 = $productVideo[2] : $video_3 = NULL;
        (!empty($productVideo[3])) ? $video_4 = $productVideo[3] : $video_4 = NULL;
        (!empty($productVideo[4])) ? $video_5 = $productVideo[4] : $video_5 = NULL;
        (!empty($productVideo[5])) ? $video_6 = $productVideo[5] : $video_6 = NULL;
        (!empty($productVideo[6])) ? $video_7 = $productVideo[6] : $video_7 = NULL;
        if ($request->hasFile('video_1')) {
            if (!empty($productVideo[0])) {
                $removeFile_1 = public_path() . '/uploads/product_videos/' . $productVideo[0];
                File::delete($removeFile_1);
            }
            $video_1_ext = $request->file('video_1')->getClientOriginalExtension();
            $video_1 = date('YmdHis') . 'a' . '.' . $video_1_ext;
            $request->file('video_1')->storeAs('/uploads/product_videos/', $video_1);
        }
        if ($request->hasFile('video_2')) {
            if (!empty($productVideo[1])) {
                $removeFile_2 = public_path() . '/uploads/product_videos/' . $productVideo[1];
                File::delete($removeFile_2);
            }
            $video_2_ext = $request->file('video_2')->getClientOriginalExtension();
            $video_2 = date('YmdHis') . 'b' . '.' . $video_2_ext;
            $request->file('video_2')->storeAs('/uploads/product_videos/', $video_2);
        }
        if ($request->hasFile('video_3')) {
            if (!empty($productVideo[2])) {
                $removeFile_3 = public_path() . '/uploads/product_videos/' . $productVideo[2];
                File::delete($removeFile_3);
            }
            $video_3_ext = $request->file('video_3')->getClientOriginalExtension();
            $video_3 = date('YmdHis') . 'c' . '.' . $video_3_ext;
            $request->file('video_3')->storeAs('/uploads/product_videos/', $video_3);
        }
        if ($request->hasFile('video_4')) {
            if (!empty($productVideo[3])) {
                $removeFile_4 = public_path() . '/uploads/product_videos/' . $productVideo[3];
                File::delete($removeFile_4);
            }
            $video_4_ext = $request->file('video_4')->getClientOriginalExtension();
            $video_4 = date('YmdHis') . 'd' . '.' . $video_4_ext;
            $request->file('video_4')->storeAs('/uploads/product_videos/', $video_4);
        }
        if ($request->hasFile('video_5')) {
            if (!empty($productVideo[4])) {
                $removeFile_5 = public_path() . '/uploads/product_videos/' . $productVideo[4];
                File::delete($removeFile_5);
            }
            $video_5_ext = $request->file('video_5')->getClientOriginalExtension();
            $video_5 = date('YmdHis') . 'e' . '.' . $video_5_ext;
            $request->file('video_5')->storeAs('/uploads/product_videos/', $video_5);
        }
        if ($request->hasFile('video_6')) {
            if (!empty($productVideo[5])) {
                $removeFile_6 = public_path() . '/uploads/product_videos/' . $productVideo[5];
                File::delete($removeFile_6);
            }
            $video_6_ext = $request->file('video_6')->getClientOriginalExtension();
            $video_6 = date('YmdHis') . 'f' . '.' . $video_6_ext;
            $request->file('video_6')->storeAs('/uploads/product_videos/', $video_6);
        }
        if ($request->hasFile('video_7')) {
            if (!empty($productVideo[6])) {
                $removeFile_7 = public_path() . '/uploads/product_videos/' . $productVideo[6];
                File::delete($removeFile_7);
            }
            $video_7_ext = $request->file('video_7')->getClientOriginalExtension();
            $video_7 = date('YmdHis') . 'g' . '.' . $video_7_ext;
            $request->file('video_7')->storeAs('/uploads/product_videos/', $video_7);
        }
        $videos = array($video_1, $video_2, $video_3, $video_4, $video_5, $video_6, $video_7);
        $product->update([
            //'database_column_name' => $request->form_column_name_or_value
            'video' => json_encode($videos),
        ]);
        return redirect()->back()->with('success', 'Updated 1 product video successfully');
    }
    public function product_image_delete($product_id, $image_name)
    {
        $product = Product::findOrFail($product_id);
        $image = json_decode($product->image);
        for ($i = 0; $i <= 6; $i++) {
            if (!empty($image[$i])) {
                if ($image[$i] == $image_name) {
                    $image[$i] = NULL;
                }
            }
        }
        $images = array($image[0], $image[1], $image[2], $image[3], $image[4], $image[5], $image[6]);
        $product->update([
            //'database_column_name' => $request->form_column_name_or_value
            'image' => json_encode($images),
        ]);
        $find_image = public_path() . '/uploads/product_images/' . $image_name;
        File::delete($find_image);
        session()->flash('success', 'File deleted successfully');
        return back();
    }
    public function product_video_delete($product_id, $video_name)
    {
        $product = Product::findOrFail($product_id);
        $video = json_decode($product->video);
        for ($i = 0; $i <= 6; $i++) {
            if (!empty($video[$i])) {
                if ($video[$i] == $video_name) {
                    $video[$i] = NULL;
                }
            }
        }
        $videos = array($video[0], $video[1], $video[2], $video[3], $video[4], $video[5], $video[6]);
        $product->update([
            //'database_column_name' => $request->form_column_name_or_value
            'video' => json_encode($videos),
        ]);
        $find_video = public_path() . '/uploads/product_videos/' . $video_name;
        File::delete($find_video);
        session()->flash('success', 'File deleted successfully');
        return back();
    }
}

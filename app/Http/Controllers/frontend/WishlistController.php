<?php

namespace App\Http\Controllers\frontend;

use App\Models\Category;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WishlistController extends Controller
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
    public function add_to_wishlist($product_id)
    {
        $product_exits = Wishlist::where('product_id', $product_id)->first();
        if (auth()->check() && $product_exits == null) {
            Wishlist::insert([
                'product_id' => $product_id,
                'user_id' => auth()->user()->id
            ]);
            session()->flash('success', 'Successfully added to wishlist');
        } elseif (auth()->check() && $product_exits) {
            session()->flash('error', 'Product already added to wishlist');
        } else {
            session()->flash('error', 'You have to login to add to wishlist');
        }
        return back();
    }
    public function wishlist_page()
    {
        $allCategories = Category::with('children')->get();
        $rootCategories = $allCategories->whereNull('parent_id');
        self::tree($rootCategories, $allCategories);

        $wishlist_products = Wishlist::where('user_id', auth()->user()->id)->latest()->get();

        return view('frontend.pages.customer.wishlist', compact('rootCategories', 'wishlist_products'));
    }
    public function wishlist_item_delete($wishlist_id)
    {
        Wishlist::findOrFail($wishlist_id)->delete();
        session()->flash('success', 'Removed from wishlist successfully');
        return back();
    }
}

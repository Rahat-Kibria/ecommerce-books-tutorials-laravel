<?php

namespace App\Http\Controllers\backend;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WishlistController extends Controller
{
    public function wishlists_list()
    {
        $wishlists_by_user = Wishlist::groupBy('user_id')->select('user_id')->paginate(10);
        return view('backend.pages.wishlist.wishlist_list', compact('wishlists_by_user'));
    }
    public function wishlist_view($wishlist_user_id)
    {
        $wishlist_products = Wishlist::where('user_id', $wishlist_user_id)->with('product')->get();
        return view('backend.pages.wishlist.wishlist_view', compact('wishlist_user_id', 'wishlist_products'));
    }
}

<?php

namespace App\Http\Controllers\backend;

use Carbon\Carbon;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    /**
     * Carts list in admin panel
     */
    public function carts_list()
    {
        $carts = Cart::groupBy('ip_address')->select('ip_address')->paginate(10);
        return view('backend.pages.cart.cart_list', compact('carts'));
    }
    public function cart_products_view($ip_address)
    {
        $cart_products = Cart::where('ip_address', $ip_address)->with('product')->get();
        return view('backend.pages.cart.cart_view', compact('cart_products', 'ip_address'));
    }
    public function cart_delete_if_expired()
    {
        $cart_ip_addresses = Cart::groupBy('ip_address')->select('ip_address')->get();
        foreach ($cart_ip_addresses as $cart_ip_address) {
            $cart_ip_all = Cart::where('ip_address', $cart_ip_address->ip_address);
            $cart_ip_wise = Cart::where('ip_address', $cart_ip_address->ip_address)->get();
            $check_expiry = $cart_ip_wise->first()->created_at->addDays(3) > Carbon::now();
            if ($check_expiry) {
                session()->flash('error', 'Cart has to expire');
            } else {
                $cart_ip_all->delete();
                session()->flash('success', 'IP-wise Cart deleted successfully');
            }
        }
        return back();
    }
}

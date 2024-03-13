<?php

namespace App\Http\Controllers\frontend;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
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
    /**
     * add to cart
     */
    public function add_to_cart($product_id)
    {
        if (auth()->check()) {
            $check = Cart::where('product_id', $product_id)->where('user_id', Auth::id())->first();
            if ($check != NULL && $check->product->type == 'Book') {
                $check->increment('quantity');
                session()->flash('success', 'Successfully added to cart');
            } elseif ($check != NULL && $check->product->type == 'Tutorial') {
                session()->flash('error', 'Product already added to cart');
            } else {
                Cart::create([
                    'product_id' => $product_id,
                    'user_id' => auth()->user()->id,
                    'quantity' => 1,
                ]);
                session()->flash('success', 'Successfully added to cart');
            }
        } else {
            $check = Cart::where('product_id', $product_id)->where('ip_address', request()->ip())->first();
            if ($check != NULL && $check->product->type == 'Book') {
                $check->increment('quantity');
                session()->flash('success', 'Successfully added to cart');
            } elseif ($check != NULL && $check->product->type == 'Tutorial') {
                session()->flash('error', 'Product already added to cart');
            } else {
                Cart::create([
                    'product_id' => $product_id,
                    'quantity' => 1,
                    'ip_address' => request()->ip()
                ]);
                session()->flash('success', 'Successfully added to cart');
            }
        }
        return back();
    }
    public function cart_item_delete($cart_id)
    {
        Cart::findOrFail($cart_id)->delete();
        session()->flash('success', 'Cart item deleted successfully');
        return back();
    }

    public function cart()
    {
        // unlimited child category
        $allCategories = Category::with('children')->get();
        $rootCategories = $allCategories->whereNull('parent_id');
        self::tree($rootCategories, $allCategories);

        if (auth()->check()) {
            $cart_products = Cart::where('user_id', auth()->user()->id)->latest()->get();

            $cart_products_ids = $cart_products->pluck('product_id')->all();

            if (count($cart_products) > 0) {
                $category_ids = [];
                foreach ($cart_products as $cart_product) {
                    $category_ids[] = $cart_product->product->category_id;
                }
                $related_products = Product::whereIn('category_id', $category_ids)->whereNotIn('id', $cart_products_ids)->take(5)->get();
            } else {
                $related_products = null;
            }
        } else {
            $cart_products = Cart::where('ip_address', request()->ip())->latest()->get();

            $cart_products_ids = $cart_products->pluck('product_id')->all();

            if (count($cart_products) > 0) {
                $category_ids = [];
                foreach ($cart_products as $cart_product) {
                    $category_ids[] = $cart_product->product->category_id;
                }
                $related_products = Product::whereIn('category_id', $category_ids)->whereNotIn('id', $cart_products_ids)->take(5)->get();
            } else {
                $related_products = null;
            }
        }

        return view('frontend.pages.cart', compact('rootCategories', 'cart_products', 'related_products'));
    }

    public function cart_update_multi(Request $request)
    {
        $input = $request->all();
        $rules = [
            'quantity' => 'required',
        ];
        $messages = [
            'quantity.required' => '*Quantity is required',
        ];
        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            return response()->json($validator);
        }
        $length = count($request->cart_id);
        for ($i = 0; $i < $length; $i++) {
            $cart_quantity = Cart::where('id', $request->cart_id[$i])->where('quantity', $request->quantity[$i])->first();
            if ($cart_quantity) {
            } else {
                Cart::where('id', $request->cart_id[$i])->update([
                    'quantity' => $request->quantity[$i]
                ]);
                session()->flash('success', 'Cart updated successfully');
            }
        }
        return redirect()->back();
    }

    public function coupon_session_create(Request $request)
    {
        $request->validate(['coupon_code' => 'required']);
        $coupon = Coupon::where('code', $request->coupon_code)->first();
        if ($coupon) {
            Session::put('coupon', [
                'coupon_code' => $coupon->code,
                'coupon_discount' => $coupon->discount
            ]);
            session()->flash('success', 'Coupon applied successfully');
        } elseif ($request->coupon_code == null) {
        } else {
            session()->flash('error', 'This Coupon does not exist');
        }
        return redirect()->back();
    }

    public function cart_update_single(Request $request, $product_id)
    {
        $input = $request->all();
        $rules = [
            'quantity' => 'required',
        ];
        $messages = [
            'quantity.required' => '*Quantity is required',
        ];
        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            return response()->json($validator);
        }
        $cart = Cart::where('product_id', $product_id)->first();
        if ($cart != null) {
            $cart->update([
                'quantity' => ($cart->quantity + $request->quantity)
            ]);
            session()->flash('success', 'Cart updated successfully');
        } else {
            if (auth()->check()) {
                Cart::insert([
                    'product_id' => $product_id,
                    'quantity' => $request->quantity,
                    'user_id' => auth()->user()->id
                ]);
                session()->flash('success', 'Successfully added to cart');
            } else {
                Cart::insert([
                    'product_id' => $product_id,
                    'quantity' => $request->quantity,
                    'ip_address' => request()->ip()
                ]);
                session()->flash('success', 'Successfully added to cart');
            }
        }
        return redirect()->back();
    }
}

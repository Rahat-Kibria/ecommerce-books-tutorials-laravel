<?php

namespace App\Http\Controllers\frontend;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use App\Models\ProductReview;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    /**
     * Update or Insert product review under product
     */
    public function product_review(Request $request)
    {
        $input = $request->all();
        $rules = [
            'rating' => 'required|numeric|between:1,5',
            'message' => 'required|string|between:5,300',
            'product_id' => 'required',
            'email' => 'required|email',
        ];
        $messages = [
            'rating.required' => 'Rating has to be given',
            'rating.numeric' => 'Rating has to be numeric',
            'rating.between' => 'Rating has to be between 1 and 5',
            'message.required' => 'Message is required',
            'message.numeric' => 'Message has to be string',
            'message.between' => 'Message has to be between 5 and 300 characters',
            'product_id.required' => 'Product id is required',
            'email.required' => 'Email is required',
            'email.email' => 'It has to be an email format',
        ];
        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        $user = User::where('email', $request->email)->first();
        $order_details = OrderDetails::where('product_id', $request->product_id)->first();
        if ($order_details != null && $user != null) {
            $order = Order::where('id', $order_details->order_id)->where('user_id', $user->id)->first();
        }
        if (!empty($order) && $order->is_completed == 'yes') {
            ProductReview::updateOrInsert(
                [
                    'product_id' => $request->product_id,
                    'user_id' => $user->id
                ],
                [
                    'rating' => $request->rating,
                    'message' => $request->message,
                    'status' => 'pending',
                    'created_at' => Carbon::now()
                ]
            );
            return back()->with('success', 'We successfully received your review');
        } elseif (!empty($order) && $order->is_completed == 'no') {
            return back()->with('error', 'You have to get the product in your hand');
        } else {
            return back()->with('error', 'You have to purchase the product first');
        }
    }
    private static function tree($categories, $allCategories)
    {
        foreach ($categories as $category) {
            $category->children = $allCategories->where('parent_id', $category->id)->values();
            if ($category->children->isNotEmpty()) {
                self::tree($category->children, $allCategories);
            }
        }
    }
    public function my_reviews_history()
    {
        $allCategories = Category::with('children')->get();
        $rootCategories = $allCategories->whereNull('parent_id');
        self::tree($rootCategories, $allCategories);

        $product_ids_from_pr = ProductReview::where('user_id', auth()->user()->id)->pluck('product_id')->all();
        $products = Product::whereIn('id', $product_ids_from_pr)->get();

        return view('frontend.pages.customer.my_reviews_history', compact('rootCategories', 'products'));
    }
    public function my_reviews_pending()
    {
        $allCategories = Category::with('children')->get();
        $rootCategories = $allCategories->whereNull('parent_id');
        self::tree($rootCategories, $allCategories);

        $order_ids = Order::where('user_id', auth()->user()->id)->where('is_completed', 'yes')->pluck('id')->all();
        if (!empty($order_ids)) {
            $product_ids_from_od = OrderDetails::whereIn('order_id', $order_ids)->pluck('product_id')->all();
            $product_ids_from_pr = ProductReview::whereIn('product_id', $product_ids_from_od)->where('user_id', auth()->user()->id)->pluck('product_id')->all();
            $products = Product::whereIn('id', $product_ids_from_od)->whereNotIn('id', $product_ids_from_pr)->get();
        } else {
            session()->flash('error', 'Order has not been completed');
            $products = [];
        }
        return view('frontend.pages.customer.my_reviews_pending', compact('rootCategories', 'products'));
    }
    public function my_review_create($product_id)
    {
        $allCategories = Category::with('children')->get();
        $rootCategories = $allCategories->whereNull('parent_id');
        self::tree($rootCategories, $allCategories);

        $product = Product::findOrFail($product_id);
        return view('frontend.pages.customer.my_review_create', compact('rootCategories', 'product'));
    }
    /**
     * Create product review under user
     */
    public function my_review_submit(Request $request)
    {
        $input = $request->all();
        $rules = [
            'rating' => 'required|numeric|between:1,5',
            'message' => 'required|string|between:5,300',
            'product_id' => 'required',
        ];
        $messages = [
            'rating.required' => 'Rating has to be given',
            'rating.numeric' => 'Rating has to be numeric',
            'rating.between' => 'Rating has to be between 1 and 5',
            'message.required' => 'Message is required',
            'message.numeric' => 'Message has to be string',
            'message.between' => 'Message has to be between 5 and 300 characters',
            'product_id.required' => 'Product id is required',
        ];
        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        ProductReview::create([
            'product_id' => $request->product_id,
            'user_id' => auth()->user()->id,
            'rating' => $request->rating,
            'message' => $request->message,
        ]);
        return redirect()->route('botu.account.my_reviews_history')->with('success', 'We successfully received your review');
    }
    public function my_review_edit($product_id)
    {
        $allCategories = Category::with('children')->get();
        $rootCategories = $allCategories->whereNull('parent_id');
        self::tree($rootCategories, $allCategories);

        $product = Product::findOrFail($product_id);
        $product_review = ProductReview::where('product_id', $product_id)->where('user_id', auth()->user()->id)->first();

        return view('frontend.pages.customer.my_review_edit', compact('rootCategories', 'product', 'product_review'));
    }
    /**
     * Create product review under user
     */
    public function my_review_update(Request $request, $product_review_id)
    {
        $input = $request->all();
        $rules = [
            'rating' => 'required|numeric|between:1,5',
            'message' => 'required|string|between:5,300',
        ];
        $messages = [
            'rating.required' => 'Rating has to be given',
            'rating.numeric' => 'Rating has to be numeric',
            'rating.between' => 'Rating has to be between 1 and 5',
            'message.required' => 'Message is required',
            'message.numeric' => 'Message has to be string',
            'message.between' => 'Message has to be between 5 and 300 characters',
        ];
        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        $product_review = ProductReview::findOrFail($product_review_id);
        $product_review->update([
            'rating' => $request->rating,
            'message' => $request->message,
        ]);
        return redirect()->route('botu.account.my_reviews_history')->with('success', 'Review successfully updated');
    }
}

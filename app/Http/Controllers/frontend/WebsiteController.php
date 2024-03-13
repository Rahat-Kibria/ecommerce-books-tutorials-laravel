<?php

namespace App\Http\Controllers\frontend;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ProductReview;
use App\Models\SubscribeNewsletter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class WebsiteController extends Controller
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
    public function botu()
    {
        // unlimited child category
        $allCategories = Category::with('children')->get();
        $rootCategories = $allCategories->whereNull('parent_id');
        self::tree($rootCategories, $allCategories);

        // Show products under Islamic Category
        $islamicCategory_ids = Category::where('parent_id', 11)->pluck('id')->all();
        $productsUnderIslamicCategory = Product::whereIn('category_id', $islamicCategory_ids)->take(10)->inRandomOrder()->get();

        // Show products under Programming Category
        $programmingCategory_ids = Category::where('parent_id', 23)->pluck('id')->all();
        $productsUnderProgrammingCategory = Product::whereIn('category_id', $programmingCategory_ids)->take(10)->inRandomOrder()->get();

        // Show products under web design and development Category
        // $webCategories = Category::with(['products', 'children.products'])->where('parent_id', 28)->inRandomOrder()->get();
        // $parent_category = Category::where('id', 28);
        $first_gen_cat_ids = Category::where('parent_id', 28)->pluck('id')->all();
        $second_gen_cats = Category::whereIn('parent_id', $first_gen_cat_ids)->get();
        $second_gen_cat_ids = $second_gen_cats->pluck('id')->all();
        // grandparent_cat_Products
        $productsUnderWebCategory = Product::whereIn('category_id', $second_gen_cat_ids)->take(10)->inRandomOrder()->get();

        // Special offer
        $special_offer_products = Product::where('discount', '>=', 20)->take(7)->inRandomOrder()->get();

        // New Arrivals Products
        $new_arrivals_products = Product::latest()->take(16)->get();

        // Featured Products
        $featured_products = Product::where('featured', 'Yes')->take(16)->inRandomOrder()->get();

        // Most Viewed Products
        $most_viewed_products = Product::orderByDesc('viewed')->take(16)->get();

        // User/client testimonials/reviews
        $user_reviews = ProductReview::where('rating', '=', 5)->with('user')->take(5)->inRandomOrder()->get();

        return view('frontend.pages.home', compact(['rootCategories', 'productsUnderIslamicCategory', 'productsUnderProgrammingCategory', 'productsUnderWebCategory', 'special_offer_products', 'new_arrivals_products', 'featured_products', 'most_viewed_products', 'user_reviews']));
    }
    public function author_instructor_page($name)
    {
        // unlimited child category
        $allCategories = Category::with('children')->get();
        $rootCategories = $allCategories->whereNull('parent_id');
        self::tree($rootCategories, $allCategories);

        $auth_instructor = Product::where('author', $name)->groupBy('author')->select('author')->first();
        return view('frontend.pages.auth_instructor', compact('rootCategories', 'auth_instructor'));
    }
    public function clear_session(Request $request)
    {
        if (session()->has('coupon')) {
            $request->session()->forget('coupon');
            session()->flash('success', 'Coupon removed successfully');
        }
        // to remove everything from session
        // session()->flush();
        return back();
    }
    public function faq()
    {
        $allCategories = Category::with('children')->get();
        $rootCategories = $allCategories->whereNull('parent_id');
        self::tree($rootCategories, $allCategories);
        return view('frontend.valueless.faq', compact('rootCategories'));
    }
    public function terms_and_conditions()
    {
        $allCategories = Category::with('children')->get();
        $rootCategories = $allCategories->whereNull('parent_id');
        self::tree($rootCategories, $allCategories);
        return view('frontend.valueless.terms_and_conditions', compact('rootCategories'));
    }
    public function subscribe_newsletter(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:subscribe_newsletters,email'
        ]);
        if ($validator->fails()) {
            session()->flash('error', 'Type your email properly');
            return back()->withErrors($validator);
        }
        SubscribeNewsletter::create([
            'email' => $request->email
        ]);
        session()->flash('success', 'You subscribed for our newsletters');
        return back();
    }
}

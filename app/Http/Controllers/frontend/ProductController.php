<?php

namespace App\Http\Controllers\frontend;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ProductReview;
use App\Models\ProductSession;
use App\Http\Controllers\Controller;

// ini_set('post_max_size', '1024M');
// ini_set('upload_max_filesize', '1024M');
// ini_set('memory_limit', '512M');

class ProductController extends Controller
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
    public function view_product_details($product_id, $product_slug)
    {

        // Unlimited Child Category
        $allCategories = Category::with('children')->get();
        $rootCategories = $allCategories->whereNull('parent_id');
        self::tree($rootCategories, $allCategories);

        // for most viewed products
        $session_id = session()->getId();
        $session_check = ProductSession::where('product_id', $product_id)->where('session_id', $session_id)->first();
        $view_null_check = Product::where('id', $product_id)->where('viewed', 0)->first();
        if (isset($session_check)) {
            if (isset($view_null_check)) {
                $view_null_check->increment('viewed');
            }
        } else {
            ProductSession::insert([
                'product_id' => $product_id,
                'session_id' => $session_id
            ]);
            if (isset($view_null_check)) {
                $view_null_check->increment('viewed');
            } else {
                Product::where('id', $product_id)->increment('viewed');
            }
        }

        // product details
        $product_details = Product::findOrFail($product_id);

        // related products
        $related_products = Product::where('category_id', $product_details->category_id)->where('type', 'Book')->where('id', '!=', $product_details->id)->latest()->take(8)->get();

        // product review rating
        $product_reviews = ProductReview::where('product_id', $product_id)->where('status', 'approved')->with('user', 'product')->latest()->paginate(10);
        $avg_rating = ProductReview::where('product_id', $product_id)->where('status', 'approved')->avg('rating');
        $total_reviews = ProductReview::where('product_id', $product_id)->where('status', 'approved')->with('user', 'product')->count();

        return view('frontend.pages.product.product_details', compact('rootCategories', 'product_details', 'related_products', 'product_reviews', 'avg_rating', 'total_reviews'));
    }
    public function view_tutorial_details($product_id, $product_slug)
    {
        // Unlimited Child Category
        $allCategories = Category::with('children')->get();
        $rootCategories = $allCategories->whereNull('parent_id');
        self::tree($rootCategories, $allCategories);

        // for most viewed products
        $session_id = session()->getId();
        $session_check = ProductSession::where('product_id', $product_id)->where('session_id', $session_id)->first();
        $view_null_check = Product::where('id', $product_id)->where('viewed', 0)->first();
        if (isset($session_check)) {
            if (isset($view_null_check)) {
                $view_null_check->increment('viewed');
            }
        } else {
            ProductSession::insert([
                'product_id' => $product_id,
                'session_id' => $session_id
            ]);
            if (isset($view_null_check)) {
                $view_null_check->increment('viewed');
            } else {
                Product::where('id', $product_id)->increment('viewed');
            }
        }

        // product details
        $product_details = Product::findOrFail($product_id);

        // related products
        $related_products = Product::where('category_id', $product_details->category_id)->where('type', 'Tutorial')->where('id', '!=', $product_details->id)->latest()->take(8)->get();

        // product review rating
        $product_reviews = ProductReview::where('product_id', $product_id)->where('status', 'approved')->with('user', 'product')->latest()->paginate(10);
        $avg_rating = ProductReview::where('product_id', $product_id)->where('status', 'approved')->avg('rating');
        $total_reviews = ProductReview::where('product_id', $product_id)->where('status', 'approved')->with('user', 'product')->count();

        return view('frontend.pages.product.product_details_tutorials', compact('rootCategories', 'product_details', 'related_products', 'product_reviews', 'avg_rating', 'total_reviews'));
    }
    public function view_products_list(Request $request, $category_id, $category_slug)
    {
        // Unlimited Child Category
        $allCategories = Category::with('children')->get();
        $rootCategories = $allCategories->whereNull('parent_id');
        self::tree($rootCategories, $allCategories);

        // Category wise products show
        $categories = Category::with('products', 'sub_products')->where('id', $category_id)->get();
        $product_count = 0;
        $sub_product_count = 0;
        foreach ($categories as $category) {
            $product_count = $category->products()->count();
        }
        foreach ($categories as $category) {
            $sub_product_count = $category->sub_products()->count();
        }

        $parent_category = Category::where('id', $category_id);
        $first_gen_cat_ids = Category::where('parent_id', $parent_category->value('id'))->pluck('id')->all();

        $second_gen_cats = Category::whereIn('parent_id', $first_gen_cat_ids)->get();
        $second_gen_cat_ids = $second_gen_cats->pluck('id')->all();

        if ($product_count > 0) {
            // immediate_cat_products
            $category_products = Product::where('category_id', $category_id);
        } elseif ($sub_product_count > 0) {
            // parent_cat_Products
            $category_products = Product::whereIn('category_id', $first_gen_cat_ids);
        } else {
            // grandparent_cat_Products
            $category_products = Product::whereIn('category_id', $second_gen_cat_ids);
        }

        // get author/instructor from products
        $auth_instructors = Product::groupBy('author')->select('author')->get();

        if (isset($_GET['sort']) && !empty($_GET['sort'])) {
            if ($_GET['sort'] == 'name_asc') {
                $category_products->orderBy('name', 'Asc');
            } elseif ($_GET['sort'] == 'name_desc') {
                $category_products->orderBy('name', 'Desc');
            } elseif ($_GET['sort'] == 'price_asc') {
                $category_products->orderBy('discount', 'Desc');
            } elseif ($_GET['sort'] == 'price_desc') {
                $category_products->orderBy('discount', 'Asc');
            }
        }
        if (isset($_GET['min_amount']) && !empty($_GET['min_amount']) && isset($_GET['max_amount']) && !empty($_GET['max_amount'])) {
            $category_products = $category_products->whereBetween('price', [$request->min_amount, $request->max_amount]);
        }
        if (isset($_GET['per_page']) && !empty($_GET['per_page'])) {
            $page = (int) $_GET['per_page'];
            $category_products = $category_products->paginate($page)->withQueryString();
        } else {
            $category_products = $category_products->paginate(9)->withQueryString();
        }

        return view('frontend.pages.product.products_list', compact('rootCategories', 'category_products', 'auth_instructors'));
    }

    public function view_products_list_books(Request $request, $category_id, $category_slug)
    {
        // Unlimited Child Category
        $allCategories = Category::with('children')->get();
        $rootCategories = $allCategories->whereNull('parent_id');
        self::tree($rootCategories, $allCategories);

        // Category wise products show books only
        $books_categories = Category::with('books', 'sub_products')->where('id', $category_id)->get();
        $product_count = 0;
        $sub_product_count = 0;
        foreach ($books_categories as $category) {
            $product_count = $category->books()->count();
        }
        foreach ($books_categories as $category) {
            $sub_product_count = $category->sub_products()->count();
        }

        $parent_category = Category::where('id', $category_id);
        $first_gen_cat_ids = Category::where('parent_id', $parent_category->value('id'))->pluck('id')->all();

        $second_gen_cats = Category::whereIn('parent_id', $first_gen_cat_ids)->get();
        $second_gen_cat_ids = $second_gen_cats->pluck('id')->all();

        if ($product_count > 0) {
            // immediate_cat_products
            $books_category_products = Product::where('category_id', $category_id)->where('type', 'Book');
        } elseif ($sub_product_count > 0) {
            // parent_cat_Products
            $books_category_products = Product::whereIn('category_id', $first_gen_cat_ids)->where('type', 'Book');
        } else {
            // grandparent_cat_Products
            $books_category_products = Product::whereIn('category_id', $second_gen_cat_ids)->where('type', 'Book');
        }

        // get author/instructor from products
        $auth_instructors = Product::groupBy('author')->select('author')->get();

        if (isset($_GET['sort']) && !empty($_GET['sort'])) {
            if ($_GET['sort'] == 'name_asc') {
                $books_category_products->orderBy('name', 'Asc');
            } elseif ($_GET['sort'] == 'name_desc') {
                $books_category_products->orderBy('name', 'Desc');
            } elseif ($_GET['sort'] == 'price_asc') {
                $books_category_products->orderBy('discount', 'Desc');
            } elseif ($_GET['sort'] == 'price_desc') {
                $books_category_products->orderBy('discount', 'Asc');
            }
        }
        if (isset($_GET['min_amount']) && !empty($_GET['min_amount']) && isset($_GET['max_amount']) && !empty($_GET['max_amount'])) {
            $books_category_products = $books_category_products->whereBetween('price', [$request->min_amount, $request->max_amount]);
        }
        if (isset($_GET['per_page']) && !empty($_GET['per_page'])) {
            $page = (int) $_GET['per_page'];
            $books_category_products = $books_category_products->paginate($page)->withQueryString();
        } else {
            $books_category_products = $books_category_products->paginate(9)->withQueryString();
        }

        return view('frontend.pages.product.products_list_books', compact('rootCategories', 'books_category_products', 'auth_instructors'));
    }

    public function view_products_list_tutorials(Request $request, $category_id, $category_slug)
    {
        // Unlimited Child Category
        $allCategories = Category::with('children')->get();
        $rootCategories = $allCategories->whereNull('parent_id');
        self::tree($rootCategories, $allCategories);

        // Category wise products show tutorials only
        $tutorials_categories = Category::with('tutorials', 'sub_products')->where('id', $category_id)->get();
        $product_count = 0;
        $sub_product_count = 0;
        foreach ($tutorials_categories as $category) {
            $product_count = $category->tutorials()->count();
        }
        foreach ($tutorials_categories as $category) {
            $sub_product_count = $category->sub_products()->count();
        }

        $parent_category = Category::where('id', $category_id);
        $first_gen_cat_ids = Category::where('parent_id', $parent_category->value('id'))->pluck('id')->all();

        $second_gen_cats = Category::whereIn('parent_id', $first_gen_cat_ids)->get();
        $second_gen_cat_ids = $second_gen_cats->pluck('id')->all();

        if ($product_count > 0) {
            // immediate_cat_products
            $tutorials_category_products = Product::where('category_id', $category_id)->where('type', 'Tutorial');
        } elseif ($sub_product_count > 0) {
            // parent_cat_Products
            $tutorials_category_products = Product::whereIn('category_id', $first_gen_cat_ids)->where('type', 'Tutorial');
        } else {
            // grandparent_cat_Products
            $tutorials_category_products = Product::whereIn('category_id', $second_gen_cat_ids)->where('type', 'Tutorial');
        }

        // get author/instructor from products
        $auth_instructors = Product::groupBy('author')->select('author')->get();

        if (isset($_GET['sort']) && !empty($_GET['sort'])) {
            if ($_GET['sort'] == 'name_asc') {
                $tutorials_category_products->orderBy('name', 'Asc');
            } elseif ($_GET['sort'] == 'name_desc') {
                $tutorials_category_products->orderBy('name', 'Desc');
            } elseif ($_GET['sort'] == 'price_asc') {
                $tutorials_category_products->orderBy('discount', 'Desc');
            } elseif ($_GET['sort'] == 'price_desc') {
                $tutorials_category_products->orderBy('discount', 'Asc');
            }
        }
        if (isset($_GET['min_amount']) && !empty($_GET['min_amount']) && isset($_GET['max_amount']) && !empty($_GET['max_amount'])) {
            $tutorials_category_products = $tutorials_category_products->whereBetween('price', [$request->min_amount, $request->max_amount]);
        }
        if (isset($_GET['per_page']) && !empty($_GET['per_page'])) {
            $page = (int) $_GET['per_page'];
            $tutorials_category_products = $tutorials_category_products->paginate($page)->withQueryString();
        } else {
            $tutorials_category_products = $tutorials_category_products->paginate(9)->withQueryString();
        }

        return view('frontend.pages.product.products_list_tutorials', compact('rootCategories', 'tutorials_category_products', 'auth_instructors'));
    }

    public function view_products_books(Request $request)
    {
        // Unlimited Child Category
        $allCategories = Category::with('children')->get();
        $rootCategories = $allCategories->whereNull('parent_id');
        self::tree($rootCategories, $allCategories);

        // Category wise products show books only
        $all_books = Product::where('type', 'Book');

        // get author/instructor from products
        $auth_instructors = Product::groupBy('author')->select('author')->get();

        if (isset($_GET['sort']) && !empty($_GET['sort'])) {
            if ($_GET['sort'] == 'name_asc') {
                $all_books->orderBy('name', 'Asc');
            } elseif ($_GET['sort'] == 'name_desc') {
                $all_books->orderBy('name', 'Desc');
            } elseif ($_GET['sort'] == 'price_asc') {
                $all_books->orderBy('discount', 'Desc');
            } elseif ($_GET['sort'] == 'price_desc') {
                $all_books->orderBy('discount', 'Asc');
            }
        }
        if (isset($_GET['min_amount']) && !empty($_GET['min_amount']) && isset($_GET['max_amount']) && !empty($_GET['max_amount'])) {
            $all_books = $all_books->whereBetween('price', [$request->min_amount, $request->max_amount]);
        }
        if (isset($_GET['per_page']) && !empty($_GET['per_page'])) {
            $page = (int) $_GET['per_page'];
            $all_books = $all_books->paginate($page)->withQueryString();
        } else {
            $all_books = $all_books->paginate(9)->withQueryString();
        }

        return view('frontend.pages.product.products_books', compact('rootCategories', 'all_books', 'auth_instructors'));
    }

    public function view_products_tutorials(Request $request)
    {
        // Unlimited Child Category
        $allCategories = Category::with('children')->get();
        $rootCategories = $allCategories->whereNull('parent_id');
        self::tree($rootCategories, $allCategories);

        // get author/instructor from products
        $auth_instructors = Product::groupBy('author')->select('author')->get();

        // Category wise products show tutorials only
        $all_tutorials = Product::where('type', 'Tutorial');
        if (isset($_GET['sort']) && !empty($_GET['sort'])) {
            if ($_GET['sort'] == 'name_asc') {
                $all_tutorials->orderBy('name', 'Asc');
            } elseif ($_GET['sort'] == 'name_desc') {
                $all_tutorials->orderBy('name', 'Desc');
            } elseif ($_GET['sort'] == 'price_asc') {
                $all_tutorials->orderBy('discount', 'Desc');
            } elseif ($_GET['sort'] == 'price_desc') {
                $all_tutorials->orderBy('discount', 'Asc');
            }
        }
        if (isset($_GET['min_amount']) && !empty($_GET['min_amount']) && isset($_GET['max_amount']) && !empty($_GET['max_amount'])) {
            $all_tutorials = $all_tutorials->whereBetween('price', [$request->min_amount, $request->max_amount]);
        }
        if (isset($_GET['per_page']) && !empty($_GET['per_page'])) {
            $page = (int) $_GET['per_page'];
            $all_tutorials = $all_tutorials->paginate($page)->withQueryString();
        } else {
            $all_tutorials = $all_tutorials->paginate(9)->withQueryString();
        }

        return view('frontend.pages.product.products_tutorials', compact('rootCategories', 'all_tutorials', 'auth_instructors'));
    }

    public function view_free_books(Request $request)
    {
        // Unlimited Child Category
        $allCategories = Category::with('children')->get();
        $rootCategories = $allCategories->whereNull('parent_id');
        self::tree($rootCategories, $allCategories);

        // Free Books
        $products = Product::where('discount', '=', 100)->where('type', 'Book');

        // get author/instructor from products
        $auth_instructors = Product::groupBy('author')->select('author')->get();

        if (isset($_GET['sort']) && !empty($_GET['sort'])) {
            if ($_GET['sort'] == 'name_asc') {
                $products->orderBy('name', 'Asc');
            } elseif ($_GET['sort'] == 'name_desc') {
                $products->orderBy('name', 'Desc');
            } elseif ($_GET['sort'] == 'price_asc') {
                $products->orderBy('discount', 'Desc');
            } elseif ($_GET['sort'] == 'price_desc') {
                $products->orderBy('discount', 'Asc');
            }
        }
        if (isset($_GET['min_amount']) && !empty($_GET['min_amount']) && isset($_GET['max_amount']) && !empty($_GET['max_amount'])) {
            $products = $products->whereBetween('price', [$request->min_amount, $request->max_amount]);
        }
        if (isset($_GET['per_page']) && !empty($_GET['per_page'])) {
            $page = (int) $_GET['per_page'];
            $products = $products->paginate($page)->withQueryString();
        } else {
            $products = $products->paginate(9)->withQueryString();
        }

        return view('frontend.pages.product.discounted_products', compact(['rootCategories', 'products', 'auth_instructors']));
    }

    public function view_free_tutorials(Request $request)
    {
        // Unlimited Child Category
        $allCategories = Category::with('children')->get();
        $rootCategories = $allCategories->whereNull('parent_id');
        self::tree($rootCategories, $allCategories);

        // Free Tutorials
        $products = Product::where('discount', '=', 100)->where('type', 'Tutorial');

        // get author/instructor from products
        $auth_instructors = Product::groupBy('author')->select('author')->get();

        if (isset($_GET['sort']) && !empty($_GET['sort'])) {
            if ($_GET['sort'] == 'name_asc') {
                $products->orderBy('name', 'Asc');
            } elseif ($_GET['sort'] == 'name_desc') {
                $products->orderBy('name', 'Desc');
            } elseif ($_GET['sort'] == 'price_asc') {
                $products->orderBy('discount', 'Desc');
            } elseif ($_GET['sort'] == 'price_desc') {
                $products->orderBy('discount', 'Asc');
            }
        }
        if (isset($_GET['min_amount']) && !empty($_GET['min_amount']) && isset($_GET['max_amount']) && !empty($_GET['max_amount'])) {
            $products = $products->whereBetween('price', [$request->min_amount, $request->max_amount]);
        }
        if (isset($_GET['per_page']) && !empty($_GET['per_page'])) {
            $page = (int) $_GET['per_page'];
            $products = $products->paginate($page)->withQueryString();
        } else {
            $products = $products->paginate(9)->withQueryString();
        }

        return view('frontend.pages.product.discounted_products', compact(['rootCategories', 'products', 'auth_instructors']));
    }

    public function fifty_percent_off(Request $request)
    {
        // Unlimited Child Category
        $allCategories = Category::with('children')->get();
        $rootCategories = $allCategories->whereNull('parent_id');
        self::tree($rootCategories, $allCategories);

        // fifty_percent_off products
        $products = Product::where('discount', '=', 50);

        // get author/instructor from products
        $auth_instructors = Product::groupBy('author')->select('author')->get();

        if (isset($_GET['sort']) && !empty($_GET['sort'])) {
            if ($_GET['sort'] == 'name_asc') {
                $products->orderBy('name', 'Asc');
            } elseif ($_GET['sort'] == 'name_desc') {
                $products->orderBy('name', 'Desc');
            } elseif ($_GET['sort'] == 'price_asc') {
                $products->orderBy('discount', 'Desc');
            } elseif ($_GET['sort'] == 'price_desc') {
                $products->orderBy('discount', 'Asc');
            }
        }
        if (isset($_GET['min_amount']) && !empty($_GET['min_amount']) && isset($_GET['max_amount']) && !empty($_GET['max_amount'])) {
            $products = $products->whereBetween('price', [$request->min_amount, $request->max_amount]);
        }
        if (isset($_GET['per_page']) && !empty($_GET['per_page'])) {
            $page = (int) $_GET['per_page'];
            $products = $products->paginate($page)->withQueryString();
        } else {
            $products = $products->paginate(9)->withQueryString();
        }

        return view('frontend.pages.product.discounted_products', compact(['rootCategories', 'products', 'auth_instructors']));
    }

    public function search_products(Request $request)
    {
        // Unlimited Child category
        $allCategories = Category::with('children')->get();
        $rootCategories = $allCategories->whereNull('parent_id');
        self::tree($rootCategories, $allCategories);

        //search input validation
        $request->validate([
            'search_key' => 'required'
        ]);

        // get author/instructor from products
        $auth_instructors = Product::groupBy('author')->select('author')->get();

        // What Search Button does
        $searchResult = Product::where('name', 'LIKE', '%' . $request->search_key . '%')->orWhere('author', 'LIKE', '%' . $request->search_key . '%');
        if (isset($_GET['sort']) && !empty($_GET['sort'])) {
            if ($_GET['sort'] == 'name_asc') {
                $searchResult->orderBy('name', 'Asc');
            } elseif ($_GET['sort'] == 'name_desc') {
                $searchResult->orderBy('name', 'Desc');
            } elseif ($_GET['sort'] == 'price_asc') {
                $searchResult->orderBy('discount', 'Desc');
            } elseif ($_GET['sort'] == 'price_desc') {
                $searchResult->orderBy('discount', 'Asc');
            }
        }
        if (isset($_GET['min_amount']) && !empty($_GET['min_amount']) && isset($_GET['max_amount']) && !empty($_GET['max_amount'])) {
            $searchResult = $searchResult->whereBetween('price', [$request->min_amount, $request->max_amount]);
        }
        if (isset($_GET['per_page']) && !empty($_GET['per_page'])) {
            $page = (int) $_GET['per_page'];
            $searchResult = $searchResult->paginate($page)->withQueryString();
        } else {
            $searchResult = $searchResult->paginate(9)->withQueryString();
        }
        return view('frontend.pages.product.search_products', compact('rootCategories', 'searchResult', 'auth_instructors'));
    }

    public function search_products_ajax(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::where('name', 'LIKE', '%' . $request->name . '%')->orWhere('author', 'LIKE', '%' . $request->name . '%')->get();
            $output = "";
            if (count($products) > 0) {
                $output = "<ul class='list-group autocomplete-items'>";
                foreach ($products as $product) {
                    $image = json_decode($product->image);
                    if ($product->type == 'Book') {
                        $output .= "<a href='/product/details/$product->id/$product->slug'><li class='list-group-item'><div class='row'><div class='col-2'><img src='/uploads/product_images/$image[0]' height='50' width='40'></div><div class='col-7'><strong>" . $product->name . "</strong><p>" . $product->author . "</p></div><div class='col-3'>" . $product->price - (($product->price * $product->discount) / 100) . " TK<p>(" . $product->discount . " %OFF)</p></div></li>";
                    } else {
                        $output .= "<a href='/product/tutorial/details/$product->id/$product->slug'><li class='list-group-item'><div class='row'><div class='col-2'><img src='/uploads/product_images/$image[0]' height='50' width='40'></div><div class='col-7'><strong>" . $product->name . "</strong><p>" . $product->author . "</p></div><div class='col-3'>" . $product->price - (($product->price * $product->discount) / 100) . " TK<p>(" . $product->discount . " %OFF)</p></div></li>";
                    }
                }
                $output .= "</ul></a>";
            } else {
                $output .= "<li class='list-group-item'>No Data Found</li>";
            }
            return $output;
        }
    }

    public function featured_products(Request $request)
    {
        // Unlimited Child category
        $allCategories = Category::with('children')->get();
        $rootCategories = $allCategories->whereNull('parent_id');
        self::tree($rootCategories, $allCategories);

        $featured_products = Product::where('featured', 'Yes')->latest();

        // get author/instructor from products
        $auth_instructors = Product::groupBy('author')->select('author')->get();

        if (isset($_GET['sort']) && !empty($_GET['sort'])) {
            if ($_GET['sort'] == 'name_asc') {
                $featured_products->orderBy('name', 'Asc');
            } elseif ($_GET['sort'] == 'name_desc') {
                $featured_products->orderBy('name', 'Desc');
            } elseif ($_GET['sort'] == 'price_asc') {
                $featured_products->orderBy('discount', 'Desc');
            } elseif ($_GET['sort'] == 'price_desc') {
                $featured_products->orderBy('discount', 'Asc');
            }
        }
        if (isset($_GET['min_amount']) && !empty($_GET['min_amount']) && isset($_GET['max_amount']) && !empty($_GET['max_amount'])) {
            $featured_products = $featured_products->whereBetween('price', [$request->min_amount, $request->max_amount]);
        }
        if (isset($_GET['per_page']) && !empty($_GET['per_page'])) {
            $page = (int) $_GET['per_page'];
            $featured_products = $featured_products->paginate($page)->withQueryString();
        } else {
            $featured_products = $featured_products->paginate(9)->withQueryString();
        }

        return view('frontend.pages.product.featured', compact('rootCategories', 'featured_products', 'auth_instructors'));
    }

    public function new_arrivals_products(Request $request)
    {
        // Unlimited Child category
        $allCategories = Category::with('children')->get();
        $rootCategories = $allCategories->whereNull('parent_id');
        self::tree($rootCategories, $allCategories);

        $new_arrivals_products = Product::latest();

        // get author/instructor from products
        $auth_instructors = Product::groupBy('author')->select('author')->get();

        if (isset($_GET['sort']) && !empty($_GET['sort'])) {
            if ($_GET['sort'] == 'name_asc') {
                $new_arrivals_products->orderBy('name', 'Asc');
            } elseif ($_GET['sort'] == 'name_desc') {
                $new_arrivals_products->orderBy('name', 'Desc');
            } elseif ($_GET['sort'] == 'price_asc') {
                $new_arrivals_products->orderBy('discount', 'Desc');
            } elseif ($_GET['sort'] == 'price_desc') {
                $new_arrivals_products->orderBy('discount', 'Asc');
            }
        }
        if (isset($_GET['min_amount']) && !empty($_GET['min_amount']) && isset($_GET['max_amount']) && !empty($_GET['max_amount'])) {
            $new_arrivals_products = $new_arrivals_products->whereBetween('price', [$request->min_amount, $request->max_amount]);
        }
        if (isset($_GET['per_page']) && !empty($_GET['per_page'])) {
            $page = (int) $_GET['per_page'];
            $new_arrivals_products = $new_arrivals_products->paginate($page)->withQueryString();
        } else {
            $new_arrivals_products = $new_arrivals_products->paginate(9)->withQueryString();
        }
        return view('frontend.pages.product.new_arrivals', compact('rootCategories', 'new_arrivals_products', 'auth_instructors'));
    }

    public function most_viewed_products(Request $request)
    {
        // Unlimited Child category
        $allCategories = Category::with('children')->get();
        $rootCategories = $allCategories->whereNull('parent_id');
        self::tree($rootCategories, $allCategories);

        $most_viewed_products = Product::orderByDesc('viewed');

        // get author/instructor from products
        $auth_instructors = Product::groupBy('author')->select('author')->get();

        if (isset($_GET['sort']) && !empty($_GET['sort'])) {
            if ($_GET['sort'] == 'name_asc') {
                $most_viewed_products->orderBy('name', 'Asc');
            } elseif ($_GET['sort'] == 'name_desc') {
                $most_viewed_products->orderBy('name', 'Desc');
            } elseif ($_GET['sort'] == 'price_asc') {
                $most_viewed_products->orderBy('discount', 'Desc');
            } elseif ($_GET['sort'] == 'price_desc') {
                $most_viewed_products->orderBy('discount', 'Asc');
            }
        }
        if (isset($_GET['min_amount']) && !empty($_GET['min_amount']) && isset($_GET['max_amount']) && !empty($_GET['max_amount'])) {
            $most_viewed_products = $most_viewed_products->whereBetween('price', [$request->min_amount, $request->max_amount]);
        }
        if (isset($_GET['per_page']) && !empty($_GET['per_page'])) {
            $page = (int) $_GET['per_page'];
            $most_viewed_products = $most_viewed_products->paginate($page)->withQueryString();
        } else {
            $most_viewed_products = $most_viewed_products->paginate(9)->withQueryString();
        }

        return view('frontend.pages.product.most_viewed', compact('rootCategories', 'most_viewed_products', 'auth_instructors'));
    }
}

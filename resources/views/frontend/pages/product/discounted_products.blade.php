@extends('frontend.customer')
@section('content')
    <section class="breadcrumb-section">
        <h2 class="sr-only">Site Breadcrumb</h2>
        <div class="container">
            <div class="breadcrumb-contents">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('botu') }}">Home</a></li>
                        <li class="breadcrumb-item active">Discounted Products</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <main class="inner-page-sec-padding-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 order-lg-2">
                    <div class="shop-toolbar with-sidebar mb--30">
                        <div class="row align-items-center">
                            <div class="col-lg-2 col-md-2 col-sm-6">
                                {{-- Product View Mode --}}
                                <div class="product-view-mode">
                                    <a href="#" class="sorting-btn active" data-target="grid"><i
                                            class="fas fa-th"></i></a>
                                    <a href="#" class="sorting-btn" data-target="grid-four">
                                        <span class="grid-four-icon">
                                            <i class="fas fa-grip-vertical"></i><i class="fas fa-grip-vertical"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-4 col-sm-6  mt--10 mt-sm--0">
                                <span class="toolbar-status">
                                    Showing {{ $products->firstItem() }} to
                                    {{ $products->lastItem() }} of
                                    {{ $products->total() }}
                                    ({{ $products->lastPage() }} Pages)
                                </span>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-6  mt--10 mt-md--0">
                                <form action="{{ URL::current() }}" method="get">
                                    <div class="sorting-selection">
                                        @if (isset($_GET['sort']) && !empty($_GET['sort']))
                                            <input type="hidden" name="sort" value="{{ $_GET['sort'] }}">
                                        @endif
                                        @if (isset($_GET['min_amount']) && !empty($_GET['min_amount']))
                                            <input type="hidden" name="min_amount" value="{{ $_GET['min_amount'] }}">
                                        @endif
                                        @if (isset($_GET['max_amount']) && !empty($_GET['max_amount']))
                                            <input type="hidden" name="max_amount" value="{{ $_GET['max_amount'] }}">
                                        @endif
                                        <span>Show:</span>
                                        <select name="per_page" class="form-control nice-select sort-select"
                                            id="show_products">
                                            <option value="9" @if (isset($_GET['per_page']) && $_GET['per_page'] == 9) selected @endif>9
                                            </option>
                                            <option value="18" @if (isset($_GET['per_page']) && $_GET['per_page'] == 18) selected @endif>18
                                            </option>
                                            <option value="27" @if (isset($_GET['per_page']) && $_GET['per_page'] == 27) selected @endif>27
                                            </option>
                                            <option value="36" @if (isset($_GET['per_page']) && $_GET['per_page'] == 36) selected @endif>36
                                            </option>
                                            <option value="45" @if (isset($_GET['per_page']) && $_GET['per_page'] == 45) selected @endif>45
                                            </option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 mt--10 mt-md--0 ">
                                <form action="{{ URL::current() }}" method="get">
                                    <div class="sorting-selection">
                                        <span>Sort By:</span>
                                        @if (isset($_GET['per_page']) && !empty($_GET['per_page']))
                                            <input type="hidden" name="per_page" value="{{ $_GET['per_page'] }}">
                                        @endif
                                        @if (isset($_GET['min_amount']) && !empty($_GET['min_amount']))
                                            <input type="hidden" name="min_amount" value="{{ $_GET['min_amount'] }}">
                                        @endif
                                        @if (isset($_GET['max_amount']) && !empty($_GET['max_amount']))
                                            <input type="hidden" name="max_amount" value="{{ $_GET['max_amount'] }}">
                                        @endif
                                        <select name="sort" class="form-control nice-select sort-select mr-0"
                                            id="sort_by">
                                            <option value="" @if (isset($_GET['sort']) && $_GET['sort'] == '') selected @endif>
                                                Default Sorting
                                            </option>
                                            <option value="name_asc" @if (isset($_GET['sort']) && $_GET['sort'] == 'name_asc') selected @endif>
                                                Name (A - Z)</option>
                                            <option value="name_desc" @if (isset($_GET['sort']) && $_GET['sort'] == 'name_desc') selected @endif>
                                                Name (Z - A)</option>
                                            <option value="price_asc" @if (isset($_GET['sort']) && $_GET['sort'] == 'price_asc') selected @endif>
                                                Price (Low &gt; High)</option>
                                            <option value="price_desc" @if (isset($_GET['sort']) && $_GET['sort'] == 'price_desc') selected @endif>
                                                Price (High &gt; Low)</option>
                                            <option value="">Rating (Highest)</option>
                                            <option value="">Rating (Lowest)</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="shop-product-wrap grid with-pagination row space-db--30 shop-border">
                        @foreach ($products as $product)
                            <div class="col-lg-4 col-sm-6">
                                <div class="product-card">
                                    <div class="product-grid-content">
                                        <div class="product-header">
                                            <a href="{{ route('botu.author.instructor', $product->author) }}"
                                                class="author">
                                                {{ $product->author }}
                                            </a>
                                            <h3><a
                                                    href="{{ route('botu.product.details', [$product->id, $product->slug]) }}">{{ $product->name }}</a>
                                            </h3>
                                        </div>
                                        <div class="product-card--body">
                                            <div class="card-image">
                                                @php
                                                    $product_image = json_decode($product->image);
                                                @endphp
                                                @if (!empty($product_image[0]))
                                                    <img src="{{ url('/uploads/product_images/' . $product_image[0]) }}"
                                                        height="220" width="220" alt="Product Image">
                                                @else
                                                    <img src="{{ url('/uploads/default/no_image.jpg') }}" height="220"
                                                        width="220" alt="No Image">
                                                @endif
                                                <div class="hover-contents">
                                                    <a href="{{ route('botu.product.details', [$product->id, $product->slug]) }}"
                                                        class="hover-image">
                                                        @if (!empty($product_image[0]))
                                                            <img src="{{ url('/uploads/product_images/' . $product_image[0]) }}"
                                                                height="220" width="220" alt="Product Image">
                                                        @else
                                                            <img src="{{ url('/uploads/default/no_image.jpg') }}"
                                                                height="220" width="220" alt="No Image">
                                                        @endif
                                                    </a>
                                                    <div class="hover-btns">
                                                        <form action="{{ route('botu.add_to_cart', $product->id) }}"
                                                            method="post">
                                                            @csrf
                                                            <button type="submit" class="single-btn">
                                                                <i class="fas fa-shopping-basket"></i>
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('botu.add_to_wishlist', $product->id) }}"
                                                            method="post">
                                                            @csrf
                                                            <button type="submit" class="single-btn">
                                                                <i class="fas fa-heart"></i>
                                                            </button>
                                                        </form>
                                                        <a data-toggle="modal" class="single-btn product_details_modal"
                                                            data-id="{{ $product->id }}"
                                                            data-name="{{ $product->name }}"
                                                            data-author="{{ $product->author }}"
                                                            data-image="{{ $product->image }}"
                                                            data-stock-status="{{ $product->stock_status }}"
                                                            data-price="{{ $product->price }}"
                                                            data-discount="{{ $product->discount }}"
                                                            data-short-description="{{ $product->short_description }}">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="price-block">
                                                <span
                                                    class="price">৳{{ $product->price - ($product->price * $product->discount) / 100 }}</span>
                                                <del class="price-old">৳{{ $product->price }}</del>
                                                <span class="price-discount">{{ $product->discount }}%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if ($products->isEmpty())
                        <div style="text-align:center; margin-top: 30px;">
                            <h4 class="alert alert-danger">Sorry</h4>
                            <h5 class="alert alert-danger">No Products Found</h5>
                        </div>
                    @endif
                    {{-- Pagination Block --}}
                    <br><br>
                    {!! $products->links() !!}
                    {{-- Product Details Modal --}}
                    @include('frontend.fixed.product_details_modal')
                </div>
                <div class="col-lg-3  mt--40 mt-lg--0">
                    <div class="inner-page-sidebar">
                        {{-- Price --}}
                        <div class="single-block">
                            <form action="{{ URL::current() }}" method="GET">
                                <h3 class="sidebar-title">Filter By Price</h3>
                                <div class="range-slider pt--30">
                                    <div class="sb-range-slider"></div>
                                    <div class="slider-price">
                                        <p style="display: flex; justify-content: center;">
                                            <input type="text" id="amount" readonly="">
                                            <input type="hidden" name="min_amount" id="min_amount">
                                            <input type="hidden" name="max_amount" id="max_amount">
                                            @if (isset($_GET['sort']) && !empty($_GET['sort']))
                                                <input type="hidden" name="sort" value="{{ $_GET['sort'] }}">
                                            @endif
                                            @if (isset($_GET['per_page']) && !empty($_GET['per_page']))
                                                <input type="hidden" name="per_page" value="{{ $_GET['per_page'] }}">
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div style="text-align: center;">
                                    <button type="submit" class="btn-sm btn-dark filter_product_button">Filter
                                        Products</button>
                                </div>
                            </form>
                        </div>
                        {{-- Category --}}
                        <div class="single-block">
                            <h3 class="sidebar-title">Categories</h3>
                            <ul class="sidebar-menu--shop">
                                @forelse ($rootCategories as $rootCategory)
                                    @php
                                        $categories = App\Models\Category::with('products', 'sub_products')
                                            ->where('id', $rootCategory->id)
                                            ->get();
                                        $product_count = 0;
                                        $sub_product_count = 0;
                                        foreach ($categories as $category) {
                                            $product_count = $category->products()->count();
                                        }
                                        foreach ($categories as $category) {
                                            $sub_product_count = $category->sub_products()->count();
                                        }
                                        $first_gen_cat_ids = App\Models\Category::where('parent_id', $rootCategory->id)
                                            ->pluck('id')
                                            ->all();
                                        $second_gen_cat_ids = App\Models\Category::whereIn('parent_id', $first_gen_cat_ids)
                                            ->pluck('id')
                                            ->all();
                                        if ($product_count > 0) {
                                            // immediate_cat_products
                                            $category_products = App\Models\Product::where('category_id', $rootCategory->id)->get();
                                            $total_products = $category_products->count();
                                        } elseif ($sub_product_count > 0) {
                                            // parent_cat_Products
                                            $category_products = App\Models\Product::whereIn('category_id', $first_gen_cat_ids)->get();
                                            $total_products = $category_products->count();
                                        } else {
                                            // grandparent_cat_Products
                                            $category_products = App\Models\Product::whereIn('category_id', $second_gen_cat_ids)->get();
                                            $total_products = $category_products->count();
                                        }
                                    @endphp
                                    <li><a
                                            href="{{ route('botu.products.list', [$rootCategory->id, $rootCategory->slug]) }}">{{ $rootCategory->name }}
                                            ({{ $total_products }})
                                        </a>
                                    </li>
                                @empty
                                    <li><a href="javascript:">Nothing Found (0)</a></li>
                                @endforelse
                            </ul>
                        </div>
                        {{-- Author or Instructor --}}
                        <div class="single-block">
                            <h3 class="sidebar-title">Author/Instructor</h3>
                            <ul class="sidebar-menu--shop menu-type-2">
                                @forelse ($auth_instructors as $auth_instructor)
                                    @php
                                        $auth_instructor_count = App\Models\Product::where('author', $auth_instructor->author)->count();
                                    @endphp
                                    <li><a href="{{ route('botu.author.instructor', $auth_instructor->author) }}">{{ $auth_instructor->author }}
                                            <span>({{ $auth_instructor_count }})</span></a></li>
                                @empty
                                    <li><a href="javascript:">Nothing Found <span>(0)</span></a></li>
                                @endforelse
                            </ul>
                        </div>
                        {{-- Promotion Block --}}
                        <div class="single-block">
                            <a href="{{ route('botu.fifty_percent_off') }}" class="promo-image sidebar">
                                <img src="{{ url('frontend/image/others/home-side-promo.jpg') }}"
                                    alt="50 percent off pic">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

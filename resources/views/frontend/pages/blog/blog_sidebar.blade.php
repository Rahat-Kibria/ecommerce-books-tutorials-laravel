<div class="col-lg-3">
    <div class="inner-page-sidebar">
        <div class="single-block">
            <h2 class="sidebar-title mb--30">Search</h2>
            <form action="{{ route('botu.blog.search.post') }}" method="GET">
                <div class="site-mini-search">
                    <input type="text" name="blog_post_search" placeholder="Search" required>
                    <button type="submit"><i class="fas fa-search"></i></button>
                    @if ($errors->has('blog_post_search'))
                        @foreach ($errors->get('blog_post_search') as $error)
                            <small class="text-danger">{{ $error }}</small>
                        @endforeach
                    @endif
                </div>
            </form>
        </div>
        <div class="single-block">
            <h2 class="sidebar-title mb--30">BLOG ARCHIVES</h2>
            <ul class="sidebar-list mb--30">
                @foreach ($group_years as $index => $group_year)
                    @php
                        $count = $group_year->count();
                    @endphp
                    <li><a href="{{ route('botu.blog.posts.by.year', $index) }}"> {{ $index }}
                            ({{ $count }})
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="single-block ">
            <h2 class="sidebar-title mb--30">CATEGORIES</h2>
            <ul class="sidebar-list">
                @foreach ($categories as $category)
                    @php
                        $category_count = App\Models\Post::where('status', 'completed')
                            ->where('category_id', $category->id)
                            ->count();
                    @endphp
                    <li><a href="{{ route('botu.blog.posts.by.category', $category->id) }}"> {{ $category->name }}
                            ({{ $category_count }})
                        </a></li>
                @endforeach
            </ul>
        </div>
        <div class="single-block ">
            <h2 class="sidebar-title mb--30">Tags</h2>
            <ul class="sidebar-tag-list">
                @foreach ($tags as $tag)
                    <li><a href="{{ route('botu.blog.posts.by.tag', $tag->id) }}"> {{ $tag->name }}</a></li>
                @endforeach
            </ul>
        </div>
        {{-- Promo Block --}}
        <div class="single-block">
            <a href="{{ route('botu.fifty_percent_off') }}" class="promo-image sidebar">
                <img src="{{ url('frontend/image/others/home-side-promo.jpg') }}" alt="50 percent off pic">
            </a>
        </div>
    </div>
</div>

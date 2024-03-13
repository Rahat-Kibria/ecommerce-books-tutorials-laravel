@extends('frontend.customer')
@section('content')
    <section class="breadcrumb-section">
        <h2 class="sr-only">Site Breadcrumb</h2>
        <div class="container">
            <div class="breadcrumb-contents">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('botu') }}">Home</a></li>
                        <li class="breadcrumb-item active">Blog List</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <section class="inner-page-sec-padding-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 order-lg-2 mb--40 mb-lg--0">
                    @if ($posts->count() > 0)
                        <div class="row space-db-lg--60 space-db--30">
                            {{-- Single part --}}
                            @foreach ($posts as $post)
                                <div class="col-lg-4 col-md-6 mb-lg--60 mb--30">
                                    <div class="blog-card card-style-grid">
                                        <a href="{{ route('botu.blog.details', $post->id) }}" class="image d-block">
                                            @if (!empty($post->image))
                                                <img src="{{ asset('uploads/blog_images/' . $post->image) }}"
                                                    style="width: 100%; height: auto;" alt="Post Image">
                                            @else
                                                <img src="{{ asset('uploads/default/no_image.jpg') }}" alt="No Image">
                                            @endif
                                        </a>
                                        <div class="card-content">
                                            <h3 class="title"><a
                                                    href="{{ route('botu.blog.details', $post->id) }}">{{ $post->title }}</a>
                                            </h3>
                                            <p class="post-meta"><span>{{ $post->created_at->format('d/m/Y') }} </span> | <a
                                                    href="{{ route('botu.blog.posts.by.category', $post->category->id) }}">{{ $post->category->name }}</a>
                                            </p>
                                            <article>
                                                <h2 class="sr-only">
                                                    Blog Article
                                                </h2>
                                                <p
                                                    style="width: 100px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                    {!! \Illuminate\Support\Str::limit($post->content, 150) !!}
                                                </p>
                                                <a href="{{ route('botu.blog.details', $post->id) }}" class="blog-link">Read
                                                    More</a>
                                            </article>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div>
                            <p class="alert alert-danger text-center" style="font-size: 1.5rem;">No Posts Found</p>
                        </div>
                    @endif
                    {{-- Pagination Block --}}
                    <br><br>
                    {!! $posts->links() !!}
                </div>
                @include('frontend.pages.blog.blog_sidebar')
            </div>
        </div>
    </section>
@endsection

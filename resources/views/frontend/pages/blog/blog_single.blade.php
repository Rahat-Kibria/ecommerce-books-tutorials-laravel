@extends('frontend.customer')
@section('content')
    <section class="breadcrumb-section">
        <h2 class="sr-only">Site Breadcrumb</h2>
        <div class="container">
            <div class="breadcrumb-contents">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('botu') }}">Home</a></li>
                        <li class="breadcrumb-item active">Blog Single</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <section class="inner-page-sec-padding-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 order-lg-2 mb--40 mb-lg--0">
                    <div class="blog-post post-details mb--50">
                        <div class="blog-image">
                            @if (!empty($post->image))
                                <img src="{{ asset('uploads/blog_images/' . $post->image) }}"
                                    style="width: 100%; height: auto;" alt="Post Image">
                            @else
                                <img src="{{ asset('uploads/default/no_image.jpg') }}" alt="No Image">
                            @endif
                        </div>
                        <div class="blog-content mt--30">
                            <header>
                                <h3 class="blog-title"> {{ $post->title }}</h3>
                                <div class="post-meta">
                                    <span class="post-author">
                                        <i class="fas fa-user"></i>
                                        <span class="text-gray">Posted by : </span>
                                        {{ $post->user->first_name }} {{ $post->user->last_name }}
                                    </span>
                                    <span class="post-separator">|</span>
                                    <span class="post-date">
                                        <i class="far fa-calendar-alt"></i>
                                        <span class="text-gray">On : </span>
                                        {{ $post->created_at->format('M d, Y') }}
                                    </span>
                                </div>
                            </header>
                            <article>{!! $post->content !!}</article>
                            <footer class="blog-meta">
                                <div>
                                    <a href="javascript:" id="blog_comment_from">{{ $comments_count }} comments </a>
                                    / TAGS:
                                    @foreach ($post->tags as $tag)
                                        <a href="{{ route('botu.blog.posts.by.tag', $tag->id) }}"
                                            class="btn-sm">{{ $tag->name }}</a>
                                    @endforeach
                                </div>
                            </footer>
                        </div>
                    </div>
                    <div class="share-block mb--50">
                        <h3>Share Now</h3>
                        <div class="social-links  justify-content-center  mt--10">
                            <a href="#" class="single-social social-rounded"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="single-social social-rounded"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="single-social social-rounded"><i class="fab fa-pinterest-p"></i></a>
                            <a href="#" class="single-social social-rounded"><i class="fab fa-google-plus-g"></i></a>
                            <a href="#" class="single-social social-rounded"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="comment-block-wrapper mb--50">
                        <h3 id="blog_comment_to">{{ $comments_count }} Comments</h3>
                        @if (isset($comments) && !empty($comments))
                            @foreach ($comments as $comment)
                                <div class="single-comment" style="background-color: #eee;">
                                    <div class="comment-avatar">
                                        @if (!empty($comment->user->image))
                                            <img src="{{ url('/uploads/users/' . $comment->user->image) }}"
                                                alt="User Image">
                                        @else
                                            <img src="{{ url('/uploads/default/no_image.jpg') }}" alt="No Image">
                                        @endif
                                    </div>
                                    <div class="comment-text">
                                        <h5 class="author"> <a href="#"> {{ $comment->user->first_name }}
                                                {{ $comment->user->last_name }}</a></h5>
                                        <span class="time">{{ $comment->created_at->format('M d, Y') }} at
                                            {{ $comment->created_at->format('H:i A') }}</span>
                                        <p>{{ $comment->message }}</p>
                                    </div>
                                    <a href="#collapseForm{{ $comment->id }}"
                                        class="btn btn-outlined--primary btn-rounded reply-btn"
                                        data-toggle="collapse">Reply</a>
                                </div>
                                <div class="collapse replay-form-wrapper" id="collapseForm{{ $comment->id }}">
                                    <h3 class="mt-0">LEAVE A REPLY</h3>
                                    <form action="{{ route('botu.blog.comment.store', $post->id) }}" class="blog-form"
                                        method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="message">Comment *</label>
                                                    <textarea name="message" id="message" cols="30" rows="10" class="form-control"></textarea>
                                                    @if ($errors->has('message'))
                                                        @foreach ($errors->get('message') as $error)
                                                            <small class="text-danger">{{ $error }}</small>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="name">Name *</label>
                                                    <input type="text" name="name" id="name"
                                                        class="form-control">
                                                    @if ($errors->has('name'))
                                                        @foreach ($errors->get('name') as $error)
                                                            <small class="text-danger">{{ $error }}</small>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="email">Email *</label>
                                                    <input type="text" name="email" id="email"
                                                        class="form-control">
                                                    @if ($errors->has('email'))
                                                        @foreach ($errors->get('email') as $error)
                                                            <small class="text-danger">{{ $error }}</small>
                                                        @endforeach
                                                    @endif
                                                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="submit-btn">
                                                    <button type="submit" class="btn btn-black">Post Comment</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                @if (isset($comment->replies) && !empty($comment->replies))
                                    @foreach ($comment->replies as $reply)
                                        <div class="single-comment"
                                            style="margin-left: 10px; width: calc(100%-10px); background-color: #eee;">
                                            <div class="comment-avatar">
                                                @if (!empty($reply->user->image))
                                                    <img src="{{ url('/uploads/users/' . $reply->user->image) }}"
                                                        alt="User Image">
                                                @else
                                                    <img src="{{ url('/uploads/default/no_image.jpg') }}" alt="No Image">
                                                @endif
                                            </div>
                                            <div class="comment-text">
                                                <h5 class="author"> <a href="#"> {{ $reply->user->first_name }}
                                                        {{ $reply->user->last_name }}</a></h5>
                                                <span class="time">{{ $reply->created_at->format('M d, Y') }} at
                                                    {{ $reply->created_at->format('H:i A') }}</span>
                                                <p>{{ $reply->message }}</p>
                                            </div>
                                            <a href="#collapseForm{{ $reply->id }}"
                                                class="btn btn-outlined--primary btn-rounded reply-btn"
                                                data-toggle="collapse">Reply</a>
                                        </div>
                                        <div class="collapse replay-form-wrapper" id="collapseForm{{ $reply->id }}">
                                            <h3 class="mt-0">LEAVE A REPLY</h3>
                                            <form action="{{ route('botu.blog.comment.store', $post->id) }}"
                                                class="blog-form" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="message">Comment *</label>
                                                            <textarea name="message" id="message" cols="30" rows="10" class="form-control"></textarea>
                                                            @if ($errors->has('message'))
                                                                @foreach ($errors->get('message') as $error)
                                                                    <small class="text-danger">{{ $error }}</small>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="name">Name *</label>
                                                            <input type="text" name="name" id="name"
                                                                class="form-control">
                                                            @if ($errors->has('name'))
                                                                @foreach ($errors->get('name') as $error)
                                                                    <small class="text-danger">{{ $error }}</small>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="email">Email *</label>
                                                            <input type="text" name="email" id="email"
                                                                class="form-control">
                                                            @if ($errors->has('email'))
                                                                @foreach ($errors->get('email') as $error)
                                                                    <small class="text-danger">{{ $error }}</small>
                                                                @endforeach
                                                            @endif
                                                            <input type="hidden" name="parent_id"
                                                                value="{{ $reply->id }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="submit-btn">
                                                            <button type="submit" class="btn btn-black">Post
                                                                Comment</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        @if (isset($reply->replies) && !empty($reply->replies))
                                            @foreach ($reply->replies as $reply)
                                                <div class="single-comment"
                                                    style="margin-left: 20px; width: calc(100%-20px); background-color: #eee;">
                                                    <div class="comment-avatar">
                                                        @if (!empty($reply->user->image))
                                                            <img src="{{ url('/uploads/users/' . $reply->user->image) }}"
                                                                alt="User Image">
                                                        @else
                                                            <img src="{{ url('/uploads/default/no_image.jpg') }}"
                                                                alt="No Image">
                                                        @endif
                                                    </div>
                                                    <div class="comment-text">
                                                        <h5 class="author"> <a href="#">
                                                                {{ $reply->user->first_name }}
                                                                {{ $reply->user->last_name }}</a></h5>
                                                        <span class="time">{{ $reply->created_at->format('M d, Y') }} at
                                                            {{ $reply->created_at->format('H:i A') }}</span>
                                                        <p>{{ $reply->message }}</p>
                                                    </div>
                                                    <a href="#collapseForm{{ $reply->id }}"
                                                        class="btn btn-outlined--primary btn-rounded reply-btn"
                                                        data-toggle="collapse">Reply</a>
                                                </div>
                                                <div class="collapse replay-form-wrapper"
                                                    id="collapseForm{{ $reply->id }}">
                                                    <h3 class="mt-0">LEAVE A REPLY</h3>
                                                    <form action="{{ route('botu.blog.comment.store', $post->id) }}"
                                                        class="blog-form" method="POST">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="message">Comment *</label>
                                                                    <textarea name="message" id="message" cols="30" rows="10" class="form-control"></textarea>
                                                                    @if ($errors->has('message'))
                                                                        @foreach ($errors->get('message') as $error)
                                                                            <small
                                                                                class="text-danger">{{ $error }}</small>
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="name">Name *</label>
                                                                    <input type="text" name="name" id="name"
                                                                        class="form-control">
                                                                    @if ($errors->has('name'))
                                                                        @foreach ($errors->get('name') as $error)
                                                                            <small
                                                                                class="text-danger">{{ $error }}</small>
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="email">Email *</label>
                                                                    <input type="text" name="email" id="email"
                                                                        class="form-control">
                                                                    @if ($errors->has('email'))
                                                                        @foreach ($errors->get('email') as $error)
                                                                            <small
                                                                                class="text-danger">{{ $error }}</small>
                                                                        @endforeach
                                                                    @endif
                                                                    <input type="hidden" name="parent_id"
                                                                        value="{{ $reply->id }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="submit-btn">
                                                                    <button type="submit" class="btn btn-black">Post
                                                                        Comment</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                @if (isset($reply->replies) && !empty($reply->replies))
                                                    @foreach ($reply->replies as $reply)
                                                        <div class="single-comment"
                                                            style="margin-left: 30px; width: calc(100%-30px); background-color: #eee;">
                                                            <div class="comment-avatar">
                                                                @if (!empty($reply->user->image))
                                                                    <img src="{{ url('/uploads/users/' . $reply->user->image) }}"
                                                                        alt="User Image">
                                                                @else
                                                                    <img src="{{ url('/uploads/default/no_image.jpg') }}"
                                                                        alt="No Image">
                                                                @endif
                                                            </div>
                                                            <div class="comment-text">
                                                                <h5 class="author"> <a href="#">
                                                                        {{ $reply->user->first_name }}
                                                                        {{ $reply->user->last_name }}</a></h5>
                                                                <span
                                                                    class="time">{{ $reply->created_at->format('M d, Y') }}
                                                                    at
                                                                    {{ $reply->created_at->format('H:i A') }}</span>
                                                                <p>{{ $reply->message }}</p>
                                                            </div>
                                                            <a href="javascript:"
                                                                class="btn btn-outlined--primary btn-rounded reply-btn">Sorry</a>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        @endif
                    </div>
                    <div class="replay-form-wrapper">
                        <h3 class="mt-0">LEAVE A REPLY</h3>
                        <form action="{{ route('botu.blog.comment.store', $post->id) }}" class="blog-form"
                            method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="message">Comment *</label>
                                        <textarea name="message" id="message" cols="30" rows="10" class="form-control"></textarea>
                                        @if ($errors->has('message'))
                                            @foreach ($errors->get('message') as $error)
                                                <small class="text-danger">{{ $error }}</small>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Name *</label>
                                        <input type="text" name="name" id="name" class="form-control">
                                        @if ($errors->has('name'))
                                            @foreach ($errors->get('name') as $error)
                                                <small class="text-danger">{{ $error }}</small>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="email">Email *</label>
                                        <input type="text" name="email" id="email" class="form-control">
                                        @if ($errors->has('email'))
                                            @foreach ($errors->get('email') as $error)
                                                <small class="text-danger">{{ $error }}</small>
                                            @endforeach
                                        @endif
                                        <input type="hidden" name="parent_id">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="submit-btn">
                                        <button type="submit" class="btn btn-black">Post Comment</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @include('frontend.pages.blog.blog_sidebar')
            </div>
        </div>
    </section>
@endsection

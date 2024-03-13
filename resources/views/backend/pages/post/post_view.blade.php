@extends('backend.admin')
@section('content')
    <div class="container" style="width: 90%; padding-top: 30px;">
        <div class="card text-center">
            <div class="card-header">
                <span class="text-danger">User name:</span> {{ $post->user->first_name }} {{ $post->user->last_name }} |
                <span class="text-danger">Category name:</span>
                {{ $post->category->name }}
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">Slug: {{ $post->slug }}</p>
                <p class="card-text"> Tags:
                    @foreach ($post->tags as $tag)
                        <span class="badge bg-secondary">{{ $tag->name }}</span>
                    @endforeach
                </p>
                @if (!empty($post->image))
                    <img src="{{ asset('uploads/blog_images/' . $post->image) }}" style="width: 100%; height: auto;"
                        alt="Post Image">
                @else
                    <img src="{{ asset('uploads/default/no_image.jpg') }}" alt="No Image">
                @endif
                <article>{!! $post->content !!}</article>
                <a href="{{ route('admin.post.index') }}" class="btn btn-info">
                    <- Go Back</a>
            </div>
            <div class="card-footer text-muted">
                Status: {{ $post->status }} | Created At: {{ $post->created_at }}
            </div>
        </div>
    </div>
@endsection

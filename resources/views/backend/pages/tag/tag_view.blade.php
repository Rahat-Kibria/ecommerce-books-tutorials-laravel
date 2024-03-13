@extends('backend.admin')
@section('content')
    <div class="container" style="width: 70%; padding-top: 30px;">
        <div class="card text-center">
            <div class="card-header">
                Tag ID: {{ $tag->id }}
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $tag->slug }}</h5>
                <p class="card-text">{{ $tag->description }}</p>
                <a href="{{ route('tag.index') }}" class="btn btn-info">
                    <- Go Back</a>
            </div>
            <div class="card-footer text-muted">
                Name: {{ $tag->name }}
            </div>
        </div>
    </div>
@endsection

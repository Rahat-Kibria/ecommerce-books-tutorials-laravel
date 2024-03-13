@extends('backend.admin')
@section('content')
    <div class="container" style="width: 70%; padding-top: 30px;">
        <div class="card text-center">
            <div class="card-header">
                User ID: {{ $feedback->user_id }}
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $feedback->email }}</h5>
                <p class="card-text">{{ $feedback->message }}</p>
                <a href="{{ route('admin.feedbacks.list') }}" class="btn btn-info">
                    <- Go Back</a>
            </div>
            <div class="card-footer text-muted">
                Name: {{ $feedback->name }}
            </div>
        </div>
    </div>
@endsection

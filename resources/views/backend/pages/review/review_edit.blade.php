@extends('backend.admin')
@section('content')
    <div class="mt-3" style="width: 35%; padding-left: 50px;">
        <h3 class="alert alert-success">Admin > Edit Review</h3>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" style="margin-left: 50px; margin-right: 50px;"
            role="alert">
            {{ session()->get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div style="padding: 50px;">
        <form action="{{ route('admin.review.update', $review->id) }}" method="POST">
            <fieldset class="form-group border" style="background-color: #CEFAD0;">
                @csrf
                @method('put')
                <legend class="w-auto">Review Edit</legend>
                <div class="form-group mb-3">
                    <label for="status" class="form-label">Status:</label>
                    <select name="status" id="status" class="form-control">
                        <option @if ($review->status == 'pending') selected @endif value="pending" default>Pending</option>
                        <option @if ($review->status == 'approved') selected @endif value="approved">Approved</option>
                    </select>
                    @if ($errors->has('status'))
                        @foreach ($errors->get('status') as $error)
                            <small class="text-danger">{{ $error }}</small>
                        @endforeach
                    @endif
                </div>
                <div class="form-group d-flex justify-content-left">
                    <input type="submit" value="Submit" class="btn btn-primary m-2">
                </div>
            </fieldset>
        </form>
    </div>
@endsection

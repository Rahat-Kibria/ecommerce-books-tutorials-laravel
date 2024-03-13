@extends('backend.admin')
@section('content')
    <div class="mt-3" style="width: 35%; padding-left: 10px;">
        <h3 class="alert alert-success">Admin > Edit Audio</h3>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" style="margin: 10px;" role="alert">
            {{ session()->get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div style="padding: 10px;">
        <form action="{{ route('admin.audio.update', $audio->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <fieldset class="form-group border" style="background-color: #CEFAD0;">
                <legend class="w-auto">Edit Audio</legend>
                <div class="form-group mb-3">
                    <label for="product_name" class="form-label">Product Name<span style="color: red;">*</span></label>
                    <select name="product_id" id="product_name" class="form-control">
                        @foreach ($products as $product)
                            <option @if ($product->id == $audio->product->id) selected @endif value="{{ $product->id }}">
                                {{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="audio" class="form-label">Pick an Audio File<span style="color: red;">*</span></label>
                    <input type="file" id="audio" name="audio" class="form-control" accept="audio/mpeg">
                    @if ($errors->has('audio'))
                        @foreach ($errors->get('audio') as $error)
                            <small class="text-danger">{{ $error }}</small>
                        @endforeach
                    @endif
                </div>
                <div class="form-group mb-3">
                    <audio controls>
                        <source src="{{ asset($audio->audio) }}" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                </div>
                <div class="form-group d-flex justify-content-center">
                    <input type="submit" value="Submit" class="btn btn-primary m-2">
                    <input type="reset" value="Reset" class="btn btn-primary m-2">
                </div>
            </fieldset>
        </form>
    </div>
@endsection

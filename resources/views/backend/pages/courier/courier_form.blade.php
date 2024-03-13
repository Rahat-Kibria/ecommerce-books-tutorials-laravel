@extends('backend.admin')
@section('content')
    <h1 style="text-align: center;">Add a Courier</h1>
    <form action="{{ route('admin.courier.form.submit') }}" method="POST" enctype="multipart/form-data">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <p class="alert alert-danger">{{ $error }}</p>
            @endforeach
        @endif
        @csrf
        <fieldset class="form-group border" style="background-color: #ADD8E6;">
            <legend class="w-auto">Courier Form</legend>
            <div class="form-group mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Rahat" required>
            </div>
            <div class="form-group mb-3">
                <label for="address" class="form-label">Address:</label>
                <input type="text" id="address" name="address" class="form-control" placeholder="Uttara, Dhaka"
                    required>
            </div>
            <div class="form-group mb-3">
                <label for="contact_number" class="form-label">Contact Number:</label>
                <input type="text" id="contact_number" name="contact_number" class="form-control"
                    placeholder="01234567890" required>
            </div>
            <div class="form-group mb-3">
                <label for="nid_number" class="form-label">NID Number:</label>
                <input type="text" id="nid_number" name="nid_number" class="form-control" placeholder="0123456789"
                    required>
            </div>
            <div class="form-group mb-3">
                <label for="image" class="form-label">Image:</label>
                <input type="file" id="image" name="image" class="form-control"
                    accept="image/png, image/jpeg, image/jpg, image/gif">
            </div>
            <div class="form-group d-flex justify-content-center">
                <input type="submit" value="Submit" class="btn btn-primary m-2">
                <input type="reset" value="Reset" class="btn btn-primary m-2">
            </div>
        </fieldset>
    </form>
@endsection

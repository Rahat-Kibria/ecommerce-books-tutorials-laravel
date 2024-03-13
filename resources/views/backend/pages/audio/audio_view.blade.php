@extends('backend.admin')
@section('content')
    <div class="container mt-5 mb-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="product p-4" style="height: 100%; background-color: #eee; text-align:center">
                        <div>
                            <a href="{{ route('admin.audios.list') }}" class="btn btn-info"> <i
                                    class="fa fa-long-arrow-left"></i> <span class="ms-1">Back</span> </a>
                        </div>
                        <div class="sizes mt-2">
                            <h6 class="text-uppercase d-inline">Product Name:</h6>
                            <span class="text-uppercase">{{ $audio->product->name }}</span>
                        </div>
                        @php
                            $path = public_path() . $audio->audio;
                            $filesize = filesize($path);
                            $ratio = 6900; //128Kb
                            $duration = $filesize / $ratio;
                            $hours = 0;
                            $minutes = floor($duration / 60);
                            $seconds = floor($duration - $minutes * 60);
                        @endphp
                        <div class="sizes mt-2">
                            <h6 class="text-uppercase d-inline">File Size:</h6>
                            <span class="text-uppercase">{{ floor($filesize / 1000) }} KB</span>
                        </div>
                        <div class="sizes mt-2">
                            <h6 class="text-uppercase d-inline">Audio Duration:</h6>
                            <span class="text-uppercase">{{ $hours }}:{{ $minutes }}:{{ $seconds }}</span>
                        </div>
                        <div class="sizes mt-3">
                            <h6 class="text-uppercase d-inline">File:</h6>
                            <audio controls>
                                <source src="{{ asset($audio->audio) }}" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        </div>
                        <div class="cart mt-4 align-items-center">
                            <a type="button" href="{{ route('admin.audio.edit', $audio->id) }}"
                                class="btn btn-warning text-uppercase me-2 px-4"><i class="fa-solid fa-pen-to-square"></i>
                                Edit</a>
                            <form action="{{ route('admin.audio.delete', $audio->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger text-uppercase me-2 px-4"
                                    onclick="return confirm('Are you sure?')">
                                    <i class="fa-solid fa-trash-can text-dark"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

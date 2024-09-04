@extends('layouts.app')

@section('title', '退会')

@section('content')
    <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel" data-bs-theme="light">
        <img src="{{ asset('images/退会.jpg') }}" class="bd-placeholder-img card-img-top " style="object-fit: cover;"
            width="100%" height="400px" alt="Sample Image">
        <div class="carousel-caption text-start" style="top: 60px;">
            <h1><strong>本当に退会しますか？</strong></h1>
        </div>
    </div>
    <div class="d-flex justify-content-center align-items-center" style="min-height: 200px;">
        <form action="{{ route('users.destroy') }}" method="post">
            @csrf
            @method('delete')
            <input type="hidden" name="user_id">
            <button type="submit" class="btn bg-danger text-light px-5 py-2 mb-4 hover-effect w-100">
                退会する
            </button>
        </form>
    </div>
@endsection

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
    <div class="py-5 container ms-auto sticky-top" style="min-height: calc(30vh - 30px); width: 400px;">
        <div class="d-flex">
                <div class="d-grid gap-1 col-6 align-items-center">
                    <form action="{{ route('users.destroy') }}" method="post">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="user_id">
                        <button type="submit" class="btn bg-danger text-light px-5 py-2 mb-4 error">
                            退会する
                        </button>
                    </form>
                </div>
                <div class="d-grid gap-1 col-6 align-items-center">
                    <botton>
                        <a href="{{ route('orders.index') }}"
                            class="btn btn-secondary text-light px-5 py-2 mb-4 hover-effect">キャンセル</a>
                    </botton>
                </div>
        </div>
    </div>
@endsection

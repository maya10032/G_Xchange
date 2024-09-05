@extends('layouts.app')

@section('title', '購入完了')

@section('content')
    <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel">
        <img src="{{ asset('images/purchase.jpg') }}" class="bd-placeholder-img card-img-top " style="object-fit: cover;"
            width="100%" height="400px" alt="Sample Image">
        <div class="carousel-caption text-start text-dark">
            <h1><strong>ご購入ありがとうございました。</strong></h1>
            <h4><strong>商品ご到着までしばらくお待ちください。</strong></h4>
        </div>
    </div>
    <div class="d-flex justify-content-center align-items-center" style="min-height: 200px;">
        <button type="submit" class="btn bg-dark text-light  px-5 py-2 hover-effect">
            <a href="{{ url('/') }}" style="color: inherit; text-decoration: none;">商品一覧へ戻る</a>
        </button>
    </div>
    </div>
@endsection

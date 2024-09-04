@extends('layouts.app')

@section('title', '購入内容確認')

@section('content')
<div class="container">
    <h2>購入内容確認ページ</h2>
    <h2 class="text-danger fw-bold text-center p-1">※内容をご確認の上、購入するを押してください。</h2>
    <div class="mb-2 d-flex p-5">
        <!-- 画像を左側に配置 -->
        <div class="d-flex flex-wrap" style="max-width: 400px;">
            @foreach ($item->images as $image)
                <div class="col-6 p-1">
                    <img src="{{ asset('storage/images/' . $image->img_path) }}" alt="Image" class="img-fluid rounded"
                        style="height: 200px; object-fit: cover;">
                </div>
            @endforeach
        </div>
        <!-- 説明を右側に配置 -->
        <div class="ms-4" style="flex-grow: 1; font-size: 1.25rem;">
            <form action="{{ route('orders.store') }}" method="POST">
                @csrf
                <div class="ms-4" style="flex-grow: 1; font-size: 1.25rem;">
                    <p class="mb-2"><small class="text-muted">カテゴリー：{{ $item->category_id }}</small></p>
                    <h3 class="mb-3" style="font-size: 1.75rem;">{{ $item->item_name }}</h3>
                    <p>{{ $item->message }}</p>
                    {{-- 割引していないとき --}}
                    @php
                        $taxRate = config('tax.rate'); // 税率10%
                    @endphp
                    @if ($item->regular_price === $item->sales_price)
                        <p>{{ number_format($item->regular_price * (1 + $taxRate)) }}円</p>
                    @else
                        {{-- 割引中の表示 --}}
                        <strike class="d-block mb-3" style="font-size: 1.5rem;">
                            {{ number_format($item->regular_price * (1 + $taxRate)) }}円
                            <span class="badge bg-danger ms-2" style="position: relative; top: -5px;">SALE</span>
                        </strike>
                        <p class="h4 text-danger fw-bold mb-3">{{ number_format($item->sales_price * (1 + $taxRate)) }} 円
                            送料無料
                        </p>
                    @endif
                    <p>数量：{{ $count }}</p>
                    <div class="d-grid gap-2 col-4">
                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                        <input type="hidden" name="count" value="{{ $count }}">

                        <button type="submit" class="btn btn-danger mb-2" style="font-size: 1.25rem;">購入する</button>
                        <a class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                            href="{{ route('items.show', $item->id) }}">キャンセル</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



@endsection

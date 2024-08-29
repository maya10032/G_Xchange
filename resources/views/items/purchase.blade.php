@extends('layouts.app')

@section('title', '購入内容確認')

@section('content')
    <h2>購入内容確認ページ</h2>
    <h2>※内容をご確認の上、購入するを押してください。</h2>
    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <p>カテゴリー：{{ $item->category_id }}</p>
        <p>商品名：{{ $item->item_name }}</p>
        <p>商品説明：{{ $item->message }}</p>
        <p>商品画像</p>

        {{-- 割引していないとき --}}
        @if ($item->regular_price === $item->sales_price)
            <p>{{ $item->regular_price }}円</p>
        @else
            {{-- 割引中の表示 --}}
            <strike>
                <p>{{ $item->regular_price }}円</p>
            </strike>
            <p>{{ $item->sales_price }} 円 送料無料</p>
        @endif

        <p>数量：{{ $count }}</p>
        <input type="hidden" name="item_id" value="{{ $item->id }}">
        <input type="hidden" name="count" value="{{ $count }}">

        <button type="submit">購入する</button>
    </form>

    <a href="{{ route('items.show', $item->id) }}">キャンセル</a>
@endsection

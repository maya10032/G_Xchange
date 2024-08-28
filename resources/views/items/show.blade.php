@extends('layouts.app')

@section('title', '商品詳細')

@section('content')
    <h2>商品詳細ページ</h2>
    <tbody>
        <p>カテゴリー：{{ $item->category_id }}</p>
        <p>商品名：{{ $item->item_name }}</p>
        {{-- 割引していないとき --}}
        @if ($item->regular_price === $item->sales_price)
            {{ $item->regular_price }}円
        @else
            {{-- 割引中の表示 --}}
            <strike>
                <p>{{ $item->regular_price }}円</p>
            </strike>
            <p>{{ $item->sales_price }} 円 送料無料</p>
        @endif
        {{-- 一般ユーザーの場合 --}}
        @if (auth()->guest())
            <div>
                <a href="{{ url('login/') }}">購入するにはログインしてください</a>
            </div>
        @else
            <form action="{{ route('items.purchase', ['item' => $item->id]) }}" method="POST">
                <div>
                    数量：<input type="number" min="1" max="{{ $item->count_limit }}" name="count"
                        value="{{ old('count') }}">
                </div>
                {{-- 会員の場合 --}}
                <button><a href="{{ url('items/cart') }}">カートに追加</a></button>
                @csrf
                <input type="hidden" name="showMessage" value="1">
                <button type="submit">購入する</button>
            </form>
            <button type="submit">お気に入りに追加</button>
        @endif
    </tbody>
    <a href="{{ url('/') }}">商品一覧に戻る</a>
@endsection

{{-- {{ Debugbar::log($items->toArray()) }} --}}

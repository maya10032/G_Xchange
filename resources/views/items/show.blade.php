@extends('layouts.app')

@section('title', '商品詳細')

@section('content')
    <h2>商品詳細ページ</h2>
    {{-- お気に入り通知 --}}
    @if (session('likeadd'))
        <div class="alert alert-success text-center fw-bold">
            {{ session('likeadd') }}
        </div>
    @elseif (session('likedelete'))
        <div class="alert alert-info text-center fw-bold">
            {{ session('likedelete') }}
        </div>
    @endif
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
            {{-- 会員の場合 --}}
            <form action="{{ url('/items/purchase', $item->id) }}" method="POST" class="form-horizontal">
                @csrf
                <div>
                    数量：<input type="number" max="100" name="count" value="{{ old('count', 1) }}">
                    {{-- 購入数のエラーメッセージの表示 --}}
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    @endif
                </div>
                <button type="button" onclick="window.location.href='{{ url('items/cart') }}'">カートに追加</a></button>
                <button type="submit" name="item">購入する</button>
            </form>
            {{-- お気に入りが追加済みかを確認(trueは登録済みであれば) --}}
            @if (Auth::user()->isLike($item->id))
                <form action="{{ route('likes.destroy') }}" method="post">
                    @csrf
                    @method('delete')
                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                    <button>{{ __('like') . __('delete') }}</button>
                </form>
                {{-- 登録済みでなければ追加ボタンを表示 --}}
            @else
                <form action="{{ route('likes.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                    <button>{{ __('like') . __('create') }}</button>
                </form>
            @endif
        @endif
    </tbody>
    <a href="{{ url('/') }}">商品一覧に戻る</a>
@endsection

{{-- {{ Debugbar::log($items->toArray()) }} --}}

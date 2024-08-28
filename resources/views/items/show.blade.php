@extends('layouts.app')
<!-- 1行で指定することも可能 -->
@section('title', '商品詳細')

@section('content')
        <tbody>
            <h2>商品詳細ページ</h2>
            <div class="form-group col-xs-12">
                <div class="input-group mb-4">カテゴリー</div>
                <input class="form-control bg-light" disabled value="{{ $item->item_name }}">
                <input class="form-control bg-light" disabled value="{{ $item->regular_price }}円">
                <P><input class="form-control bg-light" disabled value="{{ $item->sales_price }} 円">送料無料</P>
            </div>
            {{-- 一般ユーザーの場合 --}}
            @if (auth()->guest())
                <div>
                    <button><a href="{{ url('login/') }}">購入するにはログインしてください</button>
                </div>
            @else
            {{-- 会員の場合 --}}
                <div>
                    <button><a href="{{ url('admin/items/cere') }}">カートに追加</a></button>
                    <form action="{{ url('items/' . $item->id) }}" method="post">
                        <button type="submit">購入する</button>
                        <button type="submit">お気に入りに追加</button>
                    </form>
                </div>
            @endif
        </tbody>
    <a href="{{ url('/') }}">商品一覧に戻る</a>
@endsection

{{-- {{ Debugbar::log($items->toArray()) }} --}}

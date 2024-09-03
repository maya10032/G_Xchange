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
    @elseif (session('cartadd'))
        <div class="alert alert-info text-center fw-bold">
            {{ session('cartadd') }}
        </div>
    @endif
    <tbody>
        @foreach ($item->images as $image)
            <td><img src="{{ asset('storage/images/' . $item->images->first()->img_path) }}" alt="Image"
                    style="width: 150px; height: auto;">
            </td>
        @endforeach
        <p>カテゴリー：{{ $item->category_id }}</p>
        <p>商品名：{{ $item->item_name }}</p>
        {{-- 割引していないとき --}}
        @if ($item->regular_price === $item->sales_price)
            {{ number_format($salesPriceWithTax) }}円（税込）送料無料
        @else
            {{-- 割引中の表示 --}}
            <strike>
                <p>{{ number_format($regularPriceWithTax) }}円</p>
            </strike>
            <p>{{ number_format($salesPriceWithTax) }} 円（税込）送料無料</p>
        @endif
        {{-- 一般ユーザーの場合 --}}
        @if (auth()->guest())
            <div>
                <a href="{{ url('login/') }}">購入するにはログインしてください</a>
            </div>
        @else
            @if ($item->is_active)
                {{-- 会員の場合 --}}
                <form action="{{ url('/purchase', $item->id) }}" method="POST" class="form-horizontal">
                    @csrf
                    <div>
                        数量：<input type="number" name="count" min="1" max="$item->count_limit"
                            value="{{ old('count', 1) }}">
                        <p>※一度に購入できるのは{{ $item->count_limit }}個までです。</p>
                        {{-- 購入数のエラーメッセージの表示 --}}
                        @foreach ($errors->all() as $error)
                            <p>※{{ $error }}</p>
                        @endforeach
                    </div>
                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                    <button type="submit" name="action" value="cart">カートに追加</button>
                    <button type="submit" name="action" value="purchase">購入ページへ</button>
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
            @else
                <h2>現在販売していません</h2>
            @endif
        @endif
        <a href="{{ url('/') }}">商品一覧に戻る</a>
    </tbody>
@endsection

{{-- {{ Debugbar::log($items->toArray()) }} --}}

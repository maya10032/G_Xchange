@extends('layouts.app')
<!-- 1行で指定することも可能 -->
@section('title', '商品詳細')

@section('content')
    <h2>商品詳細ページ</h2>
    <tbody>
        @if (session('likeadd'))
            <div class="alert alert-success text-center fw-bold">
                {{ session('likeadd') }}
            </div>
        @elseif (session('likedelete'))
            <div class="alert alert-info text-center fw-bold">
                {{ session('likedelete') }}
            </div>
        @endif
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
                </form>
            </div>
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
            <p class="text-xs text-gray-500 mt-3">{{ __('navlike') }}</p>
            </div>
            </div>
        @endif
        </div>
    </tbody>
    <a href="{{ url('/') }}">商品一覧に戻る</a>
@endsection

{{-- {{ Debugbar::log($items->toArray()) }} --}}

@extends('layouts.app')
<!-- 1行で指定することも可能 -->
@section('title', '商品詳細')

@section('content')
    <table class="table table-bordered table-striped task-table table-hover">
        @if (session('success'))
            <div class="alert alert-success text-center fw-bold">
                {{ session('success') }}
            </div>
        @elseif (session('update'))
            <div class="alert alert-info text-center fw-bold">
                {{ session('update') }}
            </div>
        @endif
        <tbody>
            <h2>商品詳細ページ</h2>
                <div class="form-group col-xs-12">
                    <div class="input-group mb-4">カテゴリー</div>
                    <input class="form-control bg-light" disabled value="{{ $item->item_name }}">
                    <input class="form-control bg-light" disabled value="{{ $item->regular_price }}円">
                    <P><input class="form-control bg-light" disabled value="{{ $item->sales_price }} 円">送料無料</P>
                </div>
                <div>
                    <button><a href="{{ url('admin/items/cere') }}">カートに追加</a></button>
                    <form action="{{ url('admin/items/' . $item->id) }}" method="post">
                        <button type="submit">購入する</button>
                        <button type="submit">お気に入りに追加</button>
                    </form>
                </div>
        </tbody>
    </table>
    <a href="{{ url('/') }}">商品一覧に戻る</a>
@endsection

{{-- {{ Debugbar::log($items->toArray()) }} --}}

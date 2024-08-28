@extends('layouts.admin')

@section('title', '商品詳細')

@section('content')

    <div class="form-group col-xs-12">
        <div class="input-group-text">カテゴリー</div>
        <input class="form-control bg-light" disabled value="{{ $item->category_id }}">
    </div>
    </div>
    <div class="form-group col-xs-12">
        <div class="input-group mb-4">
            <div class="input-group-text">商品名</div>
            <input class="form-control bg-light" disabled value="{{ $item->item_name }}">
        </div>
    </div>
    <div class="form-group col-xs-12">
        <div class="input-group mb-4">
            <div class="input-group-text">画像</div>
            <input class="form-control bg-light" disabled value="商品画像">
        </div>
    </div>
    <div class="form-group col-xs-12">
        <div class="input-group mb-4">
            <div class="input-group-text">商品説明</div>
            <input class="form-control bg-light" disabled value="{{ $item->message }}">
        </div>
    </div>
    <div class="form-group col-xs-12">
        <div class="input-group mb-4">
            <div class="input-group-text">通常価格</div>
            <input class="form-control bg-light" disabled value="{{ number_format($item->regular_price) }}円">
        </div>
    </div>
    <div class="form-group col-xs-12">
        <div class="input-group mb-4">
            <div class="input-group-text">販売価格</div>
            <input class="form-control bg-light" disabled value="{{ number_format($item->sales_price) }}円">
        </div>
    </div>
    <button><a href="{{ url('admin/items/' . $item->id . '/cere') }}">編集画面へ</a>
        <form action="{{ url('admin/items/' . $item->id) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button type="submit">この商品を削除する
            </button>
        </form>
        <a href="{{ url('admin/items/') }}">一覧に戻る</a>
    @endsection

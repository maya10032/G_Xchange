@extends('layouts.admin')

@section('title', '受注商品詳細')

@section('content')
    <h1>受注商品詳細</h1>

    <p>注文日: {{ $order->created_at }}</p>
    <p>注文番号: {{ $order->id }}</p>
    <h2>配送情報</h2>
    <div class="form-group col-xs-12">
        <div class="input-group mb-4">
            <div class="input-group-text">商品画像が入る？ {{ $order->item_images->is_thumbnail }}</div>
            <div class="input-group-text">
                カテゴリー名：{{ $order->categorys->category_id }} <br>
                商品名：{{ $order->items->item_name }} <br><br>
                {{ number_format($order->items->sales_price) }}円 × {{ $order->count }} <br>
            </div>
        </div>
    </div>
    <p>名前: {{ $order->user->name }}</p>
    <p>メール: {{ $order->user->email }}</p>
    <p>住所: {{ $order->user->address }}</p>
    <h2>お支払い金額</h2>
    <p>{{ number_format($subtotal) }}円（税込）</p>

    <a href="{{ url('admin/orders/') }}">受注商品一覧へ戻る</a>
@endsection

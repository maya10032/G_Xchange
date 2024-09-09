@extends('layouts.admin')

@section('title', '受注商品詳細')

@section('content')
    <topnav>
        <ul>
            <li><a class="current" href="{{ url('admin/orders') }}">受注管理</a></li>
            <li><a class="current" href="{{ route('admin.orders.show', ['id' => $order->id]) }}">受注商品詳細</a></li>
        </ul>
    </topnav>
    <h2 class="py-2 admin">受注商品詳細</h2>
    <div class="d-flex">
        <p class="me-3">注文番号: {{ $order->id }}</p>
        <p class="me-3">注文日: {{ $order->created_at }}</p>
    </div>
    <h3 class="p-3 mb-2 bg-body-secondary">配送情報</h3>
    <div class="p-5 my-4 border-bottom border-top border-secondary-subtle">
        <div class="form-group col-xs-12">
            <div class="input-group">
                <div class="mb-2 me-3" style="max-height: 465px;">
                    <img src="{{ asset('storage/images/' . $order->item->images[$order->item->thumbnail]->img_path) }}"
                        alt="Thumbnail" class="img-fluid rounded"
                        style="width: 265px; height: 265px; object-fit: cover; max-height: 465px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);">
                </div>
                <div class="flex-grow-1 ms-3 w-25">
                    <p>カテゴリー名：{{ $order->item->category->category_name }}</p>
                    <p class="mb-3" style="font-size: 1.75rem; word-break: break-word;">商品名：{{ $order->item->item_name }}
                    </p>
                    <p>商品名：{{ $order->item->message }}</p>
                    <p>{{ number_format($order->item->tax_sales_prices) }}円 × {{ $order->count }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="px-5 mb-5">
        <p>名前: {{ $order->user->name }}</p>
        <p>電話番号: {{ $order->user->phone }}</p>
        <p>メール: {{ $order->user->email }}</p>
        <p>住所: {{ $order->user->address }}</p>
    </div>
    <h3 class="p-3 mb-2 bg-body-secondary">お支払い金額</h3>
    <div class="my-2 border-bottom border-secondary-subtle">
        <div class="px-5 d-flex justify-content-between align-items-end">
            <table class="table table-borderless w-25">
                <tr>
                    <td>数量:</td>
                    <td class="text-end">{{ $order->count }}</td>
                </tr>
                <tr>
                    <td>送料:</td>
                    <td class="text-end">0円</td>
                </tr>
                <tr>
                    <td>決済手数料:</td>
                    <td class="text-end">0円</td>
                </tr>
                <tr>
                    <td>小計（税込）:</td>
                    <td class="text-end">{{ number_format($subtotal) }}円</td>
                </tr>
            </table>
            <p class="text-end me-5 mb-0">合計（税込）:
                <span class="text-danger fw-bold" style="font-size: 2.75rem;">{{ number_format($subtotal) }}円</span>
            </p>
        </div>
    </div>
    </div>
    <p class="text-end m-3">
        <a class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
            href="{{ url('admin/orders/') }}">受注商品一覧へ戻る</a>
    </p>
@endsection

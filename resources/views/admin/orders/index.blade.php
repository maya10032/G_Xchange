@extends('layouts.admin')

@section('title', '受注管理一覧')

@section('content')
    <topnav class="topnav">
        <ul>
            <li><a class="current" href="{{ url('admin/orders') }}">受注管理</a></li>
        </ul>
    </topnav>
    @if (session('attention'))
        <div class="alert alert-danger">
            {{ session('attention') }}
        </div>
    @endif
    <h2 class="py-2 admin">受注管理</h2>
    <div class="container mb-2" style="width: 100%;">
        <div class="d-flex justify-content-end mt-3">
            <form class="d-flex" role="search">
                <input class="form-control me-2 border-secondary" style="width: 600px;" type="search"
                    placeholder="商品名、カテゴリなど" aria-label="Search">
                <button class="btn btn-dark" style="width: 80px;" type="submit">{{ __('search') }}</button>
            </form>
            <div class="ms-3">
                <select class="form-select" aria-label="並び替え">
                    <option selected>並び替え</option>
                    <option value="1">価格が安い順</option>
                    <option value="2">価格が高い順</option>
                    <option value="3">新しい順</option>
                    <option value="4">古い順</option>
                </select>
            </div>
        </div>
    </div>
    <table class="table table-bordered table-striped task-table table-hover">
            <tr>
                <th>注文番号</th>
                <th>注文日</th>
                <th>商品名</th>
                <th>商品画像</th>
                <th>数量</th>
                <th>販売価格</th>
                <th>合計金額</th>
                <th></th>
            </tr>
            @foreach ($ordersWithTax as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->created_at }}</td>
                    <td>
                        @if ($order->item->is_active)
                            {{ $order->item->item_name }}
                        @else
                            {{ $order->item->item_name }} <span class="text-danger">（販売停止中）</span>
                        @endif
                    </td>
                    <td><img src="{{ asset('storage/images/' . $order->item->images->first()->img_path) }}"
                            alt="{{ $order->item->item_name }}" style="width: 100px; height: 100px;"></td>
                    <td>{{ $order->count }}個</td>
                    <td>{{ number_format($order->item->tax_sales_prices) }}円</td>
                    <td>
                        {{ number_format($order->subtotal) }}円</td>
                    <td><a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-detail me-2"><i
                                class="fa fa-search" aria-hidden="true"></i> 詳細</td>
                </tr>
            @endforeach
    </table>
    <div class="d-flex justify-content-center my-2">
        {{ $orders->links() }}
    </div>
@endsection

{{-- {{ Debugbar::log($item->toArray()) }} --}}

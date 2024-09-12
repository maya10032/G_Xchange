@extends('layouts.admin')

@section('title', 'ユーザ情報詳細')

@section('content')
    <topnav class="topnav">
        <ul>
            <li><a class="current" href="{{ url('admin/users') }}">ユーザ管理</a></li>
            <li><a class="current" href="{{ route('admin.users.show', ['id' => $user->id]) }}">ユーザ情報詳細</a></li>
        </ul>
    </topnav>
    <h2 class="py-2 admin">ユーザ情報詳細</h2>
    <h4 class="py-2"><i class="fa fa-user" aria-hidden="true"></i> {{ $user->name }} 様のご注文履歴です。</h4>
    @if (count($orders) == 0)
        <div class="d-flex align-items-center justify-content-center w-100" style="height: 100%;">
            <h2 class="text-center text-3xl text-gray-600 mb-1">
                {{ __('noorder') }}
            </h2>
        </div>
    @else
        <table class="table table-bordered table-striped task-table table-hover">
            <tr>
                <th>@sortablelink('id', '注文番号')</th>
                <th>@sortablelink('created_at', '注文日')</th>
                <th>@sortablelink('item_name', '商品名')</th>
                <th>商品画像</th>
                <th>@sortablelink('sales_price', '販売価格')</th>
                <th>@sortablelink('count', '数量')</th>
                <th>@sortablelink('subtotal', '合計金額')</th>
            </tr>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->created_at }}</td>
                    <td>
                        @if ($order->item->is_active)
                            <a href="{{ route('admin.items.show', ['item' => $order->item->id]) }}">{{ $order->item->item_name }}
                            @else
                                <a href="{{ route('admin.items.show', ['item' => $order->item->id]) }}">{{ $order->item->item_name }}
                                    <span class="text-danger">（販売停止中）</span>
                        @endif
                    </td>
                    <td><img src="{{ asset('storage/images/' . $order->item->images->first()->img_path) }}"
                            alt="{{ $order->item->item_name }}" style="width: 100px; height: 100px;"></td>
                    <td>{{ number_format($order->item->tax_sales_prices) }}円</td>
                    <td>{{ $order->count }}個</td>
                    <td>
                        {{ number_format($order->subtotal) }}円</td>
                </tr>
            @endforeach
        </table>
        {{ $orders->links() }}
    @endif
@endsection

@extends('layouts.admin')

@section('title', '受注管理一覧')

@section('content')
    <h2>受注管理一覧画面</h2>
    {{-- 購入履歴が空だったら --}}
@if (count($orders) == 0)
        <div class="flex items-center justify-center w-full absolute inset-0">
            <h2 class="tracking-widest text-center w-full text-3xl title-font font-light text-gray-600 mb-1">
                {{ __('noorder') }}
            </h2>
        </div>
    @else
        <table class="table table-bordered table-striped task-table table-hover">
            <thead>
                <tr>
                    <th>注文番号</th>
                    <th>注文日</th>
                    <th>商品名</th>
                    <th>数量</th>
                    <th>販売価格</th>
                    <th>合計金額</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ordersWithTax as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->created_at }}</td>
                        <td>
                            @if ($order->items->is_active)
                                {{ $order->items->item_name }}
                            @else
                                {{ $order->items->item_name }} <span
                                    class="text-danger">（販売停止中）</span>
                            @endif
                        </td>
                        <td>{{ $order->count }}個</td>
                        <td>{{ number_format($order->salesWithTax) }}円</td>
                        <td>
                            {{ number_format($order->priceWithTax) }}円</td>
                        <td><button><a href="{{ route('admin.orders.show', $order->id) }}">詳細</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

@endsection

{{-- {{ Debugbar::log($items->toArray()) }} --}}

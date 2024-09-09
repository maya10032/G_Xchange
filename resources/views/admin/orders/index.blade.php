@extends('layouts.admin')

@section('title', '受注管理一覧')

@section('content')
    <h2>受注管理一覧画面</h2>
    {{-- 購入履歴が空だったら --}}
    @if (count($orders) == 0)
        <div class="flex item-center justify-center w-full absolute inset-0">
            <h2 class="tracking-widest text-center w-full text-3xl title-font font-light text-gray-600 mb-1">
                {{ __('noorder') }}
            </h2>
        </div>
    @else
        <div class="container mb-2" style="width: 100%;">
            <div class="d-flex justify-content-end mt-3">
                <form class="d-flex" role="search">
                    <input class="form-control me-2 border-secondary" style="width: 600px;" type="search"
                        placeholder="商品名、カテゴリ、ブランドなど" aria-label="Search">
                    <button class="btn btn-secondary" style="width: 80px;" type="submit">{{ __('search') }}</button>
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
                            @if ($order->item->is_active)
                                {{ $order->item->item_name }}
                            @else
                                {{ $order->item->item_name }} <span class="text-danger">（販売停止中）</span>
                            @endif
                        </td>
                        <td>{{ $order->count }}個</td>
                        <td>{{ number_format($order->item->tax_sales_prices) }}円</td>
                        <td>
                            {{ number_format($order->subtotal) }}円</td>
                        <td><button><a href="{{ route('admin.orders.show', $order->id) }}">詳細</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

@endsection

{{-- {{ Debugbar::log($item->toArray()) }} --}}

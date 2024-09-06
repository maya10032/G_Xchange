@extends('layouts.user')

@section('title', '購入履歴一覧')

@section('content')
    <div class="py-1 container sticky-top" style="min-height: calc(100vh - 100px);">
        <h2 class="title--border">マイページ / 購入履歴</h2>
        {{-- 購入履歴が空だったら --}}
        @if (count($orders) == 0)
            <div class="d-flex align-items-center justify-content-center w-100" style="height: 100%;">
                <h2 class="text-center text-3xl text-gray-600 mb-1">
                    {{ __('noorder') }}
                </h2>
            </div>
        @else
            @foreach ($ordersWithTax as $order)
                <div class="col-md-max">
                    <div
                        class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col-auto d-none d-lg-block">
                            <img src="{{ asset('storage/images/' . $order->item->images[$order->item->thumbnail]->img_path) }}"
                                alt="{{ $order->item->item_name }} サムネイル"
                                style="width: 250px; height: 250px; padding: 10px;">
                        </div>
                        <div class="col p-4 d-flex flex-column position-static">
                            <strong class="d-inline-block mb-2 text-primary-emphasis">
                                {{ $order->item->category->category_name }}
                            </strong>
                            @if ($order->item->is_active)
                                <h3 class="mb-0">
                                    <a href="{{ route('items.show', $order->item->id) }}" class="item-title">
                                        {{ $order->item->item_name }}
                                    </a>
                                </h3>
                            @else
                                <h3 class="mb-0">
                                    <a href="{{ route('items.show', $order->item->id) }}" class="item-title">
                                        {{ $order->item->item_name }}
                                    </a>
                                </h3>
                                <span class="text-danger">（現在販売していません）</span>
                            @endif
                            <div class="d-flex mb-1 text-body-secondary">
                                <div class="me-3">
                                    注文日：{{ $order->created_at }}
                                </div>
                                <div class="me-3">
                                    数量：{{ $order->count }}
                                </div>
                                <div>
                                    合計：{{ number_format($order->subtotal) }}円
                                </div>
                            </div>
                            <div class="d-flex text-body-secondary">
                                <a href="{{ route('orders.show', $order->id) }}"
                                    class="btn btn-secondary text-light px-3 py-2 hover-effect">詳細</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="d-flex justify-content-center my-4">
                {{ $orders->links('pagination::default') }}
            </div>
        @endif
    </div>
@endsection

{{-- {{ Debugbar::log($items->toArray()) }} --}}

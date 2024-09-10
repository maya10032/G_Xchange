@extends('layouts.user')

@section('title', 'カート一覧')

@section('content')
    <div class="py-1 container sticky-top" style="min-height: calc(100vh - 100px);">
        @if (session('cartdelete'))
            <div class="alert-red-line mb-2" style="font-size: 1.25rem;">
                {{ session('cartdelete') }}
            </div>
        @endif
        <h2 class="title--border">マイページ / カート一覧</h2>
        @if ($carts->isEmpty())
            <p>カートに商品がありません。</p>
        @else
            <div class="row">
                <div class="col-md-8">
                    @foreach ($carts as $cart)
                        <div class="col-md-max">
                            <div
                                class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                                <div class="col-auto d-none d-lg-block">
                                    <img src="{{ asset('storage/images/' . $cart->item->images[$cart->item->thumbnail]->img_path) }}"
                                        alt="{{ $cart->item->item_name }} サムネイル"
                                        style="width: 250px; height: 250px; padding: 10px;">
                                </div>
                                <div class="col p-4 d-flex flex-column position-static">
                                    <strong class="d-inline-block mb-2 text-primary-emphasis">
                                        {{ $cart->item->category->category_name }}
                                    </strong>
                                    @if ($cart->item->is_active)
                                        <h3 class="mb-0">
                                            <a href="{{ route('items.show', $cart->item->id) }}" class="item-title">
                                                {{ $cart->item->item_name }}
                                            </a>
                                        </h3>
                                    @else
                                        <h3 class="mb-0">
                                            <a href="{{ route('items.show', $cart->item->id) }}" class="item-title">
                                                {{ $cart->item->item_name }}
                                            </a>
                                        </h3>
                                        <span class="text-danger">
                                            <h3>（現在販売していません）</h3>
                                        </span>
                                    @endif
                                    <div class="d-flex mb-1 text-body-secondary">
                                        <div class="me-3">
                                            追加日：{{ $cart->created_at }}
                                        </div>
                                    </div>
                                    <div class="d-flex mb-1">
                                        <div class="me-3">
                                            数量：{{ $cart->count }}
                                        </div>
                                        <div class="me-4">
                                            × {{ number_format($cart->item->sales_price) }}円
                                        </div>
                                        <div class="me-3">
                                            合計：{{ number_format($cart->subtotal) }}円
                                        </div>
                                        <div class="me-3">
                                            <div class="me-3 d-flex align-items-center">
                                                <span class="text-muted">|</span>
                                                <form action="{{ route('carts.destroy', $cart->id) }}" method="post"
                                                    style="display: inline; margin-left: 5px;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link p-0 text-muted delete-link"
                                                        style="text-decoration: none; font-weight: normal;">{{ __('delete') }}</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="d-flex justify-content-center my-4">
                        {{ $carts->links() }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm d-flex flex-column justify-content-between">
                        <div class="card-body flex-grow-1">
                            <div class="d-flex text-body-secondary mb-2">
                                <div class="me-3">
                                    小計：{{ $cartCount }}個の商品
                                </div>
                            </div>
                            <div class="d-flex text-body-secondary mb-2">
                                <div class="me-3">
                                    手数料：0円
                                </div>
                            </div>
                            <div class="d-flex text-body-secondary mb-2">
                                <div class="me-3">
                                    送料：0円
                                </div>
                            </div>
                            <h3 class="card-title mt-">合計：{{ number_format($total) }} 円 （税込）</h3>
                            <form action="{{ route('orders.store') }}" method="POST" class="mt-auto">
                                @csrf
                                <button type="submit" name="action" value="allbuy"
                                    class="btn btn-danger w-100 mt-2">まとめて購入する</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

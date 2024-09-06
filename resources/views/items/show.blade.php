@extends('layouts.app')

@section('title', '商品詳細')

@section('content')
<div class="py-5 container sticky-top" style="min-height: calc(180vh - 180px);">
        @if (session('likeadd'))
            <div class="alert alert-success text-center fw-bold" style="font-size: 1.25rem;">
                {{ session('likeadd') }}
            </div>
        @elseif (session('likedelete'))
            <div class="alert alert-info text-center fw-bold" style="font-size: 1.25rem;">
                {{ session('likedelete') }}
            </div>
        @elseif (session('cartadd'))
            <div class="alert alert-info text-center fw-bold" style="font-size: 1.25rem;">
                {{ session('cartadd') }}
            </div>
        @endif
        <div class="d-flex">
            <div class="d-flex flex-column me-2 mb-0 reduce-margin" style="flex: 1.4;">
                {{-- サムネイルとその他の画像を横並びにするためにd-flexを使用 --}}
                <div class="d-flex">
                    {{-- サムネイル画像 --}}
                    <div class="mb-2 me-3" style="max-height: 465px;">
                        <img src="{{ asset('storage/images/' . $item->images[$item->thumbnail]->img_path) }}"
                            alt="Thumbnail" class="img-fluid rounded"
                            style="width: 465px; height: auto; object-fit: cover; max-height: 465px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);">
                    </div>
                    {{-- その他の3つの画像を縦一列に配置 --}}
                    <div class="d-flex flex-column">
                        @foreach ($item->images as $index => $image)
                            @if ($index !== $item->thumbnail)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/images/' . $image->img_path) }}" alt="Image"
                                        class="img-fluid rounded" style="width: 148px; height: 148px; object-fit: cover; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);">
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="ms-auto" style="flex: 1; font-size: 1.25rem;">
                <p class="mb-2"><small class="text-muted">{{ $item->category->category_name }}</small></p>
                <h3 class="mb-3" style="font-size: 1.75rem; word-break: break-word;">{{ $item->item_name }}</h3>
                @if ($item->regular_price === $item->sales_price)
                    <p class="mb-3">{{ number_format($salesPriceWithTax) }}円（税込）送料無料</p>
                @else
                    <strike class="d-block mb-3" style="font-size: 1.5rem;">{{ number_format($item->tax_regular_prices) }}円
                        <span class="badge bg-danger ms-2" style="position: relative; top: -5px;">SALE</span>
                    </strike>
                    <p class="h4 text-danger fw-bold mb-3">{{ number_format($item->tax_sales_prices) }} 円（税込）送料無料</p>
                @endif
                @if (auth()->guest())
                    <div>
                        <a href="{{ url('login/') }}" class="btn btn-secondary" style="font-size: 1.25rem;">購入するにはログインしてください</a>
                    </div>
                @else
                    @if ($item->is_active)
                        <form action="{{ url('/purchase', $item->id) }}" method="POST" novalidate>
                            @csrf
                            <div  class="mb-3" style="font-size: 1.25rem;">
                                数量：<input type="number" name="count" min="1" max="{{ $item->count_limit }}"
                                    value="{{ old('count', 1) }}" >
                                <small>　（一度に購入できるのは{{ $item->count_limit }}個までです。）</small>
                                @foreach ($errors->all() as $error)
                                    <p  class="h4 text-danger fw-bold m-3">※{{ $error }}</p>
                                @endforeach
                            </div>
                            <div class="d-grid gap-1 col-6 align-items-center">
                                <input type="hidden" name="item_id" value="{{ $item->id }}">
                                <button type="submit" name="action" value="cart" class="btn btn-secondary mb-2"
                                    style="font-size: 1.25rem;">カートに追加</button>
                                <button type="submit" name="action" value="purchase" class="btn btn-danger mb-2"
                                    style="font-size: 1.25rem;">購入ページへ</button>
                            </div>
                        </form>
                        @if (Auth::user()->isLike($item->id))
                            <form action="{{ route('likes.destroy') }}" method="post" class="mt-2">
                                @csrf
                                @method('delete')
                                <div class="d-grid gap-2 col-6 align-items-center">
                                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                                    <button class="btn btn-outline-danger" style="font-size: 1.25rem;"><i
                                            class="fa fa-heart-o"></i> {{ __('like') . __('delete') }}</button>
                                </div>
                            </form>
                        @else
                            <form action="{{ route('likes.store') }}" method="post" class="mt-2">
                                @csrf
                                <div class="d-grid gap-2 col-6 align-items-center">
                                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                                    <button class="btn btn-outline-danger" style="font-size: 1.25rem;"><i
                                            class="fa fa-heart"></i> {{ __('like') . __('create') }}</button>
                                </div>
                            </form>
                        @endif
                    @else
                        <h3 class="text-danger mt-4" style="font-size: 1.75rem;">現在販売していません</h3>
                    @endif
                @endif
                <p class="mt-3">
                    <a class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                        href="{{ url('/') }}">商品一覧へ戻る</a>
                </p>
            </div>
        </div>
        <div class="mt-4" style="font-size: 1.25rem; text-align: left; max-width: 550px;">
            <h3 class="mb-3" style="font-size: 1.75rem;"><i class="fa fa-shopping-bag"></i>　商品説明</h3>
            <p>{{ $item->message }}</p>
        </div>
    </div>
@endsection

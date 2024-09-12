@extends('layouts.main')

@section('title', '商品一覧')

@section('content')
    <div class="py-2 container sticky-top">
        <div class="d-flex">
            <h2 class="fw-bold title--border">商品一覧</h2>
            <div class="container" style="width: 50%;">
                <form class="d-flex mt-3" role="search" method="GET" action="{{ route('items.search') }}">
                    <input class="form-control me-2 border-secondary" type="search" name="search"
                        placeholder="商品名、カテゴリ、ブランドなど" aria-label="Search" value="{{ old('search', $query ?? '') }}">
                    <button class="btn btn-secondary btn-secondary" style="width: 80px;" type="submit"><i
                            class="fa fa-search" aria-hidden="true"></i> {{ __('search') }}</button>
                </form>
            </div>
        </div>
        @if (isset($query))
            @if ($items->isEmpty())
                <h3>検索結果: {{ $query }} に該当する商品はありませんでした。</h3>
            @else
                <h3>検索結果: ”{{ $query }}”</h3>
            @endif
        @endif
        <div class="row row-cols- row-cols-sm-2 row-cols-md-5 g-3 mb-4">
            @foreach ($items as $item)
                <div class="col">
                    <div class="card shadow-sm hover-effect">
                        <img alt="ecommerce" class="object-cover object-center w-full h-full block"
                            src="{{ asset('storage/images/' . $item->images[$item->thumbnail]->img_path) }}" alt="サムネイル"
                            style="width: 100%; height: 220px;"
                            onclick="window.location='{{ route('items.show', $item->id) }}'">
                        <div class="card-body" style="height: 150px;">
                            <h4 class="text-gray-900 title-font text-lg font-medium text-truncate"
                                onclick="window.location='{{ route('items.show', $item->id) }}'">{{ $item->item_name }}</h4>
                            <p class="card-text text-truncate">{{ $item->message }}
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="position-absolute bottom-0 start-0 m-2">
                                    @if ($item->tax_regular_prices === $item->tax_sales_prices)
                                        <p>{{ number_format($item->tax_sales_prices) }}円（税込）送料無料</p>
                                    @else
                                        {{-- 割引中の表示 --}}
                                        <p class="h5" style="margin: 0; line-height: 1.2;">
                                            <del>{{ number_format($item->tax_regular_prices) }}円</del>
                                            <span class="badge bg-danger ms-2"
                                                style="position: relative; top: -5px;">SALE</span>
                                        </p>
                                        <p class="h5 text-danger fw-bold">{{ number_format($item->tax_sales_prices) }}
                                            円（税込）送料無料
                                        </p>
                                    @endif
                                </div>
                                <small class="text-body-secondary"></small>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <h2 class="fw-bold title--border">注目されている商品</h2>
        <div class="row row-cols- row-cols-sm-2 row-cols-md-5 g-3">
            @foreach ($viewItems as $viewItem)
                <div class="col">
                    <div class="card shadow-sm hover-effect">
                        <img alt="ecommerce" class="object-cover object-center w-full h-full block"
                            src="{{ asset('storage/images/' . $viewItem->images[$viewItem->thumbnail]->img_path) }}"
                            alt="サムネイル" style="width: 100%; height: 220px;"
                            onclick="window.location='{{ route('items.show', $viewItem->id) }}'">
                        <div class="card-body" style="height: 150px;">
                            <h4 class="text-gray-900 title-font text-lg font-medium text-truncate"
                                onclick="window.location='{{ route('items.show', $viewItem->id) }}'">
                                {{ $viewItem->item_name }}</h4>
                            <p class="card-text text-truncate">{{ $viewItem->message }}
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="position-absolute bottom-0 start-0 m-2">
                                    @if ($viewItem->tax_regular_prices === $viewItem->tax_sales_prices)
                                        <p>{{ number_format($viewItem->tax_sales_prices) }}円（税込）送料無料</p>
                                    @else
                                        <p class="h5" style="margin: 0; line-height: 1.2;">
                                            <del>{{ number_format($viewItem->tax_regular_prices) }}円</del>
                                            <span class="badge bg-danger ms-2"
                                                style="position: relative; top: -5px;">SALE</span>
                                        </p>
                                        <p class="h5 text-danger fw-bold">{{ number_format($viewItem->tax_sales_prices) }}
                                            円（税込）送料無料
                                        </p>
                                    @endif
                                </div>
                                <small class="text-body-secondary"></small>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center" style="padding-top: 30px;">
            {{ $items->links('pagination::default') }}
        </div>
    </div>
@endsection

{{ Debugbar::log($items->toArray()) }}

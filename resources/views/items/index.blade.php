@extends('layouts.main')

@section('title', '商品一覧')

@section('content')
    <div class="py-1 container sticky-top" style="min-height: calc(100vh - 100px);">
        <h2 class="fw-bold title--border">商品一覧</h2>
        <div class="row row-cols- row-cols-sm-2 row-cols-md-4 g-4">
            @foreach ($items as $item)
                <div class="col">
                    <div class="card shadow-sm hover-effect">
                        <img alt="ecommerce" class="object-cover object-center w-full h-full block"
                            src="{{ asset('storage/images/' . $item->images[$item->thumbnail]->img_path) }}" alt="サムネイル"
                            style="width: 100%; height: 225px;">
                        <div class="card-body" style="height: 220px;">
                            <h4 class="text-gray-900 title-font text-lg font-medium"
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
        <div class="d-flex justify-content-center my-4">
            {{ $items->links() }}
        </div>
    </div>
@endsection

{{ Debugbar::log($items->toArray()) }}

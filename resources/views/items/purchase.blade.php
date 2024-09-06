@extends('layouts.app')

@section('title', '購入内容確認')

@section('content')
    <div class="py-5 container sticky-top" style="min-height: calc(180vh - 180px);">
        <h2><span class="text-danger fw-bold text-center ms-5">※内容をご確認の上、購入するを押してください。</span></h2>
        <div class="d-flex">
            <div class="d-flex flex-column me-2 mb-0 reduce-margin" style="flex: 1.4;">
                {{-- サムネイルとその他の画像を横並びにするためにd-flexを使用 --}}
                <div class="d-flex">
                    {{-- サムネイル画像 --}}
                    <div class="mb-2 me-3" style="max-height: 465px;">
                        <img src="{{ asset('storage/images/' . $item->images[$item->thumbnail]->img_path) }}" alt="Thumbnail"
                            class="img-fluid rounded"
                            style="width: 465px; height: auto; object-fit: cover; max-height: 465px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);">
                    </div>
                    {{-- その他の3つの画像を縦一列に配置 --}}
                    <div class="d-flex flex-column">
                        @foreach ($item->images as $index => $image)
                            @if ($index !== $item->thumbnail)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/images/' . $image->img_path) }}" alt="Image"
                                        class="img-fluid rounded"
                                        style="width: 148px; height: 148px; object-fit: cover; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);">
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <form action="{{ route('orders.store') }}" method="POST" style="flex: 1;">
                @csrf
                <div style="flex: 1; font-size: 1.25rem;">
                    <p class="mb-2"><small class="text-muted">{{ $item->category->category_name }}</small></p>
                    <h3 class="mb-3" style="font-size: 1.75rem; word-break: break-word;">{{ $item->item_name }}</h3>
                    @if ($item->tax_regular_prices === $item->sales_price)
                        <p class="mb-3">{{ number_format($item->tax_sales_prices * $count) }}円（税込）送料無料</p>
                    @else
                        <strike class="d-block mb-3"
                            style="font-size: 1.5rem;">{{ number_format($item->tax_regular_prices) }}円
                            <span class="badge bg-danger ms-2" style="position: relative; top: -5px;">SALE</span>
                        </strike>
                        <p class="h4 text-danger fw-bold mb-3">{{ number_format($item->tax_sales_prices * $count) }} 円（税込）送料無料</p>
                    @endif
                    @if ($item->is_active)
                        <div class="mb-3" style="font-size: 1.25rem;">
                            数量：{{ $count }}
                        </div>
                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                        <input type="hidden" name="count" value="{{ $count }}">
                        <div class="d-grid gap-1 col-6 align-items-center">
                            <input type="hidden" name="item_id" value="{{ $item->id }}">
                            <button type="submit" class="btn btn-danger mb-2" style="font-size: 1.25rem;">購入する</button>
                        </div>
                        <div class="d-grid gap-1 col-6 align-items-center">
                            <a href="{{ route('items.show', $item->id) }}"
                                class="btn btn-secondary text-light px-4 py-2 hover-effect">キャンセル</a>
                        </div>
                    @else
                        <h3 class="text-danger mt-4" style="font-size: 1.75rem;">現在販売していません</h3>
                    @endif
                </div>
            </form>
        </div>
        <div class="mt-4" style="font-size: 1.25rem; text-align: left; max-width: 550px;">
            <h3 class="mb-3" style="font-size: 1.75rem;">商品説明</h3>
            <p>{{ $item->message }}</p>
        </div>
    </div>
@endsection

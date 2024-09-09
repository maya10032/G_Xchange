@extends('layouts.admin')

@section('title', '商品詳細')

@section('content')
    <topnav>
        <ul>
            <li><a class="current" href="{{ url('admin/items') }}">商品一覧</a></li>
            <li><a class="current" href="{{ route('admin.items.show', ['item' => $item->id]) }}">商品詳細</a></li>
        </ul>
    </topnav>
    <h2 class="py-2 admin">プレビュー</h2>
    <h5 class="py-2 admin">ユーザには以下のように表示されます。</h5>
    <div class="d-flex">
        <div class="d-flex flex-column me-2 mb-0 reduce-margin" style="flex: 1.1;">
            {{-- サムネイルとその他の画像を横並びにするためにd-flexを使用 --}}
            <div class="d-flex">
                {{-- サムネイル画像 --}}
                <div class="mb-2 me-3" style="max-height: 465px;">
                    <img src="{{ asset('storage/images/' . $item->images[$item->thumbnail]->img_path) }}" alt="Thumbnail"
                        class="img-fluid rounded"
                        style="width: 460px; height: 460px; object-fit: cover; max-height: 465px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);">
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
        <div class="ms-auto" style="flex: 1; font-size: 1.25rem;">
            <p class="mb-2"><small class="text-muted"><i class="fa fa-tag" aria-hidden="true"></i>
                    {{ $item->category->category_name }}</small></p>
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
                    <div class="mb-3" style="font-size: 1.25rem;">
                        数量：<input disabled type="number" name="count" min="1" max="{{ $item->count_limit }}"
                            value="{{ old('count', 1) }}">
                        <small> （一度に購入できるのは{{ $item->count_limit }}個までです。）</small>
                        @foreach ($errors->all() as $error)
                            <p class="h4 text-danger fw-bold m-3">※{{ $error }}</p>
                        @endforeach
                    </div>
                    <div class="d-grid gap-1 col-6 align-items-center">
                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                        <button type="submit" name="action" value="cart" class="btn btn-secondary mb-2"
                            style="font-size: 1.25rem;">カートに追加</button>
                        <button type="submit" name="action" value="purchase" class="btn btn-danger mb-2"
                            style="font-size: 1.25rem;">購入ページへ</button>
                    </div>
                @else
                    <h3 class="text-danger mt-4" style="font-size: 1.75rem;">現在販売していません</h3>
                @endif
            @endif
            <p class="mt-3">
                <a class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                    href="{{ route('admin.items.index') }}">商品一覧へ戻る</a>
            </p>
        </div>
    </div>
    <div class="mt-4" style="font-size: 1.25rem; text-align: left; max-width: 550px;">
        <h3 class="mb-3" style="font-size: 1.75rem;"><i class="fa fa-shopping-bag"></i> 商品説明</h3>
        <p>{{ $item->message }}</p>
    </div>
@endsection

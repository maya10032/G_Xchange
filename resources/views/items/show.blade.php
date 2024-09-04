@extends('layouts.app')

@section('title', '商品詳細')

@section('content')
    <div class="py-3 container sticky-top" style="min-height: calc(100vh - 100px);">
        <h2 class="mb-4" style="font-size: 2rem;">商品詳細ページ</h2>

        {{-- お気に入り通知 --}}
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

        <div class="mb-2 d-flex flex-wrap">
            <!-- 画像を左側に配置 -->
            <div class="d-flex flex-wrap" style="max-width: 400px;">
                @foreach ($item->images as $image)
                    <div class="col-6 p-1">
                        <img src="{{ asset('storage/images/' . $image->img_path) }}" alt="Image"
                            class="img-fluid rounded" style="height: 200px; object-fit: cover;">
                    </div>
                @endforeach
            </div>
            <!-- 説明を右側に配置 -->
            <div class="ms-4" style="flex-grow: 1; font-size: 1.25rem;">
                <p class="mb-2"><small class="text-muted">カテゴリー：{{ $item->category_id }}</small></p>
                <h3 class="mb-3" style="font-size: 1.75rem;">商品名：{{ $item->item_name }}</h3>
                @if ($item->regular_price === $item->sales_price)
                    <p class="mb-3">{{ number_format($salesPriceWithTax) }}円（税込）送料無料</p>
                @else
                    <strike class="d-block mb-3" style="font-size: 1.5rem;">{{ number_format($regularPriceWithTax) }}円
                        <span class="badge bg-danger ms-2" style="position: relative; top: -5px;">SALE</span>
                    </strike>
                    <p class="h4 text-danger fw-bold mb-3">{{ number_format($salesPriceWithTax) }} 円（税込）送料無料</p>
                @endif

                @if (auth()->guest())
                    <div>
                        <a href="{{ url('login/') }}" style="font-size: 1.25rem;">購入するにはログインしてください</a>
                    </div>
                @else
                    @if ($item->is_active)
                        <form action="{{ url('/purchase', $item->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                数量：<input type="number" name="count" min="1" max="$item->count_limit"
                                    value="{{ old('count', 1) }}" style="font-size: 1.25rem;">
                                <p class="mb-2">※一度に購入できるのは{{ $item->count_limit }}個までです。</p>
                                @foreach ($errors->all() as $error)
                                    <p class="mb-2">※{{ $error }}</p>
                                @endforeach
                            </div>
                            <div class="d-grid gap-2 col-4">
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
                                <div class="d-grid gap-2 col-4">
                                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                                    <button class="btn btn-outline-danger" style="font-size: 1.25rem;"><i
                                            class="fa fa-heart-o"></i> {{ __('like') . __('delete') }}</button>
                                </div>
                            </form>
                        @else
                            <form action="{{ route('likes.store') }}" method="post" class="mt-2">
                                @csrf
                                <div class="d-grid gap-2 col-4">
                                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                                    <button class="btn btn-outline-danger" style="font-size: 1.25rem;"><i
                                            class="fa fa-heart-o"></i> {{ __('like') . __('create') }}</button>
                                </div>
                            </form>
                        @endif
                    @else
                        <h3 class="text-danger mt-4" style="font-size: 1.75rem;">現在販売していません</h3>
                    @endif
                    @endif
                </div>
            </div>

            <h3 class="mb-3" style="font-size: 1.75rem;">商品説明：</h3>
            <p>{{ $item->message }}</p>
            {{-- <div class="pull-right mt-4">
                <a class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                    href="{{ url('/') }}" style="font-size: 1.25rem;">商品一覧に戻る ＞</a>
            </div> --}}
        </div>
@endsection

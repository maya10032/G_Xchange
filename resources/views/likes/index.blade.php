@extends('layouts.user')

@section('title', '商品詳細')

@section('content')
    <div class="py-1 container sticky-top" style="min-height: calc(100vh - 100px);">
        @if (session('likedelete'))
            <div class="alert-red-line mb-2" style="font-size: 1.25rem;">
                {{ session('likedelete') }}
            </div>
        @endif
        <h2 class="title--border">マイページ / お気に入り</h2>
        {{-- お気に入りが空だったら --}}
        @if (count($items) == 0)
            <div class="flex items-center justify-center w-full absolute inset-0">
                <h2 class="tracking-widest text-center w-full text-3xl title-font font-light text-gray-600 mb-1">
                    {{ __('nolike') }}
                </h2>
            </div>
        @else
            @foreach ($items as $item)
                <div class="col-md-max">
                    <div
                        class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col-auto d-none d-lg-block">
                            <img src="{{ asset('storage/images/' . $item->images[$item->thumbnail]->img_path) }}"
                                alt="{{ $item->item_name }} サムネイル" style="width: 250px; height: 250px; padding: 10px;">
                        </div>
                        <div class="col p-4 d-flex flex-column position-static">
                            <strong class="d-inline-block mb-2 text-primary-emphasis">
                                {{ $item->category->category_name }}
                            </strong>
                            @if ($item->is_active)
                                <h3 class="mb-0">
                                    <a href="{{ route('items.show', $item->id) }}" class="item-title">
                                        {{ $item->item_name }}
                                    </a>
                                </h3>
                            @else
                                <h3 class="mb-0">
                                    <a href="{{ route('items.show', $item->id) }}" class="item-title">
                                        {{ $item->item_name }}
                                    </a>
                                </h3>
                                <span class="text-danger">（現在販売していません）</span>
                            @endif
                            <form action="{{ route('likes.destroy') }}" method="post">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="item_id" value="{{ $item->id }}">
                                <div class="py-2"><button
                                        class="btn btn-secondary text-light px-4 py-2 hover-effect">{{ __('like') . __('delete') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection

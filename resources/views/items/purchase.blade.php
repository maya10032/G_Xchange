@extends('layouts.app')

@section('title', '購入内容確認')

@section('content')
    <h2>購入内容確認</h2>
    <h2>※内容をご確認の上、購入するを押してください。</h2>
    <tbody>
        <p>カテゴリー：{{ $item->category_id }}</p>
        <p>商品名：{{ $item->item_name }}</p>
        <form action="{{ route('items.show', ['item' => $item->id]) }}" method="POST">
            <div>
                数量：<input type="number" min="1" max="{{ $item->count_limit }}" name="count"
                    value="{{ old('count') }}">
            </div>
            <input type="hidden" name="showMessage" value="1">
            <button type="submit">購入する</button>
        </form>
    </tbody>
    <a href="{{ route('items.show', $item->id)  }}">キャンセル</a>
@endsection

{{-- {{ Debugbar::log($items->toArray()) }} --}}

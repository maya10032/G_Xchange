@extends('layouts.app')

@section('title', 'カート一覧')

@section('content')
    <h2>カート一覧</h2>
    @if($carts->isEmpty())
        <p>カートに商品がありません。</p>
    @else
        <ul>
            @foreach($carts as $cart)
                <li>商品：{{ $cart->cart_name }}</li>
                <li>数量：{{ $cart->count }} 個</li>
                <li>金額：{{ $cart->sales_price * $cart->count }} 円</商品></li>
            @endforeach
        </ul>
        {{-- <a href="{{ route('purchase.confirm') }}">購入へ進む</a> --}}
    @endif
@endsection

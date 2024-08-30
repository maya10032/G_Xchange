@extends('layouts.app')

@section('title', 'カート一覧')

@section('content')
    <h2>カート一覧</h2>
    @if ($carts->isEmpty())
        <p>カートに商品がありません。</p>
    @else
        @php
            $total = 0;
        @endphp
        @foreach ($carts as $cart)
            @php
                $subtotal = $cart->item->sales_price * $cart->count;
                $total += $subtotal;
            @endphp
            <tbody>
                <table>
                    <tr>
                        <td>商品名：<a href="{{ route('items.show', $cart->item->id) }}">{{ $cart->item->item_name }}</td>
                        <td>数量：{{ $cart->count }} 個</td>
                        <td>金額：{{ $subtotal }} 円</td>
                    </tr>
                </table>
            </tbody>
        @endforeach
        <h3>合計金額：{{ $total }} 円</h3>
        <button type="submit">まとめて購入する</button>
    @endif
@endsection

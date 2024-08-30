@extends('layouts.app')

@section('title', 'カート一覧')

@section('content')
    <h2>カート一覧</h2>
    @if ($carts->isEmpty())
        <p>カートに商品がありません。</p>
    @else
        <tbody>
            @if (session('success'))
                <div class="alert alert-info text-center fw-bold">
                    {{ session('success') }}
                </div>
            @endif
            @php
                $total = 0;
            @endphp
            @foreach ($carts as $cart)
                @php
                    $subtotal = $cart->item->sales_price * $cart->count; // 小計
                    $taxRate = config('tax.rate');  // 税率10%
                    $priceWithTax = $subtotal * (1 + $taxRate); // 小計税込み
                    $total += $priceWithTax; // 合計
                @endphp
                <table>
                    <tr>
                        <td>商品名：<a href="{{ route('items.show', $cart->item->id) }}">{{ $cart->item->item_name }}</td>
                        <td>数量：{{ $cart->count }} 個</td>
                        <td>金額：{{ number_format($priceWithTax) }} 円（税込）</td>
                        <td>
                            <form action="{{ route('carts.destroy', $cart->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="item_id" value="{{ $cart->item->id }}">
                                <button>{{ __('delete') }}</button>
                            </form>
                        </td>
                    </tr>
                </table>
            @endforeach
            <h3>合計金額：{{ number_format($total) }} 円（税込）</h3>
            <button type="submit">まとめて購入する</button>
        </tbody>
    @endif
@endsection

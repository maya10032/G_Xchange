@extends('layouts.app')

@section('title', 'カート一覧')

@section('content')
    <h2>カート一覧</h2>
    @if ($carts->isEmpty())
        <p>カートに商品がありません。</p>
    @else
        <tbody>
            @if (session('deleted'))
                <div class="alert alert-info text-center fw-bold">
                    {{ session('deleted') }}
                </div>
            @endif
            <table>
                <thead>
                    <tr>
                        <th>商品名</th>
                        <th>数量</th>
                        <th>小計</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carts as $cart)
                        <tr>
                            <td><a href="{{ route('items.show', $cart->item->id) }}">{{ $cart->item->item_name }}</td>
                            <td>{{ $cart->count }} 個</td>
                            <td>{{ number_format($cart->item->sales_price * $cart->count * (1 + config('tax.rate', 0.1))) }}
                                円（税込）</td>
                            <td>
                                <form action="{{ route('carts.destroy', $cart->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit">{{ __('delete') }}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <h3>合計金額：{{ number_format($total) }} 円（税込）</h3>
            <form action="{{ route('orders.store') }}" method="POST">
                @csrf
                <button type="submit" name="action" value="allbuy">まとめて購入する</button>
            </form>
        </tbody>
    @endif
@endsection

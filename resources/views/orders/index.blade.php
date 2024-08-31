@extends('layouts.user')

@section('title', '購入履歴一覧')

@section('content')
    <h1>購入履歴一覧画面（マイページ）</h1>
    {{-- 購入履歴が空だったら --}}
    @if (count($orders) == 0)
        <div class="flex items-center justify-center w-full absolute inset-0">
            <h2 class="tracking-widest text-center w-full text-3xl title-font font-light text-gray-600 mb-1">
                {{ __('noorder') }}
            </h2>
        </div>
    @else
        <table>
            <tbody>
                @foreach ($ordersWithTax as $order)
                    <tr>
                        <th>注文番号：</th>
                        <td style="color: red">{{ $order->id }}</td>
                        <th>商品名：</th>
                        <td><a href="{{ route('items.show', $order->item->id) }}">{{ $order->item->item_name }}
                        <th>注文日：</th>
                        <td style="color: red">{{ $order->created_at }}</td>
                        <th>数量：</th>
                        <td style="color: red">{{ $order->count }}個</td>
                        <th>合計金額：</th>
                        <td style="color: red">
                            {{ number_format($order->priceWithTax) }}円</td>
                        <td><button>詳細</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

@endsection

{{-- {{ Debugbar::log($items->toArray()) }} --}}

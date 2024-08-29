@extends('layouts.app')

@section('title', '購入履歴一覧')

@section('content')
    <h1>購入履歴一覧画面（マイページ）</h1>
    <section class="text-gray-600 body-font">
        <div class="flex flex-wrap -m-4">
            {{-- 購入履歴が空だったら --}}
            @if (count($items) == 0)
                <div class="flex items-center justify-center w-full absolute inset-0">
                    <h2 class="tracking-widest text-center w-full text-3xl title-font font-light text-gray-600 mb-1">
                        {{ __('noorder') }}
                    </h2>
                </div>
            @else
                <table>
                    <div>
                        <table>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td><a href="{{ route('items.show', $item->id) }}">{{ $item->item_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>注文日:<span style="color: red">{{ $item->created_at }}</span></td>
                                        <td>注文番号:<span style="color: red">{{ $item->id }}</span></td>
                                        <td>合計:円</td>
                                    </tr>
                                    <tr>
                                        <td><a href="{{ route('items.show', $item->id) }}">詳細</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </table>
            @endif
        </div>
    </section>

@endsection

{{-- {{ Debugbar::log($items->toArray()) }} --}}

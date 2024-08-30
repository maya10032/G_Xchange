@extends('layouts.app')

@section('title', '会員情報変更')

@section('content')
    <h2>会員情報変更画面</h2>

    <a href="{{ url('/') }}">商品一覧に戻る</a>
@endsection

{{-- {{ Debugbar::log($items->toArray()) }} --}}

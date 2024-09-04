@extends('layouts.app')

@section('title', '購入完了')

@section('content')
    <main class="py-1 container sticky-top" style="min-height: calc(100vh - 100px);">

        <h2>購入完了画面</h2>
        <h3>ご購入ありがとうございました。</h3>
        <a href="{{ url('/') }}">商品一覧へ戻る</a>
    </main>
    @endsection

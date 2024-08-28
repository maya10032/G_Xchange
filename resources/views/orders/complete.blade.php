@extends('layouts.app')

@section('title', '購入完了')

@section('content')
<h2>購入完了画面</h2>
<h3>ご購入ありがとうございました。</h3>
<a href="{{ url('/') }}">商品一覧へ戻る</a>
@endsection

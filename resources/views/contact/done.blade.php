@extends('layouts.app')

@section('title', '送信完了')

@section('content')
<h2>送信完了画面</h2>
<h3>お問い合わせありがとうございました。</h3>
<a href="{{ url('/') }}">商品一覧へ戻る</a>
@endsection

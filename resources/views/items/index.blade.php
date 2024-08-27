@extends('layouts.app')
<!-- 1行で指定することも可能 -->
@section('title', '商品一覧')

@section('content')
<h2>商品一覧ページです</h2>
@endsection

{{-- {{ Debugbar::log($items->toArray()) }} --}}

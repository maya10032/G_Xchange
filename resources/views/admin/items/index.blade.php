@extends('layouts.admin')

@section('title', '商品一覧画面')

@section('content')
<a href="{{ url('admin/items') }}">商品一覧</a>
    @if (session('success'))
        <div class="alert alert-success text-center fw-bold">
            {{ session('success') }}
        </div>
    @elseif (session('update'))
        <div class="alert alert-info text-center fw-bold">
            {{ session('update') }}
        </div>
    @endif
    <h2>（管理者）商品一覧ページ</h2>
    <table class="table table-bordered table-striped task-table table-hover">
        <thead>
            <tr>
                <th>商品ID</th>
                <th>商品名</th>
                <th>商品コード</th>
                <th>商品カテゴリー</th>
                <th>最大注文数</th>
                <th>商品画像</th>
                <th>販売価格</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td><a href="{{ route('admin.items.show', ['item' => $item->id]) }}">{{ $item->item_name }}</a></td>
                    <td>{{ $item->item_code }}</td>
                    <td>{{ $item->category_id }}</td>
                    <td>{{ $item->count_limit }}</td>
                    <td>商品画像</td>
                    <td>{{ $item->sales_price }}円</td>
                    <td><a href="{{ route('admin.items.edit', ['item' => $item->id]) }}" class="btn btn-primary">編集</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>


@endsection

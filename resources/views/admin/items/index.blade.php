@extends('layouts.admin')

@section('title', '商品一覧画面')

@section('content')
    <a href="{{ url('admin/items') }}">商品一覧</a>
    @if (session('attention'))
        <div class="alert alert-danger">
            {{ session('attention') }}
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
                <th>販売状況</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($itemsWithTax as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td><a href="{{ route('admin.items.show', ['item' => $item->id]) }}">{{ $item->item_name }}</a></td>
                    <td>{{ $item->item_code }}</td>
                    <td>{{ $item->category->category_name }}</td>
                    <td>{{ $item->count_limit }}</td>
                    <td>商品画像</td>
                    <td>{{ number_format($item->subtotal) }}円</td>
                    <td>{{ $item->state }}</td>
                    <td><a href="{{ route('admin.items.edit', ['item' => $item->id]) }}" class="btn btn-primary">編集</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


@endsection

@extends('layouts.admin')

@section('title', '登録内容確認')
@section('content')
    <a href="{{ url('admin/items') }}">商品一覧</a> ＞<a href="{{ url('admin/items/create') }}">新規商品登録</a>

    <h2>確認画面</h2>
    <form action="{{ route('admin.items.store') }}" method="POST">
        @csrf
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <table class="table">
            <tr>
                <td>商品コード</td>
                <td>{{ $item_data['item_code'] }}</td>
            </tr>
            <tr>
                <td>商品名</td>
                <td>{{ $item_data['item_name'] }}</td>
            </tr>
            <tr>
                <td>カテゴリー</td>
                <td>{{ $categories->firstWhere('id', $item_data['category_id'])->category_name }}</td>
            </tr>
            <tr>
                <td>最大注文数</td>
                <td>{{ $item_data['count_limit'] }}</td>
            </tr>
            <tr>
                <td>販売価格</td>
                <td>{{ $item_data['sales_price'] }}</td>
            </tr>
            <tr>
                <td>通常価格</td>
                <td>{{ $item_data['regular_price'] }}</td>
            </tr>
            <tr>
                <td>画像</td>
                <td>
                    @foreach ($item_data['file_paths'] as $index => $filePath)
                        <div>
                            <img src="{{ asset('storage/' . $filePath) }}" alt="Image {{ $index }}">
                            @if ($index == $item_data['thumbnail'])
                                <span>サムネイル</span>
                            @endif
                        </div>
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>商品説明</td>
                <td>{!! nl2br(e($item_data['message'])) !!}</td>
            </tr>
        </table>
        <button type="submit" class="btn btn-primary">登録</button>
        <a href="{{ route('admin.items.create') }}" class="btn btn-secondary">戻る</a>
    </form>
@endsection

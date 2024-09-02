@extends('layouts.admin')

@section('title', '登録内容確認')
@section('content')
    <a href="{{ url('admin/items') }}">商品一覧</a> ＞<a href="{{ url('admin/items/create') }}">新規商品登録</a>

    <h2>確認画面</h2>
    <form action="{{ route('admin.items.store') }}" method="POST" novalidate>
        @csrf
        <table class="table">
            <tr>
                <td>商品コード</td>
                <td>{{ $input['item_code'] }}</td>
            </tr>
            <tr>
                <td>商品名</td>
                <td>{{ $input['item_name'] }}</td>
            </tr>
            <tr>
                <td>カテゴリー</td>
                <td>
                    <select name="category_id" id="category_id" class="form-control">
                        @foreach ($categories as $category)
                            <option
                                value="{{ $category->id }}"{{ old('category_id', $item_data['category_id'] ?? '') == $category->id ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td>数量</td>
                <td>{{ $input['count_limit'] }}</td>
            </tr>
            <tr>
                <td>販売価格</td>
                <td>{{ $input['sales_price'] }}</td>
            </tr>
            <tr>
                <td>通常価格</td>
                <td>{{ $input['regular_price'] }}</td>
            </tr>
            <tr>
                <td>商品画像</td>
                <td>
                    @foreach ($input['file_paths'] as $filePath)
                        <p><img src="{{ asset('storage/images/' . $filePath) }}" alt="商品画像" style="width: 100px;"></p>
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>商品説明</td>
                <td>{{ $input['message'] }}</td>
            </tr>
        </table>
        <button type="submit" class="btn btn-primary">登録</button>
        <button type="submit" class="btn btn-primary" name="back" value="back">戻る</button>
    </form>
@endsection

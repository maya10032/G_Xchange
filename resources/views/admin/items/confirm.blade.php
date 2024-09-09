@extends('layouts.admin')

@section('title', '登録内容確認')
@section('content')
    <topnav>
        <ul>
            <li><a class="current" href="{{ url('admin/items/create') }}">新規商品登録</a></li>
            <li><a class="current" href="{{ url('admin/items/confirm') }}">確認画面</a></li>
        </ul>
    </topnav>
    <h2 class="py-2 admin">確認画面</h2>
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
                    @foreach ($categories as $category)
                        @if ($input['category_id'] == $category->id)
                            {{ $category->category_name }}
                        @endif
                    @endforeach
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
                <td>サムネイル</td>
                <td>
                    @if (isset($input['thumbnail']) && isset($input['file_paths'][$input['thumbnail']]))
                        <img src="{{ asset('storage/images/' . $input['file_paths'][$input['thumbnail']]) }}"
                            alt="サムネイル" style="width: 100px;">
                    @else
                        なし
                    @endif
                </td>
            </tr>
            <tr>
                <td>商品説明</td>
                <td>{{ $input['message'] }}</td>
            </tr>
        </table>
        <button type="submit" class="btn btn-danger">登録</button>
        <button type="submit" class="btn btn-secondary" name="action" value="back">戻る</button>
    </form>
@endsection

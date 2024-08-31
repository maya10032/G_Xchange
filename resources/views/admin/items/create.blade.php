@extends('layouts.admin')

@section('title', '商品一覧画面')
@section('content')
    <a href="{{ url('admin/items') }}">商品一覧</a> ＞<a href="{{ url('admin/items/create') }}">新規商品登録</a>

    {{-- <form action="{{ route('admin.items.store') }}" method="POST" enctype="multipart/form-data"> --}}
    @csrf
    <table class="table">
        <tr>
            <td>商品コード ※必須</td>
            <td><input type="text" name="item_code" class="form-control" value="{{ old('item_code') }}"></td>
        </tr>
        <tr>
            <td>商品名 ※必須</td>
            <td><input type="text" name="item_name" class="form-control" value="{{ old('item_name') }}"></td>
        </tr>
        <tr>
            <td>カテゴリー</td>
            <td><input type="text" name="category" class="form-control" value="{{ old('category') }}"></td>
        </tr>
        <tr>
            <td>最大注文数 ※必須</td>
            <td><input type="text" name="max_order" class="form-control" value="{{ old('max_order') }}"></td>
        </tr>
        <tr>
            <td>販売価格 ※必須</td>
            <td><input type="text" name="sale_price" class="form-control" value="{{ old('sale_price') }}"></td>
        </tr>
        <tr>
            <td>通常価格<p>※通常価格と販売価格の差が割引として表示されます</p>
            </td>
            <td><input type="text" name="regular_price" class="form-control" value="{{ old('regular_price') }}"></td>
        </tr>
        <tr>
            <td>画像をアップロード (最大4枚) ※必須
                <div>※画像は64x64ピクセルで表示されます</div>
                <div>※サムネイルとして1番目の画像が自動的に選択されます。</div>
            </td>
            <td>
                {{-- プレビューエリア --}}
                <div id="preview"></div>
                {{-- 画像アップロードフォーム --}}
                <input type="file" class="form-control" id="images" name="images[]" multiple accept="image/*">
                {{-- サムネイル画像(thumbnail)を保存、0で最初の画像を指定 --}}
                <input type="hidden" id="thumbnail" name="thumbnail" value="0">
            </td>
        </tr>
        <tr>
            <td>商品説明 ※必須</td>
            <td>
                <textarea name="description" class="form-control">{{ old('description') }}</textarea>
            </td>
        </tr>
    </table>
    <button type="submit" class="btn btn-primary">登録内容確認</button>
    </form>
@endsection

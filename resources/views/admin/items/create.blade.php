@extends('layouts.admin')

@section('title', '商品一覧画面')

@section('content')
    <a href="{{ url('admin/items') }}">商品一覧</a> ＞<a href="url('admin/items/create')">新規商品登録</a>
    <tbody>
        <table class="table">
            <tr>
                <td>商品コード</td>
                <td><input type="text" name="item_code" class="form-control" value="{{ old('item_code') }}"></td>
            </tr>
            <tr>
                <td>商品名</td>
                <td><input type="text" name="	item_name" class="form-control" value="{{ old('	item_name') }}"></td>
            </tr>
            <tr>
                <td>カテゴリー</td>
                <td><input type="text" name="	item_name" class="form-control" value="{{ old('	item_name') }}"></td>
            </tr>
            <tr>
                <td>最大注文数</td>
                <td><input type="text" name="	item_name" class="form-control" value="{{ old('	item_name') }}"></td>
            </tr>
            <tr>
                <td>販売価格</td>
                <td><input type="text" name="	item_name" class="form-control" value="{{ old('	item_name') }}"></td>
            </tr>
            <tr>
                <td>商品名</td>
                <td><input type="text" name="	item_name" class="form-control" value="{{ old('	item_name') }}"></td>
            </tr>
        </table>
    </tbody>


@endsection

@extends('layouts.admin')

@section('title', '商品新規登録')
@section('content')
    <a href="{{ url('admin/items') }}">
        商品一覧</a> ＞<a href="{{ url('admin/items/create') }}">新規商品登録</a>

    <form action="{{ route('admin.items.post') }}" method="post" enctype="multipart/form-data">
        @csrf
        <table>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <tr>
                <td>商品コード</td>
                <td>
                    <input type="text" name="item_code" class="form-control @error('item_code') is-invalid @enderror"
                        value="{{ old('item_code') }}">
                    @error('item_code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td>商品名</td>
                <td><input type="text" name="item_name" class="form-control @error('item_name') is-invalid @enderror"
                        value="{{ old('item_name') }}">
                </td>
                @error('item_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </tr>
            <tr>
                <td>カテゴリー</td>
                <td>
                    <select name="category_id" id="category_id" class="form-control">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td>数量</td>
                <td><input type="text" name="count_limit" class="form-control @error('count_limit') is-invalid @enderror"
                        value="{{ old('count_limit') }}">
                </td>
                @error('count_limit')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </tr>
            <tr>
                <td>販売価格</td>
                <td><input type="text" name="sales_price" class="form-control @error('sales_price') is-invalid @enderror"
                        value="{{ old('sales_price') }}">
                </td>
                @error('sales_price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </tr>
            <tr>
                <td>通常価格</td>
                <td><input type="text" name="regular_price"
                        class="form-control @error('regular_price') is-invalid @enderror"
                        value="{{ old('regular_price') }}"></td>
                @error('regular_price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </tr>
            <tr>
                <td>商品画像</td>
                <td style="min-height:20vh"
                    class="flex md:flex-nowrap flex-wrap justify-center items-center md:justify-start">
                    <input type="file" name="files[]" id="image" multiple
                        class="form-control @error('files.') is-invalid @enderror">
                    @if ($errors->has('files.*.image'))
                        <div class="invalid-feedback">
                            @foreach ($errors->get('files.*.image') as $message)
                                <p>{{ $message }}</p>
                            @endforeach
                        </div>
                    @endif
                </td>
            </tr>
            <tr>
                <td>商品説明</td>
                <td>
                    <textarea class="form-control @error('message') is-invalid @enderror" rows="10" name="message"
                        value="{{ old('message') }}"></textarea>
                    @error('message')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
            </tr>
        </table>
        <input type="submit" value="内容確認">
    </form>
    {{-- <script src="{{ asset('js/image.js') }}"></script> --}}
@endsection

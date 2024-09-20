@extends('layouts.admin')

@section('title', '商品新規登録')
@section('content')
    <topnav class="topnav">
        <ul>
            <li><a class="current" href="{{ url('admin/items') }}">商品一覧</a></li>
            <li><a class="current" href="{{ url('admin/items/create') }}">新規商品登録</a></li>
        </ul>
    </topnav>
    <h2 class="py-2 admin">新規商品登録</h2>
    <div class="container">
        <form action="{{ route('admin.items.post') }}" method="post" enctype="multipart/form-data" novalidate>
            @csrf
            <table class="table table-bordered table-striped task-table table-hover">
                <tr>
                    <td>商品コード</td>
                    <td>
                        <input type="text" name="item_code" class="form-control @error('item_code') is-invalid @enderror"
                            value="{{ old('item_code') }}" placeholder="半角英数字で入力してください">
                        @error('item_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td>商品名</td>
                    <td><input type="text" name="item_name" class="form-control @error('item_name') is-invalid @enderror"
                            value="{{ old('item_name') }}" placeholder="商品名を入力してください">
                        @error('item_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td>カテゴリー</td>
                    <td>
                        <select name="category_id" id="category_id"
                            class="form-control @error('category_id') is-invalid @enderror">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>最大注文数</td>
                    <td><input type="text" name="count_limit"
                            class="form-control @error('count_limit') is-invalid @enderror"
                            value="{{ old('count_limit') }}" placeholder="一度に注文できる数量を入力してください" style="width: 500px;">
                        @error('count_limit')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td>販売価格</td>
                    <td><input type="text" name="sales_price"
                            class="form-control @error('sales_price') is-invalid @enderror"
                            value="{{ old('sales_price') }}" placeholder="割引時の価格を入力してください">
                        @error('sales_price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td>通常価格</td>
                    <td><input type="text" name="regular_price"
                            class="form-control @error('regular_price') is-invalid @enderror"
                            value="{{ old('regular_price') }}" placeholder="定価を入力してください"></td>
                    @error('regular_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </tr>
                <tr>
                    <th></th>
                    <th>
                        <div id="preview"></div>
                    </th>
                </tr>
                <tr>
                    <td>商品画像（最大３枚）</td>
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
                    <td>サムネイル</td>
                    <td>
                        <select name="thumbnail" id="thumbnail" class="form-control">
                            @foreach (range(0, 2) as $index)
                                <option value="{{ $index }}" {{ old('thumbnail') == $index ? 'selected' : '' }}>
                                    画像{{ $index + 1 }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>商品説明</td>
                    <td>
                        <textarea class="form-control @error('message') is-invalid @enderror" rows="10" name="message"
                            value="{{ old('message') }}" placeholder="商品説明を入力してください"></textarea>
                        @error('message')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                </tr>
            </table>
            {{-- <input type="submit" value="内容確認"> --}}
            <div class="col-lg-12 d-flex align-items-center mt-4">
                <button type="submit" class="btn bg-primary text-light px-5 py-2 hover-effect"><span>内容確認</span></button>
            </div>
        </form>
    </div>
@endsection

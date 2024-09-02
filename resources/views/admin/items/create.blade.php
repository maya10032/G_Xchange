@extends('layouts.admin')

@section('title', '商品新規登録')
@section('content')
    <a href="{{ url('admin/items') }}">
        商品一覧</a> ＞<a href="{{ url('admin/items/create') }}">新規商品登録</a>

    <form action="{{ route('admin.items.post') }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        <table class="table">
            <tr>
                <td>商品コード ※必須</td>
                <td>
                    <input type="text" class="form-control @error('item_code') is-invalid @enderror" id="item_code"
                        name="item_code" value="{{ old('item_code', $item_data['item_code'] ?? '') }}">
                    @error('item_code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td>商品名 ※必須</td>
                <td><input type="text" class="form-control @error('item_name') is-invalid @enderror" id="item_name"
                        name="item_name" value="{{ old('item_name', $item_data['item_name'] ?? '') }}">
                    @error('item_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td>カテゴリー</td>
                <td>
                    <select name="category_id" id="category_id" class="form-control" required
                        @error('category_id') is-invalid @enderror>
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
                <td>最大注文数 ※必須</td>
                <td><input type="text" name="count_limit" class="form-control @error('count_limit') is-invalid @enderror"
                        value="{{ old('count_limit', $item_data['count_limit'] ?? '') }}">
                    @error('count_limit')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td>販売価格 ※必須</td>
                <td><input type="text" name="sales_price" class="form-control @error('sales_price') is-invalid @enderror"
                        value="{{ old('sales_price', $item_data['sales_price'] ?? '') }}">
                    @error('sales_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td>通常価格<p>※通常価格と販売価格の差が割引として表示されます</p>
                </td>
                <td><input type="text" name="regular_price"
                        class="form-control @error('regular_price') is-invalid @enderror"
                        value="{{ old('regular_price', $item_data['regular_price'] ?? '') }}">
                    @error('regular_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td>画像をアップロード (最大4枚) ※必須
                    <div>※画像は100x100ピクセルで表示されます</div>
                    <div>※サムネイルとして1番目の画像が自動的に選択されます。</div>
                </td>
                <td>
                    {{-- 画像プレビュー --}}
                    <div id="preview">
                        @if (!empty($item_data['file_paths']))
                            @foreach ($item_data['file_paths'] as $path)
                                <img src="{{ asset('storage/' . $path) }}" alt="商品画像"
                                    style="max-width: 150px; max-height: 150px; margin-right: 10px;">
                                <input type="hidden" name="file_paths[]" value="{{ $path }}">
                            @endforeach
                        @endif
                    </div>
                    {{-- 画像アップロードフォーム --}}
                    <input type="file" class="form-control @error('images') is-invalid @enderror" id="images"
                        name="images[]" multiple accept="image/*">
                    {{-- サムネイル画像(thumbnail)を保存、0で最初の画像を指定 --}}
                    <input type="hidden" id="thumbnail" name="thumbnail" value="0">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </td>
            </tr>
            <tr>
                <td>商品説明 ※必須</td>
                <td>
                    <textarea name="message" class="form-control @error('message') is-invalid @enderror" rows="10">
                        {{ old('message', $item_data['message'] ?? '') }}
                    </textarea>
                    @error('message')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
        </table>
        <button type="submit" class="btn btn-primary">登録内容確認</button>
    </form>
    <script src="{{ asset('js/image.js') }}"></script>
@endsection

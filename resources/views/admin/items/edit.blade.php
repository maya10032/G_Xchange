@extends('layouts.admin')

@section('title', '商品編集')
@section('content')
    <topnav class="topnav">
        <ul>
            <li><a class="current" href="{{ url('admin/items') }}">商品一覧</a></li>
            <li><a class="current" href="{{ route('admin.items.edit', ['item' => $item->id]) }}">商品編集</a></li>
        </ul>
    </topnav>
    <h2 class="py-2 admin">商品編集</h2>
    <div class="container">
        <form action="{{ route('admin.items.update', ['id' => $item->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <table>
                <tr>
                    <td>商品コード</td>
                    <td>
                        <input type="text" name="item_code" class="form-control @error('item_code') is-invalid @enderror"
                            value="{{ $item->item_code }}">
                        @error('item_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td>商品名</td>
                    <td><input type="text" name="item_name" class="form-control @error('item_name') is-invalid @enderror"
                            value="{{ $item->item_name }}">
                    </td>
                    @error('files.*')
                        <div class="invalid-feedback">
                            @foreach ($errors->get('files.*') as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @enderror
                </tr>
                <tr>
                    <td>カテゴリー</td>
                    <td>
                        <select name="category_id" id="category_id"
                            class="form-control @error('category_id') is-invalid @enderror">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $item->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>数量</td>
                    <td><input type="text" name="count_limit"
                            class="form-control @error('count_limit') is-invalid @enderror"
                            value="{{ $item->count_limit }}" style="width: 500px;">
                    </td>
                    @error('count_limit')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </tr>
                <tr>
                    <td>販売価格</td>
                    <td><input type="text" name="sales_price"
                            class="form-control @error('sales_price') is-invalid @enderror"
                            value="{{ $item->sales_price }}">
                    </td>
                    @error('sales_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </tr>
                <tr>
                    <td>通常価格</td>
                    <td><input type="text" name="regular_price"
                            class="form-control @error('regular_price') is-invalid @enderror"
                            value="{{ $item->regular_price }}"></td>
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
                    <td>現在の商品画像</td>
                    <td style="min-height:20vh"
                        class="flex md:flex-nowrap flex-wrap justify-center items-center md:justify-start">
                        <div class="image-preview">
                            @foreach ($item->images as $image)
                                <img src="{{ asset('storage/images/' . $image->img_path) }}" alt="{{ $item->item_name }}"
                                    style="width: 100px; height: 100px; margin-right: 10px;">
                            @endforeach
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>現在のサムネイル</td>
                    <td>
                        @if ($item->images->isNotEmpty())
                            <img src="{{ asset('storage/images/' . $item->images[$item->thumbnail]->img_path) }}"
                                alt="サムネイル" style="width: 100px; height: 100px;">
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>商品画像（最大４枚）</td>
                    <td style="min-height:20vh"
                        class="flex md:flex-nowrap flex-wrap justify-center items-center md:justify-start">
                        <input type="file" name="files[]" id="image" multiple
                            class="form-control @error('files.') is-invalid @enderror">
                        @if ($errors->has('files.*'))
                            <div class="invalid-feedback">
                                @foreach ($errors->get('files.*') as $message)
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
                            @foreach (range(0, 3) as $index)
                                <option value="{{ $index }}" {{ $item->thumbnail == $index ? 'selected' : '' }}>
                                    画像{{ $index + 1 }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>商品説明</td>
                    <td>
                        <textarea class="form-control @error('message') is-invalid @enderror" rows="10" name="message">{{ $item->message }}</textarea>
                        @error('message')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>
            </table>
            {{-- <input type="submit" value="内容確認"> --}}
            <div class="btn-group gap-3 mt-4">
                <button type="submit" class="btn bg-primary text-light px-5 py-2 hover-effect"><span>更新</span></button>
                @if ($item->is_active)
                    <button type="submit" name="action" value="stop"
                        class="btn btn-delete text-light px-5 py-2 hover-effect"><span>販売停止にする</span></button>
                @else
                    <button type="submit" name="action" value="start"
                        class="btn btn-edit text-light px-5 py-2 hover-effect"><span>販売開始する</span></button>
                @endif
            </div>
        </form>
    </div>
@endsection

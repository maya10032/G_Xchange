@extends('layouts.admin')

@section('title', '商品一覧画面')

@section('content')
    <topnav>
        <ul>
            <li><a class="current" href="{{ url('admin/items') }}">商品一覧</a></li>
        </ul>
    </topnav>
    @if (session('attention'))
        <div class="alert alert-danger">
            {{ session('attention') }}
        </div>
    @endif
    <h2 class="py-2 admin">商品一覧ページ</h2>
    <div class="container mb-2" style="width: 100%;">
        <div class="d-flex justify-content-end mt-3">
            <form class="d-flex" role="search">
                <input class="form-control me-2 border-secondary" style="width: 600px;" type="search"
                    placeholder="商品名、カテゴリ、ブランドなど" aria-label="Search">
                <button class="btn btn-secondary" style="width: 80px;" type="submit">{{ __('search') }}</button>
            </form>
            <div class="ms-3">
                <select class="form-select" aria-label="並び替え">
                    <option selected>並び替え</option>
                    <option value="1">価格が安い順</option>
                    <option value="2">価格が高い順</option>
                    <option value="3">新しい順</option>
                    <option value="4">古い順</option>
                </select>
            </div>
        </div>
    </div>
    <table class="table table-bordered table-striped task-table table-hover">
        <tr>
            <th>商品ID</th>
            <th>商品名</th>
            <th>商品コード</th>
            <th>商品カテゴリー</th>
            <th>最大注文数</th>
            <th>商品画像</th>
            <th>販売価格</th>
            <th>通常価格</th>
            <th>販売状況</th>
            <th></th>
        </tr>
        @foreach ($itemsWithTax as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td><a href="{{ route('admin.items.show', ['item' => $item->id]) }}">{{ $item->item_name }}</a></td>
                <td>{{ $item->item_code }}</td>
                <td>{{ $item->category->category_name }}</td>
                <td>{{ $item->count_limit }}</td>
                <td><img src="{{ asset('storage/images/' . $item->images->first()->img_path) }}"
                        alt="{{ $item->item_name }}" style="width: 100px; height: 100px;"></td>
                <td>{{ number_format($item->subtotal) }}円</td>
                <td>{{ number_format($item->regtotal) }}円</td>
                <td class="{{ $item->state === '販売停止中' ? 'text-danger' : '' }}">{{ $item->state }}</td>
                <td class="d-flex align-items-center" style="height: 120px;">
                    <a href="{{ route('admin.items.edit', ['item' => $item->id]) }}" class="btn btn-secondary me-2">編集</a>
                    <form action="{{ route('admin.items.destroy', ['item' => $item->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？')">削除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <div class="d-flex justify-content-center my-2">
        {{ $items->links() }}
    </div>
@endsection

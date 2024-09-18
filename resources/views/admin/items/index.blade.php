@extends('layouts.admin')

@section('title', '商品管理画面')

@section('content')
    <topnav class="topnav">
        <ul>
            <li><a class="current" href="{{ url('admin/items') }}">商品一覧</a></li>
        </ul>
    </topnav>
    <h2 class="py-2 admin">商品一覧</h2>
    @if (session('create'))
        <div class="alert-blue-line mb-2" style="font-size: 1.25rem;">
            {{ session('create') }}
        </div>
    @elseif (session('delete'))
        <div class="alert-red-line mb-2" style="font-size: 1.25rem;">
            {{ session('delete') }}
        </div>
    @elseif (session('success'))
        <div class="alert-green-line mb-2" style="font-size: 1.25rem;">
            {{ session('success') }}
        </div>
    @endif
    <div class="container mb-2" style="width: 100%;">
        <div class="d-flex justify-content-end mt-3">
            <form class="d-flex" role="search" method="GET" action="{{ route('admin.items.search') }}">
                <input class="form-control me-2 border-secondary" style="width: 600px;" type="search" name="search"
                    placeholder="商品名、カテゴリなど" aria-label="Search" value="{{ old('search', $search ?? '') }}">
                <button class="btn btn-dark" style="width: 80px;" type="submit">{{ __('search') }}</button>
            </form>
        </div>
    </div>
    @if (isset($query))
        @if ($items->isEmpty())
            <h3>検索結果: {{ $query }} に該当する商品はありませんでした。</h3>
        @else
            <h3>検索結果: ”{{ $query }}”</h3>
        @endif
    @endif
    <table class="table table-bordered table-striped task-table table-hover">
        <tr>
            <th>@sortablelink('id', '商品ID')</th>
            <th>@sortablelink('item_name', '商品名')</th>
            <th>商品画像</th>
            <th>@sortablelink('item_code', '商品コード')</th>
            <th>@sortablelink('category.category_name', 'カテゴリー')</th>
            <th>@sortablelink('sales_price', '販売価格')</th>
            <th style="color: red;">割引価格</th>
            <th>@sortablelink('is_active', '販売状況')</th>
            <th>@sortablelink('created_at', '作成日')</th>
            <th></th>
            <th></th>
        </tr>
        @foreach ($itemsWithTax as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td class="item-name-cell"><a
                        href="{{ route('admin.items.show', ['item' => $item->id]) }}">{{ $item->item_name }}</a></td>
                <td><img src="{{ asset('storage/images/' . $item->images[$item->thumbnail]->img_path) }}"
                        alt="{{ $item->item_name }}" style="width: 100px; height: 100px;"></td>
                <td>{{ $item->item_code }}</td>
                <td>{{ $item->category->category_name }}</td>
                <td>{{ number_format($item->subtotal) }}円</td>
                <td style="color: red;">-{{ number_format($item->regtotal - $item->subtotal) }}円</td>
                <td class="{{ $item->state === '販売停止中' ? 'text-danger' : '' }}">{{ $item->state }}</td>
                <td>{{ $item->created_at }}</td>
                <td>
                    <a href="{{ route('admin.items.edit', ['item' => $item->id]) }}" class="btn btn-edit">
                        <i class="fa fa-pencil-alt" aria-hidden="true"></i> 編集
                    </a>
                </td>
                <td>
                    <form action="{{ route('admin.items.destroy', ['item' => $item->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete" onclick="return confirm('本当に削除しますか？')">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                    </form>
                </td>

            </tr>
        @endforeach
    </table>
    <div class="d-flex justify-content-center my-2">
        {{ $items->links() }}
    </div>
@endsection

@extends('layouts.app')
<!-- 1行で指定することも可能 -->
@section('title', '商品一覧')

@section('content')
    <table class="table table-bordered table-striped task-table table-hover">
        @if (session('success'))
            <div class="alert alert-success text-center fw-bold">
                {{ session('success') }}
            </div>
        @elseif (session('update'))
            <div class="alert alert-info text-center fw-bold">
                {{ session('update') }}
            </div>
        @endif
        <thead>
            <tr class="table-dark text-light">
                <th>商品ID</th>
                <th>商品コード</th>
                <th>商品名</th>
                <th>カテゴリー</th>
                <th>最大注文数</th>
                <th>商品画像</th>
                <th>販売価格</th>
                <th>編集</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->item_code }}</td>
                    <td><a href="{{ url('items/' . $item->id . '/show') }}"
                            class="text-dark text-decoration-none">{{ $item->item_name }}</a></td>
                    <td>{{ $item->category_id }} </td>
                    <td>{{ $item->count_limit }} 冊</td>
                    <td>{{ number_format($item->sales_price) }}円</td>
                    <td>
                        <form action="{{ url('items/' . $item->id . '/edit') }}" method="get">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-secondary">
                                <i class="fa fa-pencil"></i> 編集
                            </button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ url('items/' . $item->id) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-secondary">
                                <i class="fa fa-trash"></i> 削除
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="7" class="bg-light pb-0">
                    {{ $items->links() }}
                </td>
            </tr>
        </tfoot>
    </table>
@endsection

{{ Debugbar::log($items->toArray()) }}

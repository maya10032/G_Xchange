@extends('layouts.app')
<!-- 1行で指定することも可能 -->
@section('title', '商品詳細')

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
        <tbody>
            <h2>商品詳細ページです</h2>
                {{-- <tr>
                    <td>{{ $item->item_name }}</td>
                </tr>
                <tr>
                    <td>{{ $item->message }}</td>
                </tr> --}}
                <div class="form-group col-xs-12">
                    <div class="input-group mb-4">カテゴリー</div>
                    <input class="form-control bg-light" disabled value="{{ $item->item_name }}">
                    <input class="form-control bg-light" disabled value="{{ $item->regular_price }}">
                    <P><input class="form-control bg-light" disabled value="{{ $item->sales_price }}">送料無料</P>
                </div>
        </tbody>
        </tbody>
        {{-- <tfoot>
            <tr>
                <td colspan="7" class="bg-light pb-0">
                    {{ $items->links() }}
                </td>
            </tr>
        </tfoot> --}}
    </table>
@endsection

{{-- {{ Debugbar::log($items->toArray()) }} --}}

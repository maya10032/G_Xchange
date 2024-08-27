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
        <tbody>
            <h2>商品詳細ページです</h2>
            @foreach ($items as $item)
                <tr>
                    <a href="{{ route('/items') }}">
                        <td>{{ $item->item_name }}</td>
                    </a>
                </tr>
                <tr>
                    <td>{{ $item->message }}</td>
                </tr>
            @endforeach
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

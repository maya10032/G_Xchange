@extends('layouts.app')

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
            <h2>商品一覧ページです</h2>
            @foreach ($items as $item)
                <tr>
                    {{-- <td><a href="{{ route('items.show', ['id' => $item->id]) }}">{{ $item->item_name }}</a></td> --}}
                    <td><a href="{{ url('items/' . $item->id . '/show') }}">{{ $item->item_name }}</a></td>
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

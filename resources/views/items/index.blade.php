@extends('layouts.main')

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
                @foreach ($items as $item)
                <tr>
                    <td>{{ $item->item_code }}</td>
                    <td>{{ $item->item_name }}</td>
                    <td>
                        <img src="{{ asset('storage/images/' . $item->images[$item->thumbnail]->img_path) }}" alt="サムネイル"
                        style="width: 100px;">
                    </td>
                    <td>{{ $item->sales_price }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <footer>
            <tr>
                <td colspan="7" class="bg-light pb-0">
                    {{ $items->links() }}
                </td>
            </tr>
        </footer>
        @endsection
        {{-- {{ Debugbar::log($items->toArray()) }} --}}

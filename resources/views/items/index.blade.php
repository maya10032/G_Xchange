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
                {{-- @foreach ($item->images as $thumbnail => $image) --}}
                    <tr>
                        <td><a href="{{ route('items.show', $item->id) }}">{{ $item->item_name }}</a></td>
                    </tr>
                    <tr>
                        <td>{{ $item->message }}</td>
                    </tr>
                    <tr>
                        @if ($item->thumbnail === 0)
                            <td><img src="{{ asset('storage/images/' . $item->images->first()->img_path) }}" alt="Image"
                                    style="width: 150px; height: auto;">
                            </td>
                        @endif
                    {{-- @break --}}

                </tr>
            {{-- @endforeach --}}
            {{-- @foreach ($item->images as $image)
                {{ $item->images[0]['attributes:protected']['img_path'] }}
                @php
                    $Array[] = $image['img_path'];
                    echo '<pre>';
                    print_r($item->images);
                    echo '</pre>';
                @endphp
                @if ($item->images->count() > 0)
                    <img src="{{ Storage::url('images/' . $image->img_path) }}" style="width: 150px; height: auto;">
                @endif
            @endforeach --}}
        @endforeach







    </tbody>
</table>
@endsection

{{-- {{ Debugbar::log($items->toArray()) }} --}}

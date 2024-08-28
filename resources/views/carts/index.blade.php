<h1>カート一覧画面</h1>
<section class="text-gray-600 body-font">
    <div class="container px-5 py-24 mx-auto">
        <div class="flex flex-wrap -m-4">
            {{-- カートが空だったら --}}
            @if (count($items) == 0)
                <div class="flex items-center justify-center w-full absolute inset-0">
                    <h2 class="tracking-widest text-center w-full text-3xl title-font font-light text-gray-600 mb-1">
                        {{ __('nocart') }}
                    </h2>
                </div>
            @else
                <tbody>
                    @if (session('cartdelete'))
                        <div class="alert alert-info text-center fw-bold">
                            {{ session('cartdelete') }}
                        </div>
                    @endif
                    <div class="w-full mx-auto overflow-auto">
                        <table class="table-auto w-full text-left whitespace-no-wrap">
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td><a href="{{ route('items.show', $item->id) }}">{{ $item->item_name }}</td>
                                    </tr>
                                    <tr>
                                        <td><a href="{{ route('items.show', $item->id) }}">{{ $item->created_at }}</td>
                                    </tr>
                                    <tr>
                                        <form action="{{ route('carts.destroy') }}" method="post">
                                            <td>
                                                @csrf
                                                @method('delete')
                                                <input type="hidden" name="item_id" value="{{ $item->id }}">
                                                <button>{{ __('cart') . __('delete') }}</button>
                                            </td>
                                        </form>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            @endif
        </div>
    </div>
</section>

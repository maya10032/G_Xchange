<h1>お気に入り一覧画面</h1>
<section class="text-gray-600 body-font">
    <div class="container px-5 py-24 mx-auto">
        <div class="flex flex-wrap -m-4">
            {{-- お気に入りが空だったら --}}
            @if (count($items) == 0)
                <div class="flex items-center justify-center w-full absolute inset-0">
                    <h2 class="tracking-widest text-center w-full text-3xl title-font font-light text-gray-600 mb-1">
                        {{ __('nolike') }}
                    </h2>
                </div>
            @else
                <tbody>
                    @if (session('likedelete'))
                        <div class="alert alert-info text-center fw-bold">
                            {{ session('likedelete') }}
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
                                        <form action="{{ route('likes.destroy') }}" method="post">
                                            <td>
                                                @csrf
                                                @method('delete')
                                                <input type="hidden" name="item_id" value="{{ $item->id }}">
                                                <button>{{ __('like') . __('delete') }}</button>
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

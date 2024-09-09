@extends('layouts.admin')

@section('title', 'ユーザ情報詳細')

@section('content')
    <h2 class="py-2 admin">ユーザ情報詳細</h2>
    {{-- @php
    echo '<pre>'; // 表示を見やすく整形する
    var_dump($user); // user変数を一覧表示する
    echo '<pre>';
  @endphp --}}
    <table class="table table-bordered table-striped task-table table-hover">
        <tr>
            <th>注文番号</th>
            <th>注文日</th>
            <th>商品名</th>
            <th>商品画像</th>
            <th>数量</th>
            <th>販売価格</th>
            <th>合計金額</th>
            <th></th>
        </tr>
        @foreach ($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->created_at }}</td>
                <td>
                    @if ($order->item->is_active)
                        {{ $order->item->item_name }}
                    @else
                        {{ $order->item->item_name }} <span class="text-danger">（販売停止中）</span>
                    @endif
                </td>
                <td><img src="{{ asset('storage/images/' . $order->item->images->first()->img_path) }}"
                        alt="{{ $order->item->item_name }}" style="width: 100px; height: 100px;"></td>
                <td>{{ $order->count }}個</td>
                <td>{{ number_format($order->item->tax_sales_prices) }}円</td>
                <td>
                    {{ number_format($order->subtotal) }}円</td>
                <td><a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-primary me-2"><i class="fa fa-search"
                            aria-hidden="true"></i> 詳細</td>
            </tr>
        @endforeach
    </table>
    <p class="text-center my-3"><a href="{{ url('admin/users/') }}">ユーザ一覧へ戻る</a></p>
    </div>
    </div>
    </div>

    </form>
@endsection

<script>
    // 削除確認用のダイアログ表示
    const deleteuser = () => {
        event.preventDefault()
        confirm('本当に削除しますか？') ? document.querySelector('#delete-form').submit() : ''
    }
</script>

@extends('layouts.user')

@section('title', 'カート一覧')

@section('content')
    <div class="py-1 container sticky-top" style="min-height: calc(100vh - 100px);">
        @if (session('cartdelete'))
            <div class="alert-red-line mb-2" style="font-size: 1.25rem;">
                {{ session('cartdelete') }}
            </div>
        @endif
        <h2 class="title--border">マイページ / カート一覧</h2>
        @if ($carts->isEmpty())
            <p>カートに商品がありません。</p>
        @else
            <div class="row">
                <div class="col-md-8">
                    @foreach ($carts as $cart)
                        <div class="col-md-max">
                            <div
                                class="row g-0 card rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                                <div class="col-auto d-none d-lg-block">
                                    <img src="{{ asset('storage/images/' . $cart->item->images[$cart->item->thumbnail]->img_path) }}"
                                        alt="{{ $cart->item->item_name }} サムネイル"
                                        style="width: 250px; height: 250px; padding: 10px;">
                                </div>
                                <div class="col p-4 d-flex flex-column position-static">
                                    <strong class="d-inline-block mb-2 text-primary-emphasis">
                                        {{ $cart->item->category->category_name }}
                                    </strong>
                                    @if ($cart->item->is_active)
                                        <h3 class="mb-0">
                                            <a href="{{ route('items.show', $cart->item->id) }}" class="item-title">
                                                {{ $cart->item->item_name }}
                                            </a>
                                        </h3>
                                    @else
                                        <h3 class="mb-0">
                                            <a href="{{ route('items.show', $cart->item->id) }}" class="item-title">
                                                {{ $cart->item->item_name }}
                                            </a>
                                        </h3>
                                        <span class="text-danger">
                                            <h3>（現在販売していません）</h3>
                                        </span>
                                    @endif
                                    <div class="d-flex mb-1 text-body-secondary">
                                        <div class="me-3">
                                            追加日：{{ $cart->created_at }}
                                        </div>
                                    </div>
                                    <div class="d-flex mb-1">
                                        <div class="me-3">
                                            数量：{{ $cart->count }}
                                        </div>
                                        <div class="me-4">
                                            × {{ number_format($cart->item->sales_price) }}円
                                        </div>
                                        <div class="me-3">
                                            合計：{{ number_format($cart->subtotal) }}円
                                        </div>
                                        <div class="me-3">
                                            <div class="me-3 d-flex">
                                                <span class="text-muted">|</span>
                                                <form action="{{ route('carts.destroy', $cart->id) }}" method="post"
                                                    style="display: inline; margin-left: 5px;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link p-0 text-muted delete-link"
                                                        style="text-decoration: none; font-weight: normal;">{{ __('delete') }}</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="d-flex justify-content-center my-4">
                        {{ $carts->links() }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm d-flex flex-column justify-content-between">
                        <div class="card-body flex-grow-1">
                            <div class="d-flex text-body-secondary mb-2">
                                <div class="me-3">
                                    小計：{{ $cartCount }}個の商品
                                </div>
                            </div>
                            <div class="d-flex text-body-secondary mb-2">
                                <div class="me-3">
                                    手数料：0円
                                </div>
                            </div>
                            <div class="d-flex text-body-secondary mb-2">
                                <div class="me-3">
                                    送料：0円
                                </div>
                            </div>
                            <h3 class="card-title">合計：{{ number_format($total) }} 円 （税込）</h3>
                            <form action="{{ route('carts.checkout') }}" method="POST" id="checkoutForm">
                                @csrf
                                <button type="button" class="open-checkout-modal btn btn-danger w-100 mt-2"
                                    data-bs-toggle="modal" data-bs-target="#checkoutModal">まとめて購入する</button>
                                <input type="hidden" name="total_amount" value="{{ $total }}">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    {{-- 決済モーダル --}}
    <div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="checkoutModalLabel">決済情報</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5><span class="text-danger fw-bold mb-2">※内容をご確認の上、支払うボタンを押してください。</span></h5>
                    <div class="recipient-info mb-2" style="display: flex; align-items: flex-start;">
                        <div class="label" style="font-weight: bold; margin-right: 1rem; white-space: nowrap;">
                            受け取り場所:
                        </div>
                        <div class="details" style="display: flex; flex-direction: column;">
                            <p style="margin: 2px;">{{ $user->name }}</p>
                            <p style="margin: 2px;">{{ $user->address }}</p>
                            <p style="margin: 2px;">{{ $user->phone }}</p>
                        </div>
                    </div>
                    <div class="recipient-info" style="display: flex; align-items: flex-start;">
                        <div class="label" style="font-weight: bold; margin-right: 1rem; white-space: nowrap;">
                            決済内容:
                        </div>
                        <div class="details" style="display: flex; flex-direction: column;">
                            <p class="mb-0">数量: {{ $cartCount }} 個の商品</p>
                            <p class="mb-0">小計: {{ number_format($total) }}</p>
                            <p class="mb-0">手数料: ￥0</p>
                            <p class="mb-0">送料: ￥0</p>
                            <p class="mb-3 text-danger fw-bold">合計: {{ number_format($total) }}</p>
                        </div>
                    </div>
                    <form id="card-form" action="{{ route('carts.checkout') }}" method="POST">
                        @csrf
                        {{-- カード情報を入力するフォーム --}}
                        <div class="card-row justify-content-center mb-2" style="margin-left: 0">
                            <span class="visa"></span>
                            <span class="mastercard"></span>
                            <span class="amex"></span>
                            <span class="discover"></span>
                        </div>
                        <div id="card-errors" class="text-danger mb-3" role="alert"></div>
                        <div class="mb-3">
                            <label for="card_number"><i class="fa fa-id-card-o"></i> カード番号</label>
                            <div id="card-number" class="form-control"></div>
                        </div>
                        <div class="mb-3">
                            <label for="card_expiry"><i class="fa fa-calendar-check-o"></i> 有効期限</label>
                            <div id="card-expiry" class="form-control"></div>
                        </div>
                        <div class="mb-4">
                            <label for="card_cvc"><i class="fa fa-lock"></i> セキュリティコード</label>
                            <div id="card-cvc" class="form-control"></div>
                        </div>
                        @foreach ($carts as $cart)
                            <input type="hidden" name="items[{{ $cart->id }}][item_id]"
                                value="{{ $cart->item_id }}">
                            <input type="hidden" name="items[{{ $cart->id }}][count]" value="{{ $cart->count }}">
                        @endforeach
                        <div class="text-end">
                            <div id="card-element"></div>
                            <button type="submit" class="btn btn-primary w-100">支払う</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://js.stripe.com/v3/"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const stripe = Stripe(
            'pk_test_51PySDEDA2YxCl5ELgjZzT5q1XzLn0Bwpc8lOKo7vUyISHdHQm9QAlHYAxvIcXNMsXIgOexnZv5RM53zFzmZ1XIm500Aap1mQ6Y'
        );
        const elements = stripe.elements();

        // カード番号、期限、有効期限のフィールドを作成
        var card = elements.create('cardNumber');
        var cardExpiry = elements.create('cardExpiry');
        var cardCvc = elements.create('cardCvc');

        card.mount('#card-number');
        cardExpiry.mount('#card-expiry');
        cardCvc.mount('#card-cvc');

        var form = document.getElementById("card-form");

        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    document.getElementById('card-errors').textContent = result.error.message;
                } else {
                    var hiddenInput = document.createElement('input');
                    hiddenInput.setAttribute('type', 'hidden');
                    hiddenInput.setAttribute('name', 'stripeToken');
                    hiddenInput.setAttribute('value', result.token.id);
                    form.appendChild(hiddenInput);
                    form.submit();
                }
            });
        });
    });
</script>

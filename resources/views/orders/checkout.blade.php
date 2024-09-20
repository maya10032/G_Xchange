@extends('layouts.app')

@section('title', '決済ページ')

@section('content')
    <div class="py-4 container sticky-top" style="min-height: calc(100vh - 100px);">
        @if (session('flash_alert'))
            <div class="alert alert-danger">{{ session('flash_alert') }}</div>
        @elseif(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <h2><span class="text-danger fw-bold text-center ms-5">※内容をご確認の上、購入するを押してください。</span></h2>
        <div class="row">
            {{-- 左側: 購入する商品 --}}
            <div class="col-md-7 mb-4">
                <div class="card">
                    <div class="card-header">商品情報</div>
                    <div class="row g-0">
                        <!-- 画像部分 -->
                        <div class="col-md-4 d-flex align-items-center">
                            <img src="{{ asset('storage/images/' . $item->images[$item->thumbnail]->img_path) }}"
                                alt="Thumbnail" class="img-fluid rounded ms-2" style="max-height: 230px; width: 230px;">
                        </div>
                        <!-- 情報部分 -->
                        <div class="col-md-8 p-4 d-flex flex-column">
                            <p><strong>カテゴリ：</strong> {{ $item->category->category_name }}</p>
                            <p><strong>商品名：</strong> {{ $item->item_name }}</p>
                            <p><strong>数量：</strong> {{ $count }}</p>
                            <p><strong>小計：</strong> {{ number_format($item->tax_sales_prices) }}円</p>
                            <h4 class="text-danger"><strong>合計： {{ number_format($item->tax_sales_prices * $count) }}円</strong></h4>
                        </div>
                    </div>
                </div>
            </div>
            {{-- 右側: カード情報入力 --}}
            <div class="col-md-4">
                <div class="card" style="height: 350px;">
                    <div class="card-header">カード情報入力</div>
                    <div class="card-body">
                        <div class="card-row justify-content-center">
                            <span class="visa"></span>
                            <span class="mastercard"></span>
                            <span class="amex"></span>
                            <span class="discover"></span>
                        </div>
                        <form id="card-form" action="{{ route('orders.store') }}" method="POST">
                            @csrf
                            <div>
                                <label for="card_number">カード番号</label>
                                <div id="card-number" class="form-control mb-2"></div>
                            </div>

                            <div>
                                <label for="card_expiry">有効期限</label>
                                <div id="card-expiry" class="form-control mb-2"></div>
                            </div>

                            <div>
                                <label for="card-cvc">セキュリティコード</label>
                                <div id="card-cvc" class="form-control"></div>
                            </div>

                            <div id="card-errors" class="text-danger"></div>

                            <input type="hidden" name="item_id" value="{{ $item->id }}">
                            <input type="hidden" name="count" value="{{ $count }}">
                            <div class="card-row justify-content-end">
                                <button class="mt-3 btn btn-danger">購入する</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stripePublicKey = "{{ config('stripe.stripe_public_key') }}";
            const stripe = Stripe(stripePublicKey);
            const elements = stripe.elements();

            const cardNumber = elements.create('cardNumber');
            cardNumber.mount('#card-number');

            const cardExpiry = elements.create('cardExpiry');
            cardExpiry.mount('#card-expiry');

            const cardCvc = elements.create('cardCvc');
            cardCvc.mount('#card-cvc');

            const form = document.getElementById('card-form');
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                stripe.createToken(cardNumber).then(function(result) {
                    if (result.error) {
                        document.getElementById('card-errors').textContent = result.error.message;
                    } else {
                        stripeTokenHandler(result.token);
                    }
                });
            });

            function stripeTokenHandler(token) {
                const form = document.getElementById('card-form');
                const hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);
                form.submit();
            }
        });
    </script>
@endsection

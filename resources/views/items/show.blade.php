@extends('layouts.app')

@section('title', '商品詳細')

@section('content')
    <div class="py-4 container sticky-top" style="min-height: calc(180vh - 180px);">
        @if (session('likeadd'))
            <div class="alert-blue-line mb-2" style="font-size: 1.25rem;">
                {{ session('likeadd') }}
            </div>
        @elseif (session('likedelete'))
            <div class="alert-red-line mb-2" style="font-size: 1.25rem;">
                {{ session('likedelete') }}
            </div>
        @elseif (session('cartadd'))
            <div class="alert-green-line mb-2" style="font-size: 1.25rem;">
                {{ session('cartadd') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="d-flex">
            <div class="d-flex flex-column me-2 mb-0 reduce-margin" style="flex: 1.1;">
                {{-- サムネイルとその他の画像を横並びにするためにd-flexを使用 --}}
                <div class="d-flex">
                    {{-- サムネイル画像 --}}
                    <div class="mb-2 me-3">
                        <img src="{{ asset('storage/images/' . $item->images[$item->thumbnail]->img_path) }}"
                            alt="Thumbnail" class="img-fluid rounded"
                            style="width: 460px; height: 460px; object-fit: cover; box-shadow: 0 2px 7px rgba(0, 0, 0, 0.2);">
                    </div>
                    {{-- その他の3つの画像を縦一列に配置 --}}
                    <div class="d-flex flex-column">
                        @foreach ($item->images as $index => $image)
                            @if ($index !== $item->thumbnail)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/images/' . $image->img_path) }}" alt="Image"
                                        class="img-fluid rounded"
                                        style="width: 148px; height: 148px; object-fit: cover; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);">
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="ms-auto" style="flex: 1; font-size: 1.25rem;">
                <p class="mb-2"><small class="text-muted"><i class="fa fa-tag" aria-hidden="true"></i>
                        {{ $item->category->category_name }}</small></p>
                <h3 class="mb-3" style="font-size: 1.75rem; word-break: break-word;">{{ $item->item_name }}</h3>
                @if ($item->regular_price === $item->sales_price)
                    <p class="mb-3">{{ number_format($item->tax_sales_prices) }}円（税込）送料無料</p>
                @else
                    <strike class="d-block mb-3" style="font-size: 1.5rem;">{{ number_format($item->tax_regular_prices) }}円
                        <span class="badge bg-danger ms-2" style="position: relative; top: -5px;">SALE</span>
                    </strike>
                    <p class="h4 text-danger fw-bold mb-3">{{ number_format($item->tax_sales_prices) }} 円（税込）送料無料</p>
                @endif
                @if (auth()->guest())
                    <div>
                        <a href="{{ url('login/') }}" class="btn btn-secondary"
                            style="font-size: 1.25rem;">購入するにはログインしてください</a>
                    </div>
                @else
                    @if ($item->is_active)
                        <form action="{{ route('carts.store') }}" method="POST" novalidate style="margin-bottom: 10px;">
                            @csrf
                            <div class="mb-3" style="font-size: 1.25rem;">
                                数量：
                                <input type="number" id="item-quantity" name="count" min="1"
                                    max="{{ $item->count_limit }}" value="{{ old('count', 1) }}" required>
                                <small> （一度に購入できるのは{{ $item->count_limit }}個までです。）</small>
                                @foreach ($errors->all() as $error)
                                    <p class="h4 text-danger fw-bold m-3">※{{ $error }}</p>
                                @endforeach
                            </div>
                            <div class="d-grid gap-1 col-6 align-items-center">
                                <input type="hidden" name="item_id" value="{{ $item->id }}" required>
                                <button type="submit" name="action" value="cart" class="btn btn-secondary mb-2"
                                    style="font-size: 1.25rem;">カートに追加</button>
                            </div>
                            <div class="d-grid gap-1 col-6 align-items-center">
                                <button type="button" class="btn btn-danger open-payment-modal" style="font-size: 1.25rem;"
                                    data-item-id="{{ $item->id }}" data-item-name="{{ $item->item_name }}"
                                    data-item-thumbnail="{{ asset('storage/images/' . $item->images[$item->thumbnail]->img_path) }}"
                                    data-item-quantity="{{ old('count', 1) }}"
                                    data-item-price="{{ $item->tax_sales_prices }}">
                                    今すぐ購入
                                </button>
                            </div>
                        </form>

                        @if (Auth::user()->isLike($item->id))
                            <form action="{{ route('likes.destroy') }}" method="post">
                                @csrf
                                @method('delete')
                                <div class="d-grid gap-1 col-6 align-items-center">
                                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                                    <button class="btn btn-outline-danger" style="font-size: 1.25rem;"><i
                                            class="fa fa-heart-o"></i> {{ __('like') . __('delete') }}</button>
                                </div>
                            </form>
                        @else
                            <form action="{{ route('likes.store') }}" method="post">
                                @csrf
                                <div class="d-grid gap-1 col-6 align-items-center">
                                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                                    <button class="btn btn-outline-danger" style="font-size: 1.25rem;"><i
                                            class="fa fa-heart"></i> {{ __('like') . __('create') }}</button>
                                </div>
                            </form>
                        @endif
                        <ul class="shareList">
                            <li class="shareList-item">
                                <a class="icon icon-twitter" href="#" title="Twitter">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li>
                            <li class="shareList-item">
                                <a class="icon icon-facebook" href="#" title="Facebook">
                                    <i class="fab fa-facebook"></i>
                                </a>
                            </li>
                            <li class="shareList-item">
                                <a class="icon icon-pocket" href="#" title="Pocket">
                                    <i class="fab fa-get-pocket"></i>
                                </a>
                            </li>
                        </ul>
                    @else
                        <h3 class="text-danger mt-4" style="font-size: 1.75rem;">現在販売していません</h3>
                    @endif
                @endif
                <p class="mt-3">
                    <a class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                        href="{{ url('/') }}">商品一覧へ戻る</a>
                </p>
            </div>
        </div>
        <div class="mt-4" style="font-size: 1.25rem; text-align: left; max-width: 550px;">
            <h3 class="mb-3" style="font-size: 1.75rem;"><i class="fa fa-shopping-bag"></i> 商品説明</h3>
            <p>{{ $item->message }}</p>
        </div>
        <div class="mt-5">
            <h3 class="mb-3" style="font-size: 1.75rem;"><i class="fa fa-tags" aria-hidden="true"></i> 同じカテゴリーの商品</h3>
            <div class="row">
                @foreach ($randomItems as $randomItem)
                    <div class="col-md-3">
                        <div class="card shadow-sm hover-effect">
                            <img src="{{ asset('storage/images/' . $randomItem->images[$randomItem->thumbnail]->img_path) }}"
                                alt="{{ $randomItem->item_name }}" class="card-img-top"
                                style="height: 200px; width: auto; object-fit: cover;">
                            <div class="card-body">
                                <h4 class="text-gray-900 title-font text-lg font-medium text-truncate-multiline"
                                    onclick="window.location='{{ route('items.show', $item->id) }}'">
                                    {{ $randomItem->item_name }}</h4>
                                <p class="card-text">{{ number_format($randomItem->tax_sales_prices) }}円（税込）</p>
                                <p class="text-truncate">{{ $randomItem->message }}</p>
                                <a href="{{ route('items.show', $randomItem->id) }}"
                                    class="btn btn-secondary text-light hover-effect">詳細を見る</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @if (auth()->user())
        {{-- 決済モーダル --}}
        <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="paymentModalLabel">決済情報</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h5><span class="text-danger fw-bold mb-2">※内容をご確認の上、支払うボタンを押してください。</span></h5>
                        <div class="recipient-info" style="display: flex; align-items: flex-start;">
                            <div class="label" style="font-weight: bold; margin-right: 1rem; white-space: nowrap;">
                                受け取り場所:
                            </div>
                            <div class="details" style="display: flex; flex-direction: column;">
                                <p style="margin: 2px;">{{ $user->name }}</p>
                                <p style="margin: 2px;">{{ $user->address }}</p>
                                <p style="margin: 2px;">{{ $user->phone }}</p>
                            </div>
                        </div>
                        {{-- 商品情報 --}}
                        <div class="label" style="font-weight: bold; margin-right: 1rem; white-space: nowrap;">商品情報
                        </div>
                        <div>
                            <img id="modal-item-thumbnail" src="" alt="サムネイル" class="img-fluid"
                                style="width: 200px; height: 200px;">
                        </div>
                        <p class="mb-0">商品名: <span id="modal-item-name"></span></p>
                        <p class="mb-0">数量: <span id="modal-item-quantity"></span></p>
                        <p class="mb-0">小計: <span id="modal-item-price"></span></p>
                        <p class="mb-0">手数料: ￥0</p>
                        <p class="mb-0">送料: ￥0</p>
                        <p class="mb-3 text-danger fw-bold">合計: <span id="modal-item-total"></span></p>
                        <form id="card-form" action="{{ route('orders.store') }}" method="POST">
                            @csrf
                            {{-- カード情報を入力するフォーム --}}
                            <div class="card-row justify-content-center" style="margin-left: 0">
                                <span class="visa"></span>
                                <span class="mastercard"></span>
                                <span class="amex"></span>
                                <span class="discover"></span>
                            </div>
                            <div id="card-errors" class="text-danger" role="alert"></div>
                            <div>
                                <label for="card_number"><i class="fa fa-id-card-o"></i> カード番号</label>
                                <div id="card-number" class="form-control mb-2"></div>
                            </div>
                            <div>
                                <label for="card_expiry"><i class="fa fa-calendar-check-o"></i> 有効期限</label>
                                <div id="card-expiry" class="form-control mb-2"></div>
                            </div>
                            <div>
                                <label for="card_cvc"><i class="fa fa-lock"></i> セキュリティコード</label>
                                <div id="card-cvc" class="form-control mb-4"></div>
                            </div>
                            <input type="hidden" id="modal-item-id" name="item_id">
                            <input type="hidden" id="modal-item-count" name="count">
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary w-100">支払う</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const stripe = Stripe(
            "pk_test_51PySDEDA2YxCl5ELgjZzT5q1XzLn0Bwpc8lOKo7vUyISHdHQm9QAlHYAxvIcXNMsXIgOexnZv5RM53zFzmZ1XIm500Aap1mQ6Y"
        ); // Stripeの公開可能キー
        const elements = stripe.elements();

        // カード番号、期限、有効期限のフィールドを作成
        var cardNumber = elements.create("cardNumber");
        var cardExpiry = elements.create("cardExpiry");
        var cardCvc = elements.create("cardCvc");

        cardNumber.mount("#card-number");
        cardExpiry.mount("#card-expiry");
        cardCvc.mount("#card-cvc");

        var form = document.getElementById("card-form");

        form.addEventListener("submit", function(event) {
            event.preventDefault();

            stripe.createToken(cardNumber).then(function(result) {
                if (result.error) {
                    // エラーを表示
                    var errorElement = document.getElementById("card-errors");
                    errorElement.textContent = result.error.message;
                } else {
                    // トークンをフォームに追加して送信
                    var hiddenInput = document.createElement("input");
                    hiddenInput.setAttribute("type", "hidden");
                    hiddenInput.setAttribute("name", "stripeToken");
                    hiddenInput.setAttribute("value", result.token.id);
                    form.appendChild(hiddenInput);

                    // フォームを送信
                    form.submit();
                }
            });
        });

        // 金額をカンマ区切りにフォーマットする関数
        function formatPrice(price) {
            return Number(price).toLocaleString("ja-JP", {
                style: "currency",
                currency: "JPY",
            });
        }

        // モーダル表示時に情報を設定する関数
        function showPaymentModal(
            itemId,
            itemName,
            itemThumbnail,
            itemQuantity,
            itemPrice
        ) {
            // 商品名の設定
            document.getElementById("modal-item-name").innerText = itemName;

            // 商品サムネイルの設定
            document.getElementById("modal-item-thumbnail").src = itemThumbnail;

            // 数量の設定
            document.getElementById("modal-item-quantity").innerText = itemQuantity;

            // 単価の設定
            document.getElementById(
                "modal-item-price"
            ).innerText = `${itemPrice.toLocaleString()}円`;

            // 合計金額の計算と設定
            const totalPrice = itemQuantity * itemPrice;
            document.getElementById(
                "modal-item-total"
            ).innerText = `${totalPrice.toLocaleString()}円`;

            // 商品IDと数量のhiddenフィールドに値を設定
            document.getElementById("modal-item-id").value = itemId;
            document.getElementById("modal-item-count").value = itemQuantity;

            // モーダルを表示
            const paymentModal = new bootstrap.Modal(
                document.getElementById("paymentModal")
            );
            paymentModal.show();
        }

        // 商品情報を取得し、モーダルを表示する例
        document.querySelectorAll(".open-payment-modal").forEach((button) => {
            button.addEventListener("click", function() {
                const itemId = this.getAttribute("data-item-id");
                const itemName = this.getAttribute("data-item-name");
                const itemThumbnail = this.getAttribute("data-item-thumbnail");
                // const itemQuantity = this.getAttribute("data-item-quantity");
                const itemPrice = this.getAttribute("data-item-price");
                const itemQuantity = document.getElementById("item-quantity").value;
                // 数量と単価から合計金額を計算
                const totalPrice = itemQuantity * itemPrice;

                // モーダルにデータをセット
                document.getElementById("modal-item-id").value = itemId;
                document.getElementById("modal-item-name").textContent = itemName;
                document.getElementById("modal-item-thumbnail").src = itemThumbnail;
                document.getElementById("modal-item-quantity").textContent =
                    itemQuantity;
                document.getElementById("modal-item-price").textContent = itemPrice;
                document.getElementById("modal-item-total").textContent =
                    totalPrice;

                // 単価と合計金額をフォーマットして表示
                document.getElementById("modal-item-price").textContent = formatPrice(
                itemPrice);
                document.getElementById("modal-item-total").textContent = formatPrice(
                    totalPrice);
                document.getElementById("modal-item-count").value = itemQuantity;

                // モーダル表示
                const paymentModal = new bootstrap.Modal(
                    document.getElementById("paymentModal")
                );
                paymentModal.show();
            });
        });
    });
</script>

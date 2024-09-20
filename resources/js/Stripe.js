document.addEventListener("DOMContentLoaded", function () {
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

    form.addEventListener("submit", function (event) {
        event.preventDefault();

        stripe.createToken(cardNumber).then(function (result) {
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
        button.addEventListener("click", function () {
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
            document.getElementById("modal-item-price").textContent = formatPrice(itemPrice);
            document.getElementById("modal-item-total").textContent = formatPrice(totalPrice);
            document.getElementById("modal-item-count").value = itemQuantity;

            // モーダル表示
            const paymentModal = new bootstrap.Modal(
                document.getElementById("paymentModal")
            );
            paymentModal.show();
        });
    });
});

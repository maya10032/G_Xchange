<form action="{{ route('payment') }}" method="post">
    @csrf
    <script src="https://checkout.pay.jp/" class="payjp-button" data-key="{{ config('payjp.public_key') }}"
        data-text="カード情報を入力" data-submit-text="カードを登録する"></script>
</form>

@extends('layouts.app')

@section('title', 'お問い合わせ入力フォーム')

@section('content')

    {{-- @if ($errors->any())
        @include('common.errors')
    @endif --}}

    <form method="post" action="{{ route('contact.post') }}" novalidate>
        <!-- ディレクティブでCSRFを指定 -->
        @csrf

        <div>氏名：
            <input id="name" type="text" class="@error('name') is-invalid @enderror" name="name"
                value="{{ old('name') }}" required autocomplete="name" autofocus>
            @error('name')
                <div style="color: red">{{ $message }}</div>
                </span>
            @enderror
        </div>
        <div>メールアドレス：
            <input id="email" type="text" class="@error('email') is-invalid @enderror" name="email">
            @error('email')
                <div style="color: red">{{ $message }}</div>
            @enderror
        </div>

        <div>お問い合わせ項目：
            <input type="radio" name="radio" value='商品について'{{ old('radio','商品について') === '商品について' ? 'checked' : '' }}>
            <label for="titel_item">商品について　</label>
            <input type="radio" name="radio" value="配送について"{{ old('radio') === '配送について' ? 'checked' : '' }}>
            <label for="titel_delivery">配送について　</label>
            <input type="radio" name="radio" value="お支払いについて"{{ old('radio') === 'お支払いについて' ? 'checked' : '' }}>
            <label for="titel_pay">お支払いについて　</label>
            <input type="radio" name="radio" value="その他"{{ old('radio') === 'その他' ? 'checked' : '' }}>
            <label for="titel_others">その他　</label>
        </div>
        <div>お問い合わせ内容：</div>
        <textarea name="body" rows="10" placeholder="お問い合わせ本文">{{ old('body', isset($input->body) ? $input->body : '') }}</textarea>
        @error('body')
                <div style="color: red">{{ $message }}</div>
            @enderror
        <div><a href="{{ url('/') }}">戻 る</a></div>
        <button type="submit" class="btn btn-secondary btn-lg">
            <i class="fa fa-chevron-right"></i>確認画面へ
        </button>
    </form>
@endsection

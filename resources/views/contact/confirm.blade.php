@extends('layouts.app')

@section('title', 'お問い合わせ内容確認画面')

@section('content')
    <form method="post" action="{{ route('contact.send') }}" class="row">
        @csrf
        <div class="input-group-text"><i class="fa fa-id-card-o"></i>氏名</div>
        <input disabled class="form-control" value="{{ $input['name'] }}">
        <div class="input-group-text"><i class="fa fa-envelope"></i>メールアドレス</div>
        <input disabled class="form-control" value="{{ $input['email'] }}">
        <div class="input-group-text"><i class="fa fa-indent"></i>お問い合わせ項目</div>
        <input disabled class="form-control" value="{{ $input['radio'] }}">
        <textarea disabled rows="10" class="form-control">{{ $input['body'] }}</textarea>
        <div class="d-grid gap-2">
            <button type="submit" name="back" class="btn btn-outline-secondary btn-lg">
                <i class="fa fa-mail-reply"></i>フォームに戻る
            </button>
        </div>
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-secondary btn-lg">
                <i class="fa fa-chevron-right"></i>送信する
            </button>
        </div>
    </form>
@endsection

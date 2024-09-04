@extends('layouts.app')

@section('title', 'お問い合わせ内容確認画面')

@section('content')
    <div class="bg-info contact4 overflow-hidden position-relative">
        <div class="row no-gutters ">
            <div class="container">
                <div class="col-lg-6 contact-box mb-4 mb-md-0 container">
                    <div class="container">
                        <h1 class="title font-weight-light mt-2">お問い合わせ内容確認</h1>
                        <form method="post" action="{{ route('contact.send') }}" class="row">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group row mt-2">
                                        <div class="col-sm-3 col-form-label">お名前：</div>
                                        <div class="col-sm-9">
                                            <input disabled class="form-control" value="{{ $input['name'] }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group row mt-2">
                                        <div class="col-sm-3 col-form-label">メールアドレス：</div>
                                        <div class="col-sm-9">
                                            <input disabled class="form-control" value="{{ $input['email'] }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group row mt-2">
                                        <div class="col-sm-3 col-form-label">お問い合わせ項目：</div>
                                        <div class="col-sm-9">
                                            <input disabled class="form-control" value="{{ $input['radio'] }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group row mt-2">
                                        <div class="col-sm-3 col-form-label">メッセージ：</div>
                                        <div class="col-sm-9">
                                            <textarea disabled rows="10" class="form-control">{{ $input['body'] }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 d-flex align-items-center mt-3">
                                    <button type="submit" name="back" class="btn btn-secondary text-light  px-3 py-2">
                                        フォームに戻る
                                    </button>
                                    <button type="submit" class="btn bg-dark text-light  px-3 py-2" style="margin-left: 10px;">
                                        送信する
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

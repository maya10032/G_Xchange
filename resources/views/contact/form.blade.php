@extends('layouts.app')

@section('title', 'お問い合わせ入力フォーム')

@section('content')
    <div class="py-3 container sticky-top" style="min-height: calc(100vh - 100px);">
        <div class="d-flex">
            <div class="d-flex flex-column me-2 mb-2 reduce-margin" style="flex: 1;">
                <div class="ms-auto" style="flex: 1;">
                    <div class="container">
                        <h1 class="title font-weight-light mt-2"><i class="fas fa-envelope"
                                style="color: #f8a1a8; margin-right: 8px;"></i>お問い合わせ</h1>
                        <form method="post" action="{{ route('contact.post') }}" novalidate>
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group row mt-2">
                                        <label for="name" class="col-sm-3 col-form-label ">お名前：</label>
                                        <div class="col-sm-9">
                                            <input id="name"
                                                class="form-control text-black @error('name') is-invalid @enderror"
                                                type="text" name="name" placeholder="お名前を入力してください"
                                                value="{{ old('name') }}" required autocomplete="name" autofocus>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group row mt-2">
                                        <label for="email" class="col-sm-3 col-form-label ">メールアドレス：</label>
                                        <div class="col-sm-9">
                                            <input id="email"
                                                class="form-control text-black @error('email') is-invalid @enderror"
                                                type="text" name="email" placeholder="メールアドレスを入力してください"
                                                value="{{ old('email') }}" required autocomplete="email" autofocus>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group row mt-1">
                                        <label for="radio" class="col-sm-3 col-form-label d-block">お問い合わせ項目：</label>
                                        <div class="col-sm-9 d-flex flex-wrap radio-group inline">
                                            <div class="form-check mr-3" style="font-size: 0.9em">
                                                <input class="form-check-input" type="radio" id="item" name="radio"
                                                    value="商品について"
                                                    {{ old('radio', '商品について') === '商品について' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="item">商品について</label>
                                            </div>
                                            <div class="form-check mr-3" style="font-size: 0.9em">
                                                <input class="form-check-input" type="radio" id="delivery" name="radio"
                                                    value="配送について" {{ old('radio') === '配送について' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="delivery">配送について</label>
                                            </div>
                                            <div class="form-check mr-3" style="font-size: 0.9em">
                                                <input class="form-check-input" type="radio" id="payment" name="radio"
                                                    value="お支払いについて" {{ old('radio') === 'お支払いについて' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="payment">お支払いについて</label>
                                            </div>
                                            <div class="form-check mr-3" style="font-size: 0.9em">
                                                <input class="form-check-input" type="radio" id="others" name="radio"
                                                    value="その他" {{ old('radio') === 'その他' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="others">その他</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group row mt-2">
                                        <label for="body" class="col-sm-3 col-form-label ">メッセージ：</label>
                                        <div class="col-sm-9">
                                            <textarea id="body" rows="8" class="form-control text-black @error('body') is-invalid @enderror"
                                                rows="3" name="body" placeholder="お問い合わせ本文">{{ old('body', isset($input->body) ? $input->body : '') }}</textarea>
                                            @error('body')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 d-flex align-items-center mt-4">
                                    <button type="submit"
                                        class="btn bg-danger text-light px-5 py-2 hover-effect"><span>確認画面へ</span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 right-image p-r-0">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12961.897477821978!2d139.69161119999998!3d35.68994255!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60188cd4cfbaff57%3A0x12385d2a418fd33d!2z44CSMTYwLTAwMjMg5p2x5Lqs6YO95paw5a6_5Yy66KW_5paw5a6_!5e0!3m2!1sja!2sjp!4v1725429289273!5m2!1sja!2sjp"
                    width="100%" height="538" frameborder="0" style="border:0" allowfullscreen data-aos="fade-left"
                    data-aos-duration="3000"></iframe>
            </div>
        </div>
    </div>
@endsection

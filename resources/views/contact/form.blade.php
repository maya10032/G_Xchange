@extends('layouts.app')

@section('title', 'お問い合わせ入力フォーム')

@section('content')
    <form method="post" action="{{ route('contact.post') }}" novalidate>
        @csrf
        <section class="text-gray-600 body-font relative">
            <div class="container px-5 py-24 mx-auto flex sm:flex-nowrap flex-wrap">
                <div
                    class="lg:w-2/3 md:w-1/2 bg-gray-300 rounded-lg overflow-hidden sm:mr-10 p-10 flex items-end justify-start relative">
                    <iframe width="100%" height="100%" class="absolute inset-0" frameborder="0" title="map"
                        marginheight="0" marginwidth="0" scrolling="no"
                        src="https://maps.google.com/maps?width=100%&amp;height=600&amp;hl=en&amp;q=%C4%B0zmir+(My%20Business%20Name)&amp;ie=UTF8&amp;t=&amp;z=14&amp;iwloc=B&amp;output=embed"
                        style="filter: grayscale(1) contrast(1.2) opacity(0.4);"></iframe>
                    <div class="bg-white relative flex flex-wrap py-6 rounded shadow-md">
                        <div class="lg:w-1/2 px-6">
                            <h2 class="title-font font-semibold text-gray-900 tracking-widest text-xs">住所</h2>
                            <p class="mt-1">Photo booth tattooed prism, portland taiyaki hoodie neutra typewriter</p>
                        </div>
                        <div class="lg:w-1/2 px-6 mt-4 lg:mt-0">
                            <h2 class="title-font font-semibold text-gray-900 tracking-widest text-xs">メールアドレス</h2>
                            <a class="text-indigo-500 leading-relaxed">example@email.com</a>
                            <h2 class="title-font font-semibold text-gray-900 tracking-widest text-xs mt-4">電話番号</h2>
                            <p class="leading-relaxed">123-456-7890</p>
                        </div>
                    </div>
                </div>
                <div class="lg:w-1/3 md:w-1/2 bg-white flex flex-col md:ml-auto w-full md:py-8 mt-8 md:mt-0">
                    <h2 class="text-gray-900 text-lg mb-1 font-medium title-font"><i
                            class="fa fa-envelope-o m-1"></i>{{ __('contact') }}</h2>
                    <p class="leading-relaxed mb-5 text-gray-600">Post-ironic portland shabby chic echo park, banjo fashion
                        axe</p>
                    <div class="relative mb-4">
                        <label for="name" class="leading-7 text-sm text-gray-600">氏名：</label>
                        <input type="text" id="name" name="name"
                            class="@error('name') is-invalid @enderror w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"
                            value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                            <div style="color: red">{{ $message }}</div>
                            </span>
                        @enderror
                    </div>
                    <div class="relative mb-4">
                        <label for="email" class="leading-7 text-sm text-gray-600">メールアドレス：</label>
                        <input type="email" id="email" name="email"
                            class="@error('email') is-invalid @enderror w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        @error('email')
                            <div style="color: red">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>お問い合わせ項目：
                        <input type="radio" name="radio"
                            value='商品について'{{ old('radio', '商品について') === '商品について' ? 'checked' : '' }}>
                        <label for="titel_item">商品について　</label>
                        <input type="radio" name="radio" value="配送について"{{ old('radio') === '配送について' ? 'checked' : '' }}>
                        <label for="titel_delivery">配送について　</label>
                        <input type="radio" name="radio"
                            value="お支払いについて"{{ old('radio') === 'お支払いについて' ? 'checked' : '' }}>
                        <label for="titel_pay">お支払いについて　</label>
                        <input type="radio" name="radio" value="その他"{{ old('radio') === 'その他' ? 'checked' : '' }}>
                        <label for="titel_others">その他　</label>
                    </div>
                    <div class="relative mb-4">
                        <label for="body" class="leading-7 text-sm text-gray-600">お問い合わせ内容：</label>
                        <textarea id="body" name="body" rows="10" placeholder="お問い合わせ本文"
                            class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">
                            {{ old('body', isset($input->body) ? $input->body : '') }}
                        </textarea>
                        @error('body')
                            <div style="color: red">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit"
                        class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">
                        <i class="fa fa-chevron-right"></i>確認画面へ
                    </button>
                    <div><a href="{{ url('/') }}">戻 る</a></div>
                </div>
            </div>
        </section>
    </form>
    {{-- <div>
            <input id="name" type="text" class="@error('name') is-invalid @enderror" name="name"
                value="{{ old('name') }}" required autocomplete="name" autofocus>
            @error('name')
                <div style="color: red">{{ $message }}</div>
                </span>
            @enderror
        </div> --}}
    {{-- <div>メールアドレス：
            <input id="email" type="text" class="@error('email') is-invalid @enderror" name="email">
            @error('email')
                <div style="color: red">{{ $message }}</div>
            @enderror
        </div> --}}

    {{-- <div>お問い合わせ項目：
            <input type="radio" name="radio" value='商品について'{{ old('radio', '商品について') === '商品について' ? 'checked' : '' }}>
            <label for="titel_item">商品について　</label>
            <input type="radio" name="radio" value="配送について"{{ old('radio') === '配送について' ? 'checked' : '' }}>
            <label for="titel_delivery">配送について　</label>
            <input type="radio" name="radio" value="お支払いについて"{{ old('radio') === 'お支払いについて' ? 'checked' : '' }}>
            <label for="titel_pay">お支払いについて　</label>
            <input type="radio" name="radio" value="その他"{{ old('radio') === 'その他' ? 'checked' : '' }}>
            <label for="titel_others">その他　</label>
        </div> --}}
    {{-- <div>お問い合わせ内容：</div>
        <textarea name="body" rows="10" placeholder="お問い合わせ本文">{{ old('body', isset($input->body) ? $input->body : '') }}</textarea>
        @error('body')
            <div style="color: red">{{ $message }}</div>
        @enderror --}}
    {{-- <div><a href="{{ url('/') }}">戻 る</a></div>
        <button type="submit" class="btn btn-secondary btn-lg">
            <i class="fa fa-chevron-right"></i>確認画面へ
        </button> --}}

@endsection

@extends('layouts.app')

@section('title', '商品詳細')

@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
    @endsection









{{-- @extends('layouts.app')

@section('title', '会員情報変更')

@section('content')
    <h2>会員情報変更画面</h2>
    <tbody>
        {{-- @foreach ($users as $user) --}}
        氏名：<input type="text" value="{{ old($user->name, ['id' =>'name']) }}"></input>
        {{-- <input type="text">電話番号：{{ $user->phone ['id' =>'name']}}</input> --}}
        {{-- @endforeach --}}
    </tbody>
    <a href="{{ url('/') }}">商品一覧に戻る</a>
@endsection --}}

{{-- {{ Debugbar::log($items->toArray()) }} --}}

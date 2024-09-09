@extends('layouts.admin')

@section('content')
    <div class="py-1 container sticky-top" style="min-height: calc(100vh - 100px);">
        <h2 class="py-2 admin">アカウント情報変更</h2>
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">アカウント情報変更画面</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.profile.update') }}">
                            @csrf
                            @method('PATCH')
                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name', $admin->name) }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email', $admin->email) }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end"></label>
                                    <label class="text-center"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                        アカウント情報を変更するには現在のパスワードを入力してください</label>
                                        @if (session('ConfirmPassword'))
                                        <div class="text-danger fw-bold mt-3">
                                            ※{{ session('ConfirmPassword') }}
                                        </div>
                                    @endif
                            </div>
                                <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary text-light px-4 py-2 hover-effect">
                                        更新
                                    </button>
                                    <button type="submit" class="btn btn-secondary text-light px-4 py-2 hover-effect">
                                        <a href="{{ route('admin.profile.show') }}"
                                        class="flex ml-2 text-white py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-decoration-none"
                                        >キャンセル</a>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection

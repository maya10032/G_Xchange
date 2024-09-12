@extends('layouts.admin')

@section('content')
<topnav class="topnav">
        <ul>
            <li><a class="current" href="{{ url('admin/profile') }}">アカウント情報</a></li>
        </ul>
    </topnav>
    <h2 class="py-2 admin">アカウント情報変更</h2>
    <div class="card container" style="width: 1000px;">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.profile.update') }}" novalidate>
                @csrf
                @method('PATCH')
                <div class="row mb-3 py-2">
                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name', $admin->name) }}" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email', $admin->email) }}" required autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="email" class="col-md-4 col-form-label text-md-end"></label>
                    <label class="text-center"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                        アカウント情報を変更するには現在のパスワードを入力してください</label>
                    @if (session('ConfirmPassword'))
                        <div class="text-danger fw-bold mt-3">
                            ※{{ session('ConfirmPassword') }}
                        </div>
                    @endif
                </div>
                <div class="row mb-3">
                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <h5 style="padding-top: 50px;">電子メール受信設定</h5>
                <div class="">
                    <div class="form-check mb-2" style="font-size: 1em">
                        <input class="form-check-input" type="checkbox" id="item" name="checkbox"
                            value="【一般的なメール】すべてのアカウント関連の案内"{{ old('checkbox', '【一般的なメール】すべてのアカウント関連の案内') === '【一般的なメール】すべてのアカウント関連の案内' ? 'checked' : '' }}>

                        <label class="form-check-label" for="item">【一般的なメール】すべてのアカウント関連の案内</label>
                    </div>
                    <div class="form-check mb-2" style="font-size: 1em">
                        <input class="form-check-input" type="checkbox" id="delivery" name="checkbox"
                            value="【請求書のメール】新しい請求書、リマインダー、および期限切れの案内"
                            {{ old('checkbox', '【請求書のメール】新しい請求書、リマインダー、および期限切れの案内') === '【請求書のメール】新しい請求書、リマインダー、および期限切れの案内' ? 'checked' : '' }}>
                        <label class="form-check-label" for="delivery">【請求書のメール】新しい請求書、リマインダー、および期限切れの案内</label>
                    </div>
                    <div class="form-check mb-2" style="font-size: 1em">
                        <input class="form-check-input" type="checkbox" id="payment" name="checkbox"
                            value="【サポートメール】すべてのサポートチケットコミュケーションのCCを受信します。"
                            {{ old('checkbox', '【サポートメール】すべてのサポートチケットコミュケーションのCCを受信します。') === '【サポートメール】すべてのサポートチケットコミュケーションのCCを受信します。' ? 'checked' : '' }}>
                        <label class="form-check-label" for="payment">【サポートメール】すべてのサポートチケットコミュケーションのCCを受信します。</label>
                    </div>
                    <div class="form-check mb-4" style="font-size: 1em">
                        <input class="form-check-input" type="checkbox" id="others" name="checkbox"
                            value="【ドメイン関連のメール】登録/移管の確認と転送、または更新の案内"
                            {{ old('checkbox', 'ドメイン関連のメール】登録/移管の確認と転送、または更新の案内') === 'ドメイン関連のメール】登録/移管の確認と転送、または更新の案内' ? 'checked' : '' }}>
                        <label class="form-check-label" for="others">【ドメイン関連のメール】登録/移管の確認と転送、または更新の案内</label>
                    </div>
                </div>
                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary text-light px-4 py-2 hover-effect">
                            更新
                        </button>
                        <button type="submit" class="btn btn-secondary text-light px-4 py-2 hover-effect">
                            <a href="{{ route('admin.profile.show') }}"
                                class="flex ml-2 text-white py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-decoration-none">キャンセル</a>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@extends('layouts.admin')

@section('content')
    <div class="py-1 container sticky-top" style="min-height: calc(100vh - 100px);">
        <h2 class="py-2 admin">アカウント情報</h2>
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">アカウント情報画面</div>
                    @if (session('update'))
                        <div class="alert alert-info text-center fw-bold">
                            {{ session('update') }}
                        </div>
                    @endif
                    <div class="card-body">
                        @csrf
                        @method('PATCH')

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input type="text" readonly class="form-control-plaintext" value="{{ $admin->name }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                            <div class="col-md-6">
                                <input type="text" readonly class="form-control-plaintext" value="{{ $admin->email }}">
                            </div>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary text-light px-4 py-2 hover-effect">
                                    <a href="{{ route('admin.profile.edit') }}"
                                        class="flex ml-2 text-white py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-decoration-none">変更</a>
                                </button>
                                <button type="submit" class="btn btn-danger text-light px-4 py-2 hover-effect">
                                    <a href="" onclick="deleteAdmin()"
                                        class="flex ml-2 text-white py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-decoration-none">
                                        退会</a>
                                </button>
                                <form action="{{ route('admin.profile.destroy') }}" method="post" id="delete-form">
                                    @csrf
                                    @method('delete')
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    <script>
        // 削除確認用のダイアログ表示
        const deleteAdmin = () => {
            //リンクが自動でサーバにリクエストをかけてページ更新するのを停止している
            event.preventDefault()
            confirm('本当に退会してもよろしいですか？') ? document.querySelector('#delete-form').submit() : ''
        }
    </script>

@extends('layouts.admin')

@section('content')
    <topnav class="topnav">
        <ul>
            <li><a class="current" href="{{ url('admin/profile') }}">アカウント情報</a></li>
        </ul>
    </topnav>
    <h2 class="py-2 admin">アカウント情報</h2>
    @if (session('update'))
        <div class="alert alert-info text-center fw-bold">
            {{ session('update') }}
        </div>
    @endif
    <div class="d-flex">
        <div class="container">
            <form>
                @csrf
                @method('PATCH')
                <div class="row py-3">
                    <div class="row mb-1" style="font-size: 1.1em">
                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}：</label>
                        <div class="col-md-6">
                            <input type="text" readonly class="form-control-plaintext" value="{{ $admin->name }}">
                        </div>
                    </div>

                    <div class="row mb-3" style="font-size: 1.1em">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}：</label>
                        <div class="col-md-6">
                            <input type="text" readonly class="form-control-plaintext" value="{{ $admin->email }}">
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="col-md-4 container offset-md-3 d-flex justify-content-end gap-4">
                            <a href="{{ route('admin.profile.update') }}"
                                class="btn btn-primary text-white px-4 py-2 hover-effect text-decoration-none">
                                アカウント情報を変更画面へ
                            </a>
                            <form action="{{ route('admin.profile.destroy') }}" method="POST" class="d-inline ms-4">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete text-light px-4 py-2 hover-effect"
                                    onclick="return confirm('本当に削除しますか？')">
                                    退会
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

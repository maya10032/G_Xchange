@extends('layouts.admin')

@section('title', 'ユーザ情報変更')

@section('content')
    <topnav class="topnav">
        <ul>
            <li><a class="current" href="{{ url('admin/users') }}">ユーザ管理</a></li>
            <li><a class="current" href="{{ route('admin.users.edit', ['id' => $user->id]) }}">ユーザ情報変更</a></li>
        </ul>
    </topnav>
    <h2 class="py-2 admin">ユーザ情報変更</h2>
    <div class="d-flex">
        <form action="{{ route('admin.users.update', ['id' => $user->id]) }}" method="post" novalidate>
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-9">
                    <div class="form-group row mt-3">
                        <label for="id" class="col-sm-3 col-form-label">会員ID：</label>
                        <div class="col-sm-9">
                            <input id="id" disabled class="form-control text-black" type="text" name="id"
                                value="{{ $user->id }}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="form-group row mt-3">
                        <label for="name" class="col-sm-3 col-form-label ">お名前：</label>
                        <div class="col-sm-9">
                            <input id="name" class="form-control text-black @error('name') is-invalid @enderror"
                                type="text" name="name" value="{{ old('name', $user->name) }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="form-group row mt-3">
                        <label for="phone" class="col-sm-3 col-form-label ">電話番号：</label>
                        <div class="col-sm-9">
                            <input id="phone" class="form-control text-black @error('name') is-invalid @enderror"
                                type="text" name="phone" value="{{ old('name', $user->phone) }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="form-group row mt-3">
                        <label for="address" class="col-sm-3 col-form-label ">住所：</label>
                        <div class="col-sm-9">
                            <input id="address" class="form-control text-black @error('name') is-invalid @enderror"
                                type="text" name="address" value="{{ old('name', $user->address) }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="form-group row mt-3">
                        <label for="email" class="col-sm-3 col-form-label ">メールアドレス：</label>
                        <div class="col-sm-9">
                            <input id="email" class="form-control text-black @error('email') is-invalid @enderror"
                                type="text" name="email" value="{{ old('email', $user->email) }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 d-flex align-items-center mt-4">
                    <button type="submit" class="btn bg-primary text-light px-5 py-2 hover-effect"><span>更新</span></button>
                </div>
            </div>
        </form>
    </div>
@endsection

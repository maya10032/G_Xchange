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
    <div class="container">
        <form action="{{ route('admin.users.update', ['id' => $user->id]) }}" method="post">
            @csrf
            @method('PUT')
            <table class="table table-bordered table-striped task-table table-hover">
                <tr>
                    <td>会員ID</td>
                    <td>
                        <input type="number" disabled name="item_code" class="form-control" value="{{ $user->id }}">
                    </td>
                </tr>
                <tr>
                    <td>お名前</td>
                    <td><input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $user->name) }}">
                    </td>
                    @error('name')
                        <div class="invalid-feedback">
                            @foreach ($errors->get('name') as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @enderror
                </tr>
                <tr>
                    <td>電話番号</td>
                    <td><input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                            value="{{ old('phone', $user->phone) }}"></td>
                    </td>
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </tr>
                <tr>
                    <td>住所</td>
                    <td><input type="text" name="address" class="form-control @error('address') is-invalid @enderror"
                            value="{{ old('address', $user->address) }}">
                    </td>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </tr>
                <tr>
                    <td>メールアドレス</td>
                    <td><input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email', $user->email) }}"></td>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </tr>
            </table>
            <div class="btn-group gap-3 mt-4">
                <button type="submit" class="btn bg-primary text-light px-5 py-2 hover-effect"><span>更新</span></button>
            </div>
        </form>
    </div>
@endsection

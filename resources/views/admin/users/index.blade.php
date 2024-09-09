@extends('layouts.admin')

@section('title', 'ユーザ管理一覧')

@section('content')
    <h2>ユーザ管理一覧画面</h2>
    @if (session('userupdate'))
        <div class="alert alert-info text-center fw-bold">
            {{ session('userupdate') }}
        </div>
    @endif
    @if (session('userdelete'))
        <div class="alert alert-info text-center fw-bold">
            {{ session('userdelete') }}
        </div>
    @endif
    {{-- 購入履歴が空だったら --}}
    @if (count($users) == 0)
        <div class="flex items-center justify-center w-full absolute inset-0">
            <h2 class="tracking-widest text-center w-full text-3xl title-font font-light text-gray-600 mb-1">
                {{ __('nouser') }}
            </h2>
        </div>
    @else
        <div class="container mb-2" style="width: 100%;">
            <div class="d-flex justify-content-end mt-3">
                <form class="d-flex" role="search">
                    <input class="form-control me-2 border-secondary" style="width: 600px;" type="search"
                        placeholder="会員ID、お名前、電話番号など" aria-label="Search">
                    <button class="btn btn-secondary" style="width: 80px;" type="submit">{{ __('search') }}</button>
                </form>
                <div class="ms-3">
                    <select class="form-select" aria-label="並び替え">
                        <option selected>並び替え</option>
                        <option value="1">新しい順</option>
                        <option value="2">古い順</option>
                        <option value="3">名前順</option>
                    </select>
                </div>
            </div>
        </div>
        <table class="table table-bordered table-striped task-table table-hover">
            <tr>
                <th>会員ID</th>
                <th>お名前</th>
                <th>電話番号</th>
                <th>住所</th>
                <th>メールアドレス</th>
                <th></th>
                <th></th>
            </tr>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}　様</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->address }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-secondary">
                            <i class="fa fa-pencil-alt" aria-hidden="true"></i> 編集
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary">
                            <i class="fa fa-search" aria-hidden="true"></i> 詳細
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
    @endif

@endsection

{{-- {{ Debugbar::log($items->toArray()) }} --}}

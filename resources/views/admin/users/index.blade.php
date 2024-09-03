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
        <table class="table table-busered table-striped task-table table-hover">
            <thead>
                <tr>
                    <th>会員ID</th>
                    <th>お名前</th>
                    <th>電話番号</th>
                    <th>住所</th>
                    <th>メールアドレス</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}　様</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->address }}</td>
                        <td>{{ $user->email }}</td>
                        <td><button><a href="{{ route('admin.users.show', $user->id) }}">編集</button></td>
                        <td><button><a href="{{ route('admin.users.edit', $user->id) }}">削除</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

@endsection

{{-- {{ Debugbar::log($items->toArray()) }} --}}

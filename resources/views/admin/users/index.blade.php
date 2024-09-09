@extends('layouts.admin')

@section('title', 'ユーザ管理一覧')

@section('content')
    <topnav class="topnav">
        <ul>
            <li><a class="current" href="{{ url('admin/users') }}">ユーザ管理</a></li>
        </ul>
    </topnav>
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
    <h2 class="py-2 admin">ユーザ管理</h2>
    <table class="table table-bordered table-striped task-table table-hover">
        <tr>
            <th>会員ID</th>
            <th>お名前</th>
            <th>電話番号</th>
            <th>住所</th>
            <th>メールアドレス</th>
            <th style="width: 290px;"></th>
        </tr>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}　様</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->address }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-primary mx-2">
                        <i class="fa fa-search" aria-hidden="true"></i> 詳細
                    </a>
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-secondary mx-2">
                        <i class="fa fa-pencil-alt" aria-hidden="true"></i> 編集
                    </a>
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger mx-2" onclick="return confirm('本当に削除しますか？')">
                            <i class="fa fa-trash" aria-hidden="true"></i> 削除
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $users->links() }}
@endsection

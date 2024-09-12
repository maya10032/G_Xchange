@extends('layouts.admin')

@section('title', 'ユーザ管理一覧')

@section('content')
    <topnav class="topnav">
        <ul>
            <li><a class="current" href="{{ url('admin/users') }}">ユーザ管理</a></li>
        </ul>
    </topnav>
    <h2 class="py-2 admin">ユーザ管理</h2>
    @if (session('userupdate'))
        <div class="alert-green-line mb-2" style="font-size: 1.25rem;">
            {{ session('userupdate') }}
        </div>
    @endif
    @if (session('userdelete'))
        <div class="alert-red-line mb-2" style="font-size: 1.25rem;">
            {{ session('userdelete') }}
        </div>
    @endif
    <div class="container mb-2" style="width: 100%;">
        <div class="d-flex justify-content-end mt-3">
            <form class="d-flex" role="search" method="GET" action="{{ route('admin.users.search') }}">
                <input class="form-control me-2 border-secondary" style="width: 600px;" type="search" name="search"
                    placeholder="お名前、電話番号など" aria-label="Search" value="{{ old('search', $search ?? '') }}">
                <button class="btn btn-dark" style="width: 80px;" type="submit">{{ __('search') }}</button>
            </form>
        </div>
    </div>
    @if (isset($query))
        @if ($users->isEmpty())
            <h3>検索結果: {{ $query }} に該当する商品はありませんでした。</h3>
        @else
            <h3>検索結果: ”{{ $query }}”</h3>
        @endif
    @endif
    <table class="table table-bordered table-striped task-table table-hover">
        <tr>
            <th>@sortablelink('id', '会員ID')</th>
            <th>@sortablelink('name', 'お名前')</th>
            <th>@sortablelink('phone', '電話番号')</th>
            <th>@sortablelink('address', '住所')</th>
            <th>@sortablelink('email', 'メールアドレス')</th>
            <th style="width: 290px;"></th>
        </tr>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->address }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-detail mx-2">
                        <i class="fa fa-search" aria-hidden="true"></i> 詳細
                    </a>
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-edit mx-2">
                        <i class="fa fa-pencil-alt" aria-hidden="true"></i> 編集
                    </a>
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete mx-2" onclick="return confirm('本当に削除しますか？')">
                            <i class="fa fa-trash" aria-hidden="true"></i> 削除
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $users->links() }}
@endsection

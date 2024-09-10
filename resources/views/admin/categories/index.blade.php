@extends('layouts.admin')

@section('title', 'カテゴリー管理')

@section('content')
    <topnav class="topnav">
        <ul>
            <li><a class="current" href="{{ url('admin/categories') }}">カテゴリー管理</a></li>
        </ul>
    </topnav>
    <h2 class="py-2 admin">カテゴリー管理</h2>
    @if (session('create'))
        <div class="alert-blue-line mb-2" style="font-size: 1.25rem;">
            {{ session('create') }}
        </div>
    @elseif (session('delete'))
        <div class="alert-red-line mb-2" style="font-size: 1.25rem;">
            {{ session('delete') }}
        </div>
    @elseif (session('success'))
        <div class="alert-green-line mb-2" style="font-size: 1.25rem;">
            {{ session('success') }}
        </div>
    @endif
    <div class="container mb-2" style="width: 100%;">
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary"
                    style="width: 400px; font-size: 1rem;">新規作成</a>
            </div>
            <div class="d-flex justify-content-end mt-3">
                <form class="d-flex" role="search" method="GET" action="{{ route('admin.categories.search') }}">
                    <input class="form-control me-2 border-secondary" style="width: 600px;" type="search" name="search"
                        placeholder="カテゴリー名など" aria-label="Search" value="{{ old('search', $search ?? '') }}">
                    <button class="btn btn-dark" style="width: 80px;" type="submit">{{ __('search') }}</button>
                </form>
            </div>
        </div>
    </div>
    @if (isset($query))
        <h3>検索結果: "{{ $query }}"</h3>
    @endif
    <table class="table table-bordered table-striped task-table table-hover">
        <tr>
            <th scope="col" style="width: 50px;">@sortablelink('id', 'ID')</th>
            <th scope="col">@sortablelink('category_name', 'カテゴリー名')</th>
            <th scope="col">@sortablelink('items_count', '件数')</th>
            <th scope="col">@sortablelink('created_at', '作成日時')</th>
            <th scope="col">@sortablelink('updated_at', '更新日時')</th>
            <th scope="col" style="width: 180px;"></th>
        </tr>
        @foreach ($categories as $category)
            <tr>
                <td scope="row">{{ $category->id }}</td>
                <td>{{ $category->category_name }}</td>
                <td>{{ $category->items_count }}件</td>
                <td>{{ $category->created_at }}</td>
                <td>{{ $category->updated_at }}</td>
                <td>
                    <a href="{{ route('admin.categories.edit', ['id' => $category->id]) }}" class="btn btn-edit mx-2">
                        <i class="fa fa-pencil-alt" aria-hidden="true"></i> 編集
                    </a>
                    <form action="{{ route('admin.categories.destroy', ['id' => $category->id]) }}" method="POST"
                        style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete" onclick="return confirm('本当に削除しますか？')">
                            <i class="fa fa-trash" aria-hidden="true"></i> 削除
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <div class="d-flex justify-content-center my-2">
        {{ $categories->links() }}
    </div>
@endsection

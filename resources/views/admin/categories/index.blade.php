@extends('layouts.admin')

@section('title', 'カテゴリー管理')

@section('content')
    <topnav>
        <ul>
            <li><a class="current" href="{{ url('admin/categories') }}">カテゴリー管理</a></li>
        </ul>
    </topnav>
    @if (session('attention'))
        <div class="alert alert-danger">
            {{ session('attention') }}
        </div>
    @endif
    <h2 class="py-2 admin">カテゴリー一覧</h2>
    <div class="container mb-2" style="width: 100%;">
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary" style="width: 400px; font-size: 1rem;">新規作成</a>
            </div>
            <div class="d-flex">
                <form class="d-flex me-3" role="search" method="GET" action="{{ route('admin.items.search') }}">
                    <input class="form-control me-2 border-secondary" style="width: 500px;" type="search" name="search"
                        placeholder="カテゴリー名など" aria-label="Search" value="{{ old('search', $search ?? '') }}">
                    <button class="btn btn-secondary" style="width: 80px;" type="submit">{{ __('search') }}</button>
                </form>
                <select class="form-select" aria-label="並び替え">
                    <option selected>並び替え</option>
                    <option value="1">新しい順</option>
                    <option value="2">古い順</option>
                    <option value="3">件数多い順</option>
                    <option value="4">件数少ない順</option>
                </select>
            </div>
        </div>
    </div>
    <table class="table table-bordered table-striped task-table table-hover">
        <tr>
            <td>カテゴリーID</td>
            <td>カテゴリー名</td>
            <td>件数</td>
            <td>作成日</td>
            <td>更新日</td>
            <td></td>
        </tr>
        @foreach ($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->category_name }}</td>
                <td>{{ $category->items_count }}件</td>
                <td>{{ $category->created_at }}</td>
                <td>{{ $category->updated_at }}</td>
                <td>
                    {{-- <a href="{{ route('admin.items.edit', ['item' => $item->id]) }}">
                        <i class="fas fa-pencil-alt icon-large" aria-hidden="true"></i>
                    </a> --}}
                </td>
                <td>
                    {{-- <form action="{{ route('admin.items.destroy', ['item' => $item->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？')">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                    </form> --}}
                </td>
            </tr>
        @endforeach
    </table>
    <div class="d-flex justify-content-center my-2">
        {{ $categories->links() }}
    </div>
@endsection

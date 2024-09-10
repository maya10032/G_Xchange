@extends('layouts.admin')

@section('title', 'カテゴリー新規作成')

@section('content')
    <topnav class="topnav">
        <ul>
            <li><a class="current" href="{{ url('admin/categories') }}">カテゴリー管理</a></li>
            <li><a class="current" href="{{ url('admin/categories/create') }}">カテゴリー新規作成</a></li>
        </ul>
    </topnav>
    <h2 class="py-2 admin">カテゴリー新規作成</h2>
    <div class="container">
        <form action="{{ route('admin.categories.store') }}" method="post">
            @csrf
            <table class="table-custom">
                <tr>
                    <td>カテゴリーID</td>
                    <td>
                        <input type="text" disabled class="form-control" name="item_code" value="{{ $nextId }}">
                        <p>※割り当てられる予定のID番号を表示しています。</p>
                    </td>
                </tr>
                <tr>
                    <td>カテゴリー名</td>
                    <td>
                        <input type="text" name="category_name"
                            class="form-control @error('category_name') is-invalid @enderror"
                            value="{{ old('category_name', $category->category_name ?? '') }}">
                        @error('category_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>
            </table>
            <div class="col-lg-9 d-flex justify-content-end align-items-center mt-4">
                <button type="submit" class="btn bg-primary text-light px-5 py-2 hover-effect">
                    <span>作成</span>
                </button>
            </div>
        </form>
    </div>

@endsection

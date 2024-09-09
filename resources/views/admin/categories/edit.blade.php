@extends('layouts.admin')

@section('title', 'カテゴリー編集')

@section('content')
    <topnav>
        <ul>
            <li><a class="current" href="{{ url('admin/categories') }}">カテゴリー管理</a></li>
            <li><a class="current" href="{{ route('admin.categories.edit', ['id' => $category->id]) }}">カテゴリー編集</a></li>
        </ul>
    </topnav>
    <h2 class="py-2 admin">カテゴリー変更</h2>
    <div class="container">
        <form action="{{ route('admin.categories.update', $category->id) }}" method="post">
            @csrf
            @method('PUT')
            <table class="table-custom">
                <tr>
                    <td>カテゴリーID</td>
                    <td>
                        <input type="text" class="form-control" name="category_id" disabled value="{{ $category->id }}">
                        <p>※IDの変更はできません。</p>
                    </td>
                </tr>
                <tr>
                    <td>カテゴリー名</td>
                    <td><input type="text" name="category_name"
                            class="form-control @error('category_name') is-invalid @enderror"
                            value="{{ old('category_name', $category->category_name) }}">
                    </td>
                    @error('category_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </tr>
            </table>
            <div class="col-lg-9 d-flex justify-content-end align-items-center mt-4">
                <button type="submit" class="btn bg-danger text-light px-5 py-2 hover-effect">
                    <span>更新</span>
                </button>
            </div>
        </form>
    </div>

@endsection

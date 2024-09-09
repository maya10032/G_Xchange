@extends('layouts.admin')

@section('title', 'カテゴリー管理')

@section('content')
    <topnav>
        <ul>
            <li><a class="current" href="{{ url('admin/categories') }}">カテゴリー管理</a></li>
        </ul>
    </topnav>
@endsection

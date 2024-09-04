@extends('layouts.app')

@section('title', '退会')

@section('content')
<main class="py-1 container sticky-top" style="min-height: calc(100vh - 100px);">

<h2>退会画面</h2>
<h3>本当に退会しますか？</h3>
<form action="{{ route('users.destroy') }}" method="post">
    @csrf
    @method('delete')
    <input type="hidden" name="user_id" >
    <button>退会する</button>
</form>
</main>
@endsection

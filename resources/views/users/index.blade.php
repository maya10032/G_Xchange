@extends('layouts.app')

@section('title', '退会')

@section('content')

<h2>退会画面</h2>
<h3>本当に退会しますか？</h3>
<form action="{{ route('users.destroy') }}" method="post">
    @csrf
    @method('delete')
    <input type="hidden" name="user_id" >
    <button>退会する</button>
</form>
@endsection

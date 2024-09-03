@extends('layouts.admin')

@section('title', '会員情報詳細')

@section('content')
    <h1>会員情報詳細</h1>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">会員情報詳細画面</div>

                    <div class="card-body">
                        <form id="delete-form" method="POST" action="{{ route('admin.users.destroy', $user->id) }}">
                            @csrf
                            @method('patch')
                            @method('delete')

                            <div class="row mb-3">
                                <label for="id" class="col-md-4 col-form-label text-md-end">会員ID</label>
                                <div class="col-md-6">
                                    <p>{{ $user->id }}</p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                                <div class="col-md-6">
                                    <p>{{ $user->name }}</p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="phone"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Phone') }}</label>
                                <div class="col-md-6">
                                    <p>{{ $user->phone }}</p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="address"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Address') }}</label>
                                <div class="col-md-6">
                                    <p>{{ $user->address }}</p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                                <div class="col-md-6">
                                    <p>{{ $user->email }}</p>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" onclick="deleteuser()" class="btn btn-primary" name="action" value="destroy">
                                        削除
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <p><a href="{{ url('admin/users/') }}">ユーザ一覧へ戻る</a></p>
                </div>
            </div>
        </div>
    </div>

    </form>
@endsection

<script>
    // 削除確認用のダイアログ表示
    const deleteuser = () => {
        event.preventDefault()
        confirm('本当に削除しますか？') ? document.querySelector('#delete-form').submit() : ''
    }
</script>


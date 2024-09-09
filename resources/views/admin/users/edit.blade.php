@extends('layouts.admin')

@section('title', 'ユーザ情報詳細')

@section('content')
    <h2 class="py-2 admin">ユーザ情報詳細</h2>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">ユーザ情報詳細画面</div>

                    <div class="card-body">
                        <form id="delete-form" method="POST" action="{{ route('admin.users.destroy', $user->id) }}">
                            @csrf
                            @method('patch')
                            @method('delete')

                            <div class="row mb-3">
                                <label for="id" class="col-md-4 col-form-label text-md-end">ユーザID</label>
                                <div class="col-md-6">
                                    <input type="text" readonly class="form-control-plaintext" value="{{ $user->id }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                                <div class="col-md-6">
                                    <input type="text" readonly class="form-control-plaintext" value="{{ $user->name }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="phone"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Phone') }}</label>
                                <div class="col-md-6">
                                    <input type="text" readonly class="form-control-plaintext" value="{{ $user->phone }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="address"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Address') }}</label>
                                <div class="col-md-6">
                                    <input type="text" readonly class="form-control-plaintext" value="{{ $user->address }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                                <div class="col-md-6">
                                    <input type="text" readonly class="form-control-plaintext" value="{{ $user->email }}">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" onclick="deleteuser()" class="btn btn-danger px-5" name="action" value="destroy">
                                        削除
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <p class="text-center my-3"><a href="{{ url('admin/users/') }}">ユーザ一覧へ戻る</a></p>
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

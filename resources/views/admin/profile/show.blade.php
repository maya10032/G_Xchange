@extends('layouts.admin')

@section('content')
    <div class="py-1 container sticky-top" style="min-height: calc(100vh - 100px);">
        <h2>アカウント情報</h2>
        <div class="row justify-content-center">
            <div class="py-2">
                <div class="card" style="min-height: calc(80vh - 80px);">
                    @if (session('update'))
                        <div class="alert alert-info text-center fw-bold">
                            {{ session('update') }}
                        </div>
                    @endif
                    <div class="card-body">
                            @csrf
                            @method('PATCH')

                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                                <div class="col-md-6">
                                    <p>{{ ( $admin->name) }}</p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                                <div class="col-md-6">
                                    <p>{{ old('email', $admin->email) }}</p>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-danger text-light px-4 py-2 hover-effect">
                                        <a href="{{ route('admin.profile.edit') }}">変更</a>
                                    </button>
                                    <button type="submit" class="btn btn-danger text-light px-4 py-2 hover-effect">
                                        <a href="{{ route('admin.profile.destroy') }}">退会</a>
                                    </button>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

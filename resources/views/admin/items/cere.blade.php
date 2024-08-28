@extends('layouts.admin')

@section('title', '商品編集')

@section('content')

    @if ($errors->any())
        @include('common.errors')
    @endif

        <!-- ディレクティブでCSRFを指定 -->
        @csrf

        <div class="form-group col-md-6 col-xs-12">
            <div class="input-group mb-4">
                <div class="input-group">
                    <div class="input-group-text"><i class="fa fa-id-card-o"></i>　商品ID</div>
                    <input type="text" name="name" class="form-control bg-light" value="{{ old('name', isset($input->name) ? $input->name : '') }}" autofocus>
                </div>
            </div>
        </div>
        <div class="form-group col-md-6 col-xs-12">
            <div class="input-group mb-4">
                <div class="input-group">
                    <div class="input-group-text"><i class="fa fa-envelope"></i>　商品コード</div>
                    <input type="text" name="email" class="form-control" value="{{ old('email', isset($input->email) ? $input->email : '') }}">
                </div>
            </div>
        </div>
        <div class="form-group col-xs-12">
            <div class="input-group mb-4">
                <div class="input-group">
                    <div class="input-group-text"><i class="fa fa-indent"></i>　商品名</div>
                    <input type="text" name="title" class="form-control" value="{{ old('title', isset($input->title) ? $input->title : '') }}">
                </div>
            </div>
        </div>
        <div class="form-group col-xs-12">
            <div class="input-group mb-4">
                <div class="input-group">
                    <div class="input-group-text"><i class="fa fa-indent"></i>　カテゴリー</div>
                    <input type="text" name="title" class="form-control" value="{{ old('title', isset($input->title) ? $input->title : '') }}">
                </div>
            </div>
        </div>
        <div class="form-group col-xs-12">
            <div class="input-group mb-4">
                <div class="input-group">
                    <div class="input-group-text"><i class="fa fa-indent"></i>　最大注文数</div>
                    <input type="text" name="title" class="form-control" value="{{ old('title', isset($input->title) ? $input->title : '') }}">
                </div>
            </div>
        </div>
        <div class="form-group col-xs-12">
            <div class="input-group mb-4">
                <div class="input-group">
                    <div class="input-group-text"><i class="fa fa-indent"></i>　販売価格</div>
                    <input type="text" name="title" class="form-control" value="{{ old('title', isset($input->title) ? $input->title : '') }}">
                </div>
            </div>
        </div>
        <div class="form-group col-xs-12">
            <div class="input-group mb-4">
                <div class="input-group">
                    <div class="input-group-text"><i class="fa fa-indent"></i>　通常価格</div>
                    <input type="text" name="title" class="form-control" value="{{ old('title', isset($input->title) ? $input->title : '') }}">
                </div>
            </div>
        </div>
        <div class="form-group col-xs-12">
            <div class="input-group mb-4">
                <div class="input-group">
                    <div class="input-group-text"><i class="fa fa-indent"></i>　商品画像</div>
                    <input type="text" name="title" class="form-control" value="{{ old('title', isset($input->title) ? $input->title : '') }}">
                </div>
            </div>
        </div>
        <div class="form-group col-xs-12 mb-4">
            <div class="input-group-text"><i class="fa fa-indent"></i>　商品詳細</div>
            <textarea name="body" rows="10" class="form-control" placeholder="お問い合わせ本文">{{ old('body', isset($input->body) ? $input->body : '') }}</textarea>
        </div>
        <div class="form-group col-9">
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-secondary btn-lg">
                    <i class="fa fa-chevron-right"></i>　更新する
                </button>
            </div>
        </div>
@endsection

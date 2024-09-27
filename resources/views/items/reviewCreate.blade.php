@extends('layouts.app')

@section('title', 'レビュー作成')

@section('content')
    <div class="py-1 container sticky-top" style="min-height: calc(120vh - 120px);">
        <h2 class="title--border">この商品のレビューを書く</h2>
        <div class="row justify-content-center">
            <div class="py-2">
                <div class="card" style="min-height: calc(100vh - 100px);">
                    <div class="card-body">
                        <div class="row mb-3">
                            <label for="title" class="col-md-4 col-form-label text-md-end">
                                <img src="{{ asset('storage/images/' . $item->images[$item->thumbnail]->img_path) }}"
                                    alt="Thumbnail" class="img-fluid rounded" id="bigimg"
                                    style="width: 100px; height: 100px; object-fit: cover; box-shadow: 0 2px 7px rgba(0, 0, 0, 0.2);">
                            </label>
                            <div class="col-md-6">
                                {{ $item->item_name }}
                            </div>
                        </div>
                        {{-- <form method="POST" action="{{ route('profile.update') }}" novalidate> --}}
                        @csrf
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">総合評価</label>
                            <div class="col-md-6">
                                <select name="" id="">
                                    <option value="">星1</option>
                                    <option value="">星2</option>
                                    <option value="">星3</option>
                                    <option value="">星4</option>
                                    <option value="">星5</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="title" class="col-md-4 col-form-label text-md-end">レビュータイトル</label>
                            <div class="col-md-6">
                                <input id="title" type="text"
                                    class="form-control @error('title') is-invalid @enderror" name="title"
                                    value="{{ old('title') }}" required autocomplete="title" autofocus
                                    placeholder="もっとも伝えたいポイントは何ですか？">
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="comment" class="col-md-4 col-form-label text-md-end">レビューを追加</label>
                            <div class="col-md-6">
                                <textarea id="comment" rows="8" class="form-control text-black @error('comment') is-invalid @enderror"
                                    rows="3" name="comment" placeholder="気に入ったこと、気に入らなかったとこは何ですか？この製品をどのように使いましたか？">{{ old('comment', isset($input->comment) ? $input->comment : '') }}</textarea>
                                @error('comment')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-danger text-light px-4 py-2 hover-effect">
                                    更新
                                </button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

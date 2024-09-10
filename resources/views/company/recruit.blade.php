@extends('layouts.app')

@section('title', '採用情報')

@section('content')
    <div class="py-2 container sticky-top" style="min-height: calc(80vh - 80px);">

        <h2 class="fw-bold title--border">採用情報</h2>
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <div class="col">
                <div class="card border-0" style="width: 18rem; height: 100px;">
                    <img src="{{ asset('images/recruit_career.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h4 class="card-title">キャリア採用</h4>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border-0" style="width: 18rem; height: 100px;">
                    <img src="{{ asset('images/recruit_newgraduates.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h4 class="card-title">新卒採用</h4>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border-0" style="width: 18rem; height: 100px;">
                    <img src="{{ asset('images/recruit_global.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h4 class="card-title">グローバル</h4>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border-0" style="width: 18rem; height: 100px;">
                    <img src="{{ asset('images/recruit_disabledpeople.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h4 class="card-title">障がい者雇用</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

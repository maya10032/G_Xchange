@extends('layouts.app')

@section('title', '採用情報')

@section('content')
    <div class="py-2 container sticky-top" style="min-height: calc(80vh - 80px)">

        <h2 class="fw-bold title--border">採用情報</h2>
        <div class="contents">
            <h3 class="slide-in mocchiri">Jobs</h3>
            <div class="row row-cols-1 row-cols-md-4 g-4 d-flex">
                <div class="col">
                    <div class="card border-0" style="width: 18rem;">
                        <a href="#" class="image_link">
                            <img src="{{ asset('images/recruit_career.jpg') }}" alt="キャリア採用">
                        </a>
                        <div class="card-body" style="height: 50px">
                            <p>キャリア採用</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border-0" style="width: 18rem;">
                        <a href="#" class="image_link">
                            <img src="{{ asset('images/recruit_newgraduates.jpg') }}" alt="新卒採用">
                        </a>
                        <div class="card-body 0" style="height: 50px">
                            <p>新卒採用</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border-0" style="width: 18rem;">
                        <a href="#" class="image_link">
                            <img src="{{ asset('images/recruit_global.jpg') }}" alt="グローバル">
                        </a>
                        <div class="card-body 0" style="height: 50px">
                            <p>グローバル</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border-0" style="width: 18rem;">
                        <a href="#" class="image_link">
                            <img src="{{ asset('images/recruit_disabledpeople.jpg') }}" alt="障がい者雇用">
                        </a>
                        <div class="card-body 0" style="height: 50px">
                            <p>障がい者雇用</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="contents box_row">
            <h3 class="mocchiri">Benefits</h3>
            <div class="autoplay-slider">
                <div class="box3-2 box_slide">
                    <span class="box-title">年次有給休暇</span>
                    <p class="btn">年次有給休暇を入社時に10日間付与します。<br>
                        ※取得率85.0%（2023年度6月時点）</p>
                </div>
                <div class="box3-2 box_slide">
                    <span class="box-title">リラックス休暇</span>
                    <p class="btn">年次有給休暇とは別に、年3日間の休暇を付与します。取得日の指定はありません。</p>
                </div>
                <div class="box3-2 box_slide">
                    <span class="box-title">定期健康診断</span>
                    <p class="btn">年1回、全社員を対象に健康診断を実施しています。基本健診に加え、婦人科検診や1日人間ドックの費用も会社が補助します（年齢によって違いあり）。</p>
                </div>
                <div class="box3-2 box_slide">
                    <span class="box-title">予防接種の費用補助</span>
                    <p class="btn">希望する社員を対象に、インフルエンザの予防接種にかかる費用を補助します。</p>
                </div>
                <div class="box3-2 box_slide">
                    <span class="box-title">年次有給休暇</span>
                    <p class="btn">年次有給休暇を入社時に10日間付与します。<br>
                        ※取得率85.0%（2023年度6月時点）</p>
                </div>
                <div class="box3-2 box_slide">
                    <span class="box-title">リラックス休暇</span>
                    <p class="btn">年次有給休暇とは別に、年3日間の休暇を付与します。取得日の指定はありません。</p>
                </div>
                <div class="box3-2 box_slide">
                    <span class="box-title">定期健康診断</span>
                    <p class="btn">年1回、全社員を対象に健康診断を実施しています。基本健診に加え、婦人科検診や1日人間ドックの費用も会社が補助します（年齢によって違いあり）。</p>
                </div>
                <div class="box3-2 box_slide">
                    <span class="box-title">予防接種の費用補助</span>
                    <p class="btn">希望する社員を対象に、インフルエンザの予防接種にかかる費用を補助します。</p>
                </div>
            </div>
        </div>
        <div class="contents">
            <h3 class="mocchiri">Member</h3>
            <div class="row row-cols-1 row-cols-md-4 g-4 d-flex">
                <div class="col">
                    <div class="card border-0 m-3" style="width: 12rem;">
                        <a href="#">
                            <img src="{{ asset('images/20.jpg') }}" class="card-img-top rounded-circle member_img"
                                alt="猫田 たま">
                        </a>
                        <div class="card-body" style="height: 50px">
                            <p class="card-text text-center">CEO</p>
                            <p class="card-text text-center">猫田 たま</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border-0 m-3" style="width: 12rem;">
                        <a href="#">
                            <img src="{{ asset('images/10.jpg') }}" class="card-img-top rounded-circle member_img"
                                alt="人鳥 まる">
                        </a>
                        <div class="card-body" style="height: 50px">
                            <p class="card-text text-center">Work QA</p>
                            <p class="card-text text-center">人鳥 まる</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border-0 m-3" style="width: 12rem;">
                        <a href="#">
                            <img src="{{ asset('images/07.jpg') }}" class="card-img-top rounded-circle member_img"
                                alt="猿島 えがお">
                        </a>
                        <div class="card-body" style="height: 50px">
                            <p class="card-text text-center">Design System</p>
                            <p class="card-text text-center">猿島 えがお</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border-0 m-3" style="width: 12rem;">
                        <a href="#">
                            <img src="{{ asset('images/09.jpg') }}" class="card-img-top rounded-circle member_img"
                                alt="小熊猫 たつ">
                        </a>
                        <div class="card-body" style="height: 50px">
                            <p class="card-text text-center">AML/CFT</p>
                            <p class="card-text text-center">小熊猫 たつ</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border-0 m-3" style="width: 12rem;">
                        <a href="#">
                            <img src="{{ asset('images/11.jpg') }}" class="card-img-top rounded-circle member_img"
                                alt="犬山 ぽち">
                        </a>
                        <div class="card-body" style="height: 50px">
                            <p class="card-text text-center">Accounting Products</p>
                            <p class="card-text text-center">犬山 ぽち</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border-0 m-3" style="width: 12rem;">
                        <a href="#">
                            <img src="{{ asset('images/14.jpg') }}" class="card-img-top rounded-circle member_img"
                                alt="海狸 きらり">
                        </a>
                        <div class="card-body" style="height: 50px">
                            <p class="card-text text-center">Cross Border</p>
                            <p class="card-text text-center">海狸 きらり</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border-0 m-3" style="width: 12rem;">
                        <a href="#">
                            <img src="{{ asset('images/16.jpg') }}" class="card-img-top rounded-circle member_img"
                                alt="家鴨 きいろ">
                        </a>
                        <div class="card-body" style="height: 50px">
                            <p class="card-text text-center">Fintech BizLegal & Governance</p>
                            <p class="card-text text-center">家鴨 きいろ</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border-0 m-3" style="width: 12rem;">
                        <a href="#">
                            <img src="{{ asset('images/02.jpg') }}" class="card-img-top rounded-circle member_img"
                                alt="豚川 しろ">
                        </a>
                        <div class="card-body" style="height: 50px">
                            <p class="card-text text-center">Mass Marketing</p>
                            <p class="card-text text-center">豚川 しろ</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

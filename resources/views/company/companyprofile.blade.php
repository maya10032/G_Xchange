@extends('layouts.app')

@section('title', '会社概要')

@section('content')
    <div class="container" style="width: 50%;">
        <div class="my-5">
            <h2 class="fw-bold title--border">会社概要</h2>
            <table class="table table-striped">
                <tr>
                    <th>会社名</th>
                    <td>G_Xchange株式会社</td>
                </tr>
                <tr>
                    <th>設立</th>
                    <td>2018年9月</td>
                </tr>
                <tr>
                    <th>所在地</th>
                    <td>〒160-0023 東京都新宿区</td>
                </tr>
                <tr>
                    <th>資本金</th>
                    <td>1億円</td>
                </tr>
                <tr>
                    <th>代表者</th>
                    <td>代表取締役 猫田 たま</td>
                </tr>
                <tr>
                    <th>従業員数</th>
                    <td>80名</td>
                </tr>
                <tr>
                    <th>売上高</th>
                    <td>15億円</td>
                </tr>
                <tr>
                    <th>事業内容</th>
                    <td>リサイクル事業に関するコンプライアンス適正化及び運営管理、<br>
                        環境保全事業に関する企画、マネジメント及びコンサルティング</td>
                </tr>
                <tr>
                    <th>取引先</th>
                    <td>電力会社、建設会社、地方自治体、研究機関</td>
                </tr>
            </table>
        </div>

        <div class="my-5">
            <h2 class="fw-bold title--border">会社沿革</h2>
            <table class="table table-striped">
                <tr>
                    <th>2018年9月</th>
                    <td>グリーンテック株式会社を設立</td>
                </tr>
                <tr>
                    <th>2019年3月</th>
                    <td>横浜研究所開設</td>
                </tr>
                <tr>
                    <th>2020年7月</th>
                    <td>太陽光発電システム事業部を新設</td>
                </tr>
                <tr>
                    <th>2021年11月</th>
                    <td>風力発電プロジェクトを開始</td>
                </tr>
                <tr>
                    <th>2022年4月</th>
                    <td>資本金を1億円に増資</td>
                </tr>
                <tr>
                    <th>2023年8月</th>
                    <td>名古屋支社開設</td>
                </tr>
            </table>
        </div>
    </div>

@endsection

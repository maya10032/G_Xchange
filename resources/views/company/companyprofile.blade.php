@extends('layouts.main')

@section('title', '会社概要')

@section('content')
    <div class="container" style="width: 60%;">
        <div class="my-5">
            <h2 class="company--title--border">会社概要</h2>
            <table class="table table-bordered">
                <tr>
                    <th class="bg-body-secondary text-center">会社名</th>
                    <td class="bg-white">G_Xchange株式会社</td>
                </tr>
                <tr>
                    <th class="bg-body-secondary text-center">設立</th>
                    <td class="bg-white">2018年9月</td>
                </tr>
                <tr>
                    <th class="bg-body-secondary text-center">所在地</th>
                    <td class="bg-white">〒160-0023 東京都新宿区</td>
                </tr>
                <tr>
                    <th class="bg-body-secondary text-center">資本金</th>
                    <td class="bg-white">1億円</td>
                </tr>
                <tr>
                    <th class="bg-body-secondary text-center">代表者</th>
                    <td class="bg-white">代表取締役 猫田 たま</td>
                </tr>
                <tr>
                    <th class="bg-body-secondary text-center">従業員数</th>
                    <td class="bg-white">80名</td>
                </tr>
                <tr>
                    <th class="bg-body-secondary text-center">売上高</th>
                    <td class="bg-white">15億円</td>
                </tr>
                <tr>
                    <th class="bg-body-secondary text-center">事業内容</th>
                    <td class="bg-white">リサイクル事業に関するコンプライアンス適正化及び運営管理、<br>
                        環境保全事業に関する企画、マネジメント及びコンサルティング</td>
                </tr>
                <tr>
                    <th class="bg-body-secondary text-center">取引先</th>
                    <td class="bg-white">電力会社、建設会社、地方自治体、研究機関</td>
                </tr>
                <tr>
                    <th class="bg-body-secondary text-center" rowspan="6">会社沿革</th>
                    <td class="bg-white">2018年9月　G_Xchange株式会社を設立</td>
                    <tr>
                        <td class="bg-white">2019年3月　G研究所開設</td>
                    </tr>
                    <tr>
                        <td class="bg-white">2020年7月　Xchangeシステム事業部を新設</td>
                    </tr>
                    <tr>
                        <td class="bg-white">2021年11月　子猫プロジェクトを開始</td>
                    </tr>
                    <tr>
                        <td class="bg-white">2022年4月　資本金を1億円に増資</td>
                    </tr>
                    <tr>
                        <td class="bg-white">2023年8月　さいたま支社開設</td>
                    </tr>
                </tr>
            </table>
        </div>
    </div>

@endsection

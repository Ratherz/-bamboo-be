@extends('layouts.admin.main')

@section('content')

<section class="user-chart">
    {{-- @if (!Auth::user()->address)

    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>คุณไม่ได้กรอก ที่อยู่ไปกรอกซะ</strong>
    </div>

    @endif --}}
    <h3>ผู้ประกอบการ</h3>
    <div class="card">
        <div class="card-header bg-success ">
            <h3 class="text-white">แผนที่</h3>
        </div>
        <div id="map"></div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-3">
                    <label class="p-0 m-0 mr-2" style="width: 20px;height: 8px;background: #E0BBE4;"></label>
                    <label>ผู้ประกอบการขายปุ๋ยสำหรับไผ่ (BF)</label>
                </div>
                <div class="col-sm-3">
                    <label class="p-0 m-0 mr-2" style="width: 20px;height: 8px;background: #F47C7C;"></label>
                    <label>ผู้ปลูกไผ่ (BPS , BPL , BPF , BPA)</label>
                </div>
                <div class="col-sm-2">
                    <label class="p-0 m-0 mr-2" style="width: 20px;height: 8px;background: #A1DE93;"></label>
                    <label>ผู้รับจ้างตัดส่ง (CD)</label>
                </div>
                <div class="col-sm-3">
                    <label class="p-0 m-0 mr-2" style="width: 20px;height: 8px;background: #70A1D7;"></label>
                    <label>ผู้แปรรูปผลิตภัณฑ์ (SME)</label>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-success text-white">
                    ผู้ประกอบการรายอื่น ๆ
                </div>
                <div class="card-body">
                    <table class="table data-table table-hover table-responsive table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ข้อมูล</th>
                                <th>บทบาท</th>
                                <th>โปรไฟล์</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $idrole = Auth::user()->getIdRoles()
                            @endphp
                            @if($idrole == 9)
                            @foreach(\App\Models\User::whereRaw("id in (select user_id from role_user where role_id
                            BETWEEN 3 and 6 )")->get() as $user)
                            <tr>
                                @php
                                $address = "ที่อยู่ " . $user->address."<br>";
                                $address .= " ,หมู่ที่ " . $user->address_no."<br>";
                                $address .= " ,ซอย " . $user->zoi."<br>";
                                $address .= " ,ถนน " . $user->road."<br>";
                                $address .= " ,ตำบล " . $user->district."<br>";
                                $address .= " ,อำเภอ " . $user->amphure."<br>";
                                $address .= " ,จังหวัด " . $user->province."<br>";
                                @endphp
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div id="user{{ $user->id }}" role="tablist" aria-multiselectable="true">
                                        <div class="card">
                                            <h5 class="mb-0 card-header">
                                                <a data-toggle="collapse" data-parent="#user{{ $user->id }}"
                                                    href="#section{{ $user->id }}" aria-expanded="true"
                                                    aria-controls="section{{ $user->id }}"
                                                    class="btn btn-info text-white">
                                                    {{ $user->first_name }} {{ $user->last_name }}
                                                </a>
                                            </h5>
                                            <div id="section{{ $user->id }}" class="collapse in" role="tabpanel"
                                                aria-labelledby="headerUser{{ $user->id }}">


                                                {!! $address !!}
                                                {{ $user->phone }}
                                                {{ $user->email }}
                                                {{ $user->shop_name }}

                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>{!! $user->getTextRoles() !!}</td>
                                <td><a href="{{ url('shop-store/').'/'.$user->shop_name}}" class="btn btn-info"><i
                                            class="fa fa-user-circle" aria-hidden="true"></i>
                                        ดูโปรไฟล์</a></td>
                            </tr>
                            @endforeach
                            @elseif($idrole == 3 || $idrole == 4 || $idrole == 5 || $idrole == 6)
                            @foreach(\App\Models\User::whereRaw("id in (select user_id from role_user where role_id = 7
                            or role_id = 9)")->get() as $user)
                            <tr>
                                @php
                                $address = "ที่อยู่ " . $user->address."<br>";
                                $address .= " ,หมู่ที่ " . $user->address_no."<br>";
                                $address .= " ,ซอย " . $user->zoi."<br>";
                                $address .= " ,ถนน " . $user->road."<br>";
                                $address .= " ,ตำบล " . $user->district."<br>";
                                $address .= " ,อำเภอ " . $user->amphure."<br>";
                                $address .= " ,จังหวัด " . $user->province."<br>";
                                @endphp
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div id="user{{ $user->id }}" role="tablist" aria-multiselectable="true">
                                        <div class="card">
                                            <h5 class="mb-0 card-header">
                                                <a data-toggle="collapse" data-parent="#user{{ $user->id }}"
                                                    href="#section{{ $user->id }}" aria-expanded="true"
                                                    aria-controls="section{{ $user->id }}"
                                                    class="btn btn-info text-white">
                                                    {{ $user->first_name }} {{ $user->last_name }}
                                                </a>
                                            </h5>
                                            <div id="section{{ $user->id }}" class="collapse in" role="tabpanel"
                                                aria-labelledby="headerUser{{ $user->id }}">


                                                {!! $address !!}
                                                {{ $user->phone }}
                                                {{ $user->email }}
                                                {{ $user->shop_name }}

                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>{!! $user->getTextRoles() !!}</td>
                                <td><a href="{{ url('shop-store/').'/'.$user->shop_name}}" class="btn btn-info"><i
                                            class="fa fa-user-circle" aria-hidden="true"></i>
                                        ดูโปรไฟล์</a></td>
                            </tr>
                            @endforeach
                            @elseif ($idrole == 7)
                            @foreach(\App\Models\User::whereRaw("id in (select user_id from role_user where role_id
                            BETWEEN 3 and 6 or role_id = $idrole+1 )")->get() as $user)
                            <tr>
                                @php
                                $address = "ที่อยู่ " . $user->address."<br>";
                                $address .= " ,หมู่ที่ " . $user->address_no."<br>";
                                $address .= " ,ซอย " . $user->zoi."<br>";
                                $address .= " ,ถนน " . $user->road."<br>";
                                $address .= " ,ตำบล " . $user->district."<br>";
                                $address .= " ,อำเภอ " . $user->amphure."<br>";
                                $address .= " ,จังหวัด " . $user->province."<br>";
                                @endphp
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div id="user{{ $user->id }}" role="tablist" aria-multiselectable="true">
                                        <div class="card">
                                            <h5 class="mb-0 card-header">
                                                <a data-toggle="collapse" data-parent="#user{{ $user->id }}"
                                                    href="#section{{ $user->id }}" aria-expanded="true"
                                                    aria-controls="section{{ $user->id }}"
                                                    class="btn btn-info text-white">
                                                    {{ $user->first_name }} {{ $user->last_name }}
                                                </a>
                                            </h5>
                                            <div id="section{{ $user->id }}" class="collapse in" role="tabpanel"
                                                aria-labelledby="headerUser{{ $user->id }}">


                                                {!! $address !!}
                                                {{ $user->phone }}
                                                {{ $user->email }}
                                                {{ $user->shop_name }}

                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>{!! $user->getTextRoles() !!}</td>
                                <td><a href="{{ url('shop-store/').'/'.$user->shop_name}}" class="btn btn-info"><i
                                            class="fa fa-user-circle" aria-hidden="true"></i>
                                        ดูโปรไฟล์</a></td>
                            </tr>
                            @endforeach
                            @elseif ($idrole == 8)
                            @foreach(\App\Models\User::whereRaw("id in (select user_id from role_user where role_id =
                            $idrole-1 )")->get() as $user)
                            <tr>
                                @php
                                $address = "ที่อยู่ " . $user->address."<br>";
                                $address .= " ,หมู่ที่ " . $user->address_no."<br>";
                                $address .= " ,ซอย " . $user->zoi."<br>";
                                $address .= " ,ถนน " . $user->road."<br>";
                                $address .= " ,ตำบล " . $user->district."<br>";
                                $address .= " ,อำเภอ " . $user->amphure."<br>";
                                $address .= " ,จังหวัด " . $user->province."<br>";
                                @endphp
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div id="user{{ $user->id }}" role="tablist" aria-multiselectable="true">
                                        <div class="card">
                                            <h5 class="mb-0 card-header">
                                                <a data-toggle="collapse" data-parent="#user{{ $user->id }}"
                                                    href="#section{{ $user->id }}" aria-expanded="true"
                                                    aria-controls="section{{ $user->id }}"
                                                    class="btn btn-info text-white">
                                                    {{ $user->first_name }} {{ $user->last_name }}
                                                </a>
                                            </h5>
                                            <div id="section{{ $user->id }}" class="collapse in" role="tabpanel"
                                                aria-labelledby="headerUser{{ $user->id }}">


                                                {!! $address !!}
                                                {{ $user->phone }}
                                                {{ $user->email }}
                                                {{ $user->shop_name }}

                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>{!! $user->getTextRoles() !!}</td>
                                <td><a href="{{ url('shop-store/').'/'.$user->shop_name}}" class="btn btn-info"><i
                                            class="fa fa-user-circle" aria-hidden="true"></i>
                                        ดูโปรไฟล์</a></td>
                            </tr>
                            @endforeach
                            @else
                            @foreach (App\Models\User::whereRaw("id not in (select user_id from role_user where role_id
                            = 1)")->get() as $user)
                            <tr>
                                @php
                                $address = "ที่อยู่ " . $user->address."<br>";
                                $address .= " ,หมู่ที่ " . $user->address_no."<br>";
                                $address .= " ,ซอย " . $user->zoi."<br>";
                                $address .= " ,ถนน " . $user->road."<br>";
                                $address .= " ,ตำบล " . $user->district."<br>";
                                $address .= " ,อำเภอ " . $user->amphure."<br>";
                                $address .= " ,จังหวัด " . $user->province."<br>";
                                @endphp
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div id="user{{ $user->id }}" role="tablist" aria-multiselectable="true">
                                        <div class="card">
                                            <h5 class="mb-0 card-header">
                                                <a data-toggle="collapse" data-parent="#user{{ $user->id }}"
                                                    href="#section{{ $user->id }}" aria-expanded="true"
                                                    aria-controls="section{{ $user->id }}"
                                                    class="btn btn-info text-white">
                                                    {{ $user->first_name }} {{ $user->last_name }}
                                                </a>
                                            </h5>
                                            <div id="section{{ $user->id }}" class="collapse in" role="tabpanel"
                                                aria-labelledby="headerUser{{ $user->id }}">


                                                {!! $address !!}
                                                {{ $user->phone }}
                                                {{ $user->email }}
                                                {{ $user->shop_name }}

                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>{!! $user->getTextRoles() !!}</td>
                                <td><a href="{{ url('shop-store/').'/'.$user->shop_name}}" class="btn btn-info"><i
                                            class="fa fa-user-circle" aria-hidden="true"></i>
                                        ดูโปรไฟล์</a></td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="content" id="info-popup" style="display: none">
    <h5>%name%</h5>
    <hr>
    <p>%roles%</p>
    <a href="%url%" class="btn btn-info text-white"><i class="fa fa-info-circle" aria-hidden="true"></i> ดูโปรไฟล์</a>
    <a href="%urlmap%" class="btn btn-info text-white"><i class="fa fa-map" aria-hidden="true"></i> เดินทางไป</a>
</div>
@endsection

@section('scripts')
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDtPKAiQFAwF6J7FAimVOGkJwJmUb2o1Tg&callback=initMap&libraries=places"
    {{-- src="https://maps.googleapis.com/maps/api/js?key=[            API KEY               ]&callback=initMap&libraries=places" --}}
    defer>
</script>
<script>
    const myLatlng = {
            lat: 13.736717
            , lng: 100.523186
        };

        function initMap() {
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 7.5
                , center: myLatlng
            , });

            //ลูปสร้างมาร์กเกอร์
            {{$idrole = Auth::user()->getIdRoles()}}
            @if($idrole == 9)
                @foreach(\App\Models\User::whereRaw("lat is not null and lng is not null")->whereRaw(" role_user.role_id BETWEEN 3 and 6 or role_user.role_id = 9")
                ->join('role_user','role_user.user_id','=','users.id')
                ->get() as $user)
                    var html = $("#info-popup").html();
                    html = html.replace("%name%","{{ $user->first_name }} {{ $user->last_name }}");
                    html = html.replace("%roles%","{{ $user->getTextRoles() }}");
                    html = html.replace("%url%","{{ url('view-profile/')."/{$user->id}" }}");
                    html = html.replace("%urlmap%","https://www.google.com/maps/place/{{ $user->lat }},{{ $user->lng}}");
                    @if ($user->id === Auth::user()->id)
                        {{ 'shop'.$loop->iteration }} = new google.maps.Marker({
                        position: {
                                lat: {{ $user->lat ?? 13.736717}},
                                lng: {{ $user->lng ?? 100.523186}}
                            }
                            ,icon : "https://developers.google.com/maps/documentation/javascript/examples/full/images/parking_lot_maps.png"
                            , map
                            , title: "{{ $user->first_name }} {{ $user->last_name }}"
                        , });

                    @else
                    @switch($user->role_id)
                        @case(3)
                            {{ 'shop'.$loop->iteration }} = new google.maps.Marker({
                            position: {
                                lat: {{ $user->lat ?? 13.736717}},
                                lng: {{ $user->lng}}
                            }
                            ,icon : "https://chart.apis.google.com/chart?chst=d_map_spin&chld=0.80|0|F47C7C|10|_|BPS"
                            , map
                            , title: "{{ $user->first_name }} {{ $user->last_name }}"
                            , });
                            @break

                        @case(4)
                            {{ 'shop'.$loop->iteration }} = new google.maps.Marker({
                            position: {
                                lat: {{ $user->lat ?? 13.736717}},
                                lng: {{ $user->lng}}
                            }
                            ,icon : "https://chart.apis.google.com/chart?chst=d_map_spin&chld=0.80|0|F47C7C|10|_|BPL"
                            , map
                            , title: "{{ $user->first_name }} {{ $user->last_name }}"
                            , });
                            @break

                        @case(5)
                            {{ 'shop'.$loop->iteration }} = new google.maps.Marker({
                            position: {
                                lat: {{ $user->lat ?? 13.736717}},
                                lng: {{ $user->lng}}
                            }
                            ,icon : "https://chart.apis.google.com/chart?chst=d_map_spin&chld=0.80|0|F47C7C|10|_|BPF"
                            , map
                            , title: "{{ $user->first_name }} {{ $user->last_name }}"
                            , });
                            @break

                        @case(6)
                            {{ 'shop'.$loop->iteration }} = new google.maps.Marker({
                            position: {
                                lat: {{ $user->lat ?? 13.736717}},
                                lng: {{ $user->lng}}
                            }
                            ,icon : "https://chart.apis.google.com/chart?chst=d_map_spin&chld=0.80|0|F47C7C|10|_|BPA"
                            , map
                            , title: "{{ $user->first_name }} {{ $user->last_name }}"
                            , });
                            @break

                        @case(7)
                            {{ 'shop'.$loop->iteration }} = new google.maps.Marker({
                            position: {
                                lat: {{ $user->lat ?? 13.736717}},
                                lng: {{ $user->lng}}
                            }
                            ,icon : "https://chart.apis.google.com/chart?chst=d_map_spin&chld=0.80|0|A1DE93|10|_|CD"
                            , map
                            , title: "{{ $user->first_name }} {{ $user->last_name }}"
                            , });
                            @break

                        @case(8)
                            {{ 'shop'.$loop->iteration }} = new google.maps.Marker({
                            position: {
                                lat: {{ $user->lat ?? 13.736717}},
                                lng: {{ $user->lng}}
                            }
                            ,icon : "https://chart.apis.google.com/chart?chst=d_map_spin&chld=0.80|0|70A1D7|10|_|SME"
                            , map
                            , title: "{{ $user->first_name }} {{ $user->last_name }}"
                            , });
                            @break

                        @case(9)
                            {{ 'shop'.$loop->iteration }} = new google.maps.Marker({
                            position: {
                                lat: {{ $user->lat ?? 13.736717}},
                                lng: {{ $user->lng}}
                            }
                            ,icon : "https://chart.apis.google.com/chart?chst=d_map_spin&chld=0.80|0|A1DE93|10|_|BF"
                            , map
                            , title: "{{ $user->first_name }} {{ $user->last_name }}"
                            , });
                            @break

                    @endswitch

                    @endif
                    {{ 'shop'.$loop->iteration }}.addListener("click", () => {
                                    map.setZoom(10);
                                    map.setCenter({{ 'shop'.$loop->iteration }}.getPosition());
                                });

                                map.addListener("center_changed", () => {
                                    window.setTimeout(() => {
                                        map.panTo({{ 'shop'.$loop->iteration }}.getPosition());
                                    }, 8000);
                                });
                                {{ 'shop'.$loop->iteration }}.addListener("click", () => {
                                    infowindow{{ $user->id }}.open(map, {{ 'shop'.$loop->iteration }});
                                });
                                var infowindow{{ $user->id }} = new google.maps.InfoWindow({
                                    content: html,
                                });

                @endforeach
            @elseif($idrole == 3 || $idrole == 4 || $idrole == 5 || $idrole == 6)
                @foreach(\App\Models\User::whereRaw("lat is not null and lng is not null")->whereRaw(" role_user.role_id BETWEEN 3 and 7 or role_user.role_id = 9 ")
                ->join('role_user','role_user.user_id','=','users.id')
                ->get() as $user)
                    var html = $("#info-popup").html();
                    html = html.replace("%name%","{{ $user->first_name }} {{ $user->last_name }}");
                    html = html.replace("%roles%","{{ $user->getTextRoles() }}");
                    html = html.replace("%url%","{{ url('view-profile/')."/{$user->id}" }}");
                    html = html.replace("%urlmap%","https://www.google.com/maps/place/{{ $user->lat }},{{ $user->lng}}");
                    @if ($user->id === Auth::user()->id)
                        {{ 'shop'.$loop->iteration }} = new google.maps.Marker({
                        position: {
                                lat: {{ $user->lat ?? 13.736717}},
                                lng: {{ $user->lng}}
                            }
                            ,icon : "https://developers.google.com/maps/documentation/javascript/examples/full/images/parking_lot_maps.png"
                            , map
                            , title: "{{ $user->first_name }} {{ $user->last_name }}"
                        , });

                    @else
                    @switch($user->role_id)
                        @case(3)
                            {{ 'shop'.$loop->iteration }} = new google.maps.Marker({
                            position: {
                                lat: {{ $user->lat ?? 13.736717}},
                                lng: {{ $user->lng}}
                            }
                            ,icon : "https://chart.apis.google.com/chart?chst=d_map_spin&chld=0.80|0|F47C7C|10|_|BPS"
                            , map
                            , title: "{{ $user->first_name }} {{ $user->last_name }}"
                            , });
                            @break

                        @case(4)
                            {{ 'shop'.$loop->iteration }} = new google.maps.Marker({
                            position: {
                                lat: {{ $user->lat ?? 13.736717}},
                                lng: {{ $user->lng}}
                            }
                            ,icon : "https://chart.apis.google.com/chart?chst=d_map_spin&chld=0.80|0|F47C7C|10|_|BPL"
                            , map
                            , title: "{{ $user->first_name }} {{ $user->last_name }}"
                            , });
                            @break

                        @case(5)
                            {{ 'shop'.$loop->iteration }} = new google.maps.Marker({
                            position: {
                                lat: {{ $user->lat ?? 13.736717}},
                                lng: {{ $user->lng}}
                            }
                            ,icon : "https://chart.apis.google.com/chart?chst=d_map_spin&chld=0.80|0|F47C7C|10|_|BPF"
                            , map
                            , title: "{{ $user->first_name }} {{ $user->last_name }}"
                            , });
                            @break

                        @case(6)
                            {{ 'shop'.$loop->iteration }} = new google.maps.Marker({
                            position: {
                                lat: {{ $user->lat ?? 13.736717}},
                                lng: {{ $user->lng}}
                            }
                            ,icon : "https://chart.apis.google.com/chart?chst=d_map_spin&chld=0.80|0|F47C7C|10|_|BPA"
                            , map
                            , title: "{{ $user->first_name }} {{ $user->last_name }}"
                            , });
                            @break

                        @case(7)
                            {{ 'shop'.$loop->iteration }} = new google.maps.Marker({
                            position: {
                                lat: {{ $user->lat ?? 13.736717}},
                                lng: {{ $user->lng}}
                            }
                            ,icon : "https://chart.apis.google.com/chart?chst=d_map_spin&chld=0.80|0|A1DE93|10|_|CD"
                            , map
                            , title: "{{ $user->first_name }} {{ $user->last_name }}"
                            , });
                            @break

                        @case(8)
                            {{ 'shop'.$loop->iteration }} = new google.maps.Marker({
                            position: {
                                lat: {{ $user->lat ?? 13.736717}},
                                lng: {{ $user->lng}}
                            }
                            ,icon : "https://chart.apis.google.com/chart?chst=d_map_spin&chld=0.80|0|70A1D7|10|_|SME"
                            , map
                            , title: "{{ $user->first_name }} {{ $user->last_name }}"
                            , });
                            @break

                        @case(9)
                            {{ 'shop'.$loop->iteration }} = new google.maps.Marker({
                            position: {
                                lat: {{ $user->lat ?? 13.736717}},
                                lng: {{ $user->lng}}
                            }
                            ,icon : "https://chart.apis.google.com/chart?chst=d_map_spin&chld=0.80|0|E0BBE4|10|_|BF"
                            , map
                            , title: "{{ $user->first_name }} {{ $user->last_name }}"
                            , });
                            @break

                    @endswitch

                    @endif
                    {{ 'shop'.$loop->iteration }}.addListener("click", () => {
                                    map.setZoom(10);
                                    map.setCenter({{ 'shop'.$loop->iteration }}.getPosition());
                                });

                                map.addListener("center_changed", () => {
                                    window.setTimeout(() => {
                                        map.panTo({{ 'shop'.$loop->iteration }}.getPosition());
                                    }, 8000);
                                });
                                {{ 'shop'.$loop->iteration }}.addListener("click", () => {
                                    infowindow{{ $user->id }}.open(map, {{ 'shop'.$loop->iteration }});
                                });
                                var infowindow{{ $user->id }} = new google.maps.InfoWindow({
                                    content: html,
                                });

                @endforeach
            @elseif($idrole == 7)
                @foreach(\App\Models\User::whereRaw("lat is not null and lng is not null")->whereRaw(" role_user.role_id BETWEEN 3 and $idrole+1 ")
                ->join('role_user','role_user.user_id','=','users.id')
                ->get() as $user)
                    var html = $("#info-popup").html();
                    html = html.replace("%name%","{{ $user->first_name }} {{ $user->last_name }}");
                    html = html.replace("%roles%","{{ $user->getTextRoles() }}");
                    html = html.replace("%url%","{{ url('view-profile/')."/{$user->id}" }}");
                    html = html.replace("%urlmap%","https://www.google.com/maps/place/{{ $user->lat }},{{ $user->lng}}");
                    @if ($user->id === Auth::user()->id)
                        {{ 'shop'.$loop->iteration }} = new google.maps.Marker({
                        position: {
                                lat: {{ $user->lat ?? 13.736717}},
                                lng: {{ $user->lng}}
                            }
                            ,icon : "https://developers.google.com/maps/documentation/javascript/examples/full/images/parking_lot_maps.png"
                            , map
                            , title: "{{ $user->first_name }} {{ $user->last_name }}"
                        , });

                    @else
                    @switch($user->role_id)
                        @case(3)
                            {{ 'shop'.$loop->iteration }} = new google.maps.Marker({
                            position: {
                                lat: {{ $user->lat ?? 13.736717}},
                                lng: {{ $user->lng}}
                            }
                            ,icon : "https://chart.apis.google.com/chart?chst=d_map_spin&chld=0.80|0|F47C7C|10|_|BPS"
                            , map
                            , title: "{{ $user->first_name }} {{ $user->last_name }}"
                            , });
                            @break

                        @case(4)
                            {{ 'shop'.$loop->iteration }} = new google.maps.Marker({
                            position: {
                                lat: {{ $user->lat ?? 13.736717}},
                                lng: {{ $user->lng}}
                            }
                            ,icon : "https://chart.apis.google.com/chart?chst=d_map_spin&chld=0.80|0|F47C7C|10|_|BPL"
                            , map
                            , title: "{{ $user->first_name }} {{ $user->last_name }}"
                            , });
                            @break

                        @case(5)
                            {{ 'shop'.$loop->iteration }} = new google.maps.Marker({
                            position: {
                                lat: {{ $user->lat ?? 13.736717}},
                                lng: {{ $user->lng}}
                            }
                            ,icon : "https://chart.apis.google.com/chart?chst=d_map_spin&chld=0.80|0|F47C7C|10|_|BPF"
                            , map
                            , title: "{{ $user->first_name }} {{ $user->last_name }}"
                            , });
                            @break

                        @case(6)
                            {{ 'shop'.$loop->iteration }} = new google.maps.Marker({
                            position: {
                                lat: {{ $user->lat ?? 13.736717}},
                                lng: {{ $user->lng}}
                            }
                            ,icon : "https://chart.apis.google.com/chart?chst=d_map_spin&chld=0.80|0|F47C7C|10|_|BPA"
                            , map
                            , title: "{{ $user->first_name }} {{ $user->last_name }}"
                            , });
                            @break

                        @case(7)
                            {{ 'shop'.$loop->iteration }} = new google.maps.Marker({
                            position: {
                                lat: {{ $user->lat ?? 13.736717}},
                                lng: {{ $user->lng}}
                            }
                            ,icon : "https://chart.apis.google.com/chart?chst=d_map_spin&chld=0.80|0|A1DE93|10|_|CD"
                            , map
                            , title: "{{ $user->first_name }} {{ $user->last_name }}"
                            , });
                            @break

                        @case(8)
                            {{ 'shop'.$loop->iteration }} = new google.maps.Marker({
                            position: {
                                lat: {{ $user->lat ?? 13.736717}},
                                lng: {{ $user->lng}}
                            }
                            ,icon : "https://chart.apis.google.com/chart?chst=d_map_spin&chld=0.80|0|70A1D7|10|_|SME"
                            , map
                            , title: "{{ $user->first_name }} {{ $user->last_name }}"
                            , });
                            @break

                        @case(9)
                            {{ 'shop'.$loop->iteration }} = new google.maps.Marker({
                            position: {
                                lat: {{ $user->lat ?? 13.736717}},
                                lng: {{ $user->lng}}
                            }
                            ,icon : "https://chart.apis.google.com/chart?chst=d_map_spin&chld=0.80|0|E0BBE4|10|_|BF"
                            , map
                            , title: "{{ $user->first_name }} {{ $user->last_name }}"
                            , });
                            @break

                    @endswitch

                    @endif
                    {{ 'shop'.$loop->iteration }}.addListener("click", () => {
                                    map.setZoom(10);
                                    map.setCenter({{ 'shop'.$loop->iteration }}.getPosition());
                                });

                                map.addListener("center_changed", () => {
                                    window.setTimeout(() => {
                                        map.panTo({{ 'shop'.$loop->iteration }}.getPosition());
                                    }, 8000);
                                });
                                {{ 'shop'.$loop->iteration }}.addListener("click", () => {
                                    infowindow{{ $user->id }}.open(map, {{ 'shop'.$loop->iteration }});
                                });
                                var infowindow{{ $user->id }} = new google.maps.InfoWindow({
                                    content: html,
                                });

                @endforeach
            @elseif($idrole == 8)
                @foreach(\App\Models\User::whereRaw("lat is not null and lng is not null")->whereRaw(" role_user.role_id BETWEEN $idrole-1 and $idrole")
                ->join('role_user','role_user.user_id','=','users.id')
                ->get() as $user)
                    var html = $("#info-popup").html();
                    html = html.replace("%name%","{{ $user->first_name }} {{ $user->last_name }}");
                    html = html.replace("%roles%","{{ $user->getTextRoles() }}");
                    html = html.replace("%url%","{{ url('view-profile/')."/{$user->id}" }}");
                    html = html.replace("%urlmap%","https://www.google.com/maps/place/{{ $user->lat }},{{ $user->lng}}");
                    @if ($user->id === Auth::user()->id)
                        {{ 'shop'.$loop->iteration }} = new google.maps.Marker({
                        position: {
                                lat: {{ $user->lat ?? 13.736717}},
                                lng: {{ $user->lng}}
                            }
                            ,icon : "https://developers.google.com/maps/documentation/javascript/examples/full/images/parking_lot_maps.png"
                            , map
                            , title: "{{ $user->first_name }} {{ $user->last_name }}"
                        , });

                    @else
                    @switch($user->role_id)
                        @case(3)
                            {{ 'shop'.$loop->iteration }} = new google.maps.Marker({
                            position: {
                                lat: {{ $user->lat ?? 13.736717}},
                                lng: {{ $user->lng}}
                            }
                            ,icon : "https://chart.apis.google.com/chart?chst=d_map_spin&chld=0.80|0|F47C7C|10|_|BPS"
                            , map
                            , title: "{{ $user->first_name }} {{ $user->last_name }}"
                            , });
                            @break

                        @case(4)
                            {{ 'shop'.$loop->iteration }} = new google.maps.Marker({
                            position: {
                                lat: {{ $user->lat ?? 13.736717}},
                                lng: {{ $user->lng}}
                            }
                            ,icon : "https://chart.apis.google.com/chart?chst=d_map_spin&chld=0.80|0|F47C7C|10|_|BPL"
                            , map
                            , title: "{{ $user->first_name }} {{ $user->last_name }}"
                            , });
                            @break

                        @case(5)
                            {{ 'shop'.$loop->iteration }} = new google.maps.Marker({
                            position: {
                                lat: {{ $user->lat ?? 13.736717}},
                                lng: {{ $user->lng}}
                            }
                            ,icon : "https://chart.apis.google.com/chart?chst=d_map_spin&chld=0.80|0|F47C7C|10|_|BPF"
                            , map
                            , title: "{{ $user->first_name }} {{ $user->last_name }}"
                            , });
                            @break

                        @case(6)
                            {{ 'shop'.$loop->iteration }} = new google.maps.Marker({
                            position: {
                                lat: {{ $user->lat ?? 13.736717}},
                                lng: {{ $user->lng}}
                            }
                            ,icon : "https://chart.apis.google.com/chart?chst=d_map_spin&chld=0.80|0|F47C7C|10|_|BPA"
                            , map
                            , title: "{{ $user->first_name }} {{ $user->last_name }}"
                            , });
                            @break

                        @case(7)
                            {{ 'shop'.$loop->iteration }} = new google.maps.Marker({
                            position: {
                                lat: {{ $user->lat ?? 13.736717}},
                                lng: {{ $user->lng}}
                            }
                            ,icon : "https://chart.apis.google.com/chart?chst=d_map_spin&chld=0.80|0|A1DE93|10|_|CD"
                            , map
                            , title: "{{ $user->first_name }} {{ $user->last_name }}"
                            , });
                            @break

                        @case(8)
                            {{ 'shop'.$loop->iteration }} = new google.maps.Marker({
                            position: {
                                lat: {{ $user->lat ?? 13.736717}},
                                lng: {{ $user->lng}}
                            }
                            ,icon : "https://chart.apis.google.com/chart?chst=d_map_spin&chld=0.80|0|70A1D7|10|_|SME"
                            , map
                            , title: "{{ $user->first_name }} {{ $user->last_name }}"
                            , });
                            @break

                        @case(9)
                            {{ 'shop'.$loop->iteration }} = new google.maps.Marker({
                            position: {
                                lat: {{ $user->lat ?? 13.736717}},
                                lng: {{ $user->lng}}
                            }
                            ,icon : "https://chart.apis.google.com/chart?chst=d_map_spin&chld=0.80|0|E0BBE4|10|_|BF"
                            , map
                            , title: "{{ $user->first_name }} {{ $user->last_name }}"
                            , });
                            @break

                    @endswitch

                    @endif
                    {{ 'shop'.$loop->iteration }}.addListener("click", () => {
                                    map.setZoom(10);
                                    map.setCenter({{ 'shop'.$loop->iteration }}.getPosition());
                                });

                                map.addListener("center_changed", () => {
                                    window.setTimeout(() => {
                                        map.panTo({{ 'shop'.$loop->iteration }}.getPosition());
                                    }, 8000);
                                });
                                {{ 'shop'.$loop->iteration }}.addListener("click", () => {
                                    infowindow{{ $user->id }}.open(map, {{ 'shop'.$loop->iteration }});
                                });
                                var infowindow{{ $user->id }} = new google.maps.InfoWindow({
                                    content: html,
                                });

                @endforeach
            @else
                @foreach(\App\Models\User::whereRaw("lat is not null and lng is not null")
                ->join('role_user','role_user.user_id','=','users.id')
                ->get() as $user)
                    var html = $("#info-popup").html();
                    html = html.replace("%name%","{{ $user->first_name }} {{ $user->last_name }}");
                    html = html.replace("%roles%","{{ $user->getTextRoles() }}");
                    html = html.replace("%url%","{{ url('view-profile/')."/{$user->id}" }}");
                    html = html.replace("%urlmap%","https://www.google.com/maps/place/{{ $user->lat }},{{ $user->lng}}");
                    @if ($user->id === Auth::user()->id)
                        {{ 'shop'.$loop->iteration }} = new google.maps.Marker({
                        position: {
                                lat: {{ $user->lat ?? 13.736717}},
                                lng: {{ $user->lng}}
                            }
                            ,icon : "https://developers.google.com/maps/documentation/javascript/examples/full/images/parking_lot_maps.png"
                            , map
                            , title: "{{ $user->first_name }} {{ $user->last_name }}"
                        , });

                    @else
                    @switch($user->role_id)
                        @case(3)
                            {{ 'shop'.$loop->iteration }} = new google.maps.Marker({
                            position: {
                                lat: {{ $user->lat ?? 13.736717}},
                                lng: {{ $user->lng}}
                            }
                            ,icon : "https://chart.apis.google.com/chart?chst=d_map_spin&chld=0.80|0|F47C7C|10|_|BPS"
                            , map
                            , title: "{{ $user->first_name }} {{ $user->last_name }}"
                            , });
                            @break

                        @case(4)
                            {{ 'shop'.$loop->iteration }} = new google.maps.Marker({
                            position: {
                                lat: {{ $user->lat ?? 13.736717}},
                                lng: {{ $user->lng}}
                            }
                            ,icon : "https://chart.apis.google.com/chart?chst=d_map_spin&chld=0.80|0|F47C7C|10|_|BPL"
                            , map
                            , title: "{{ $user->first_name }} {{ $user->last_name }}"
                            , });
                            @break

                        @case(5)
                            {{ 'shop'.$loop->iteration }} = new google.maps.Marker({
                            position: {
                                lat: {{ $user->lat ?? 13.736717}},
                                lng: {{ $user->lng}}
                            }
                            ,icon : "https://chart.apis.google.com/chart?chst=d_map_spin&chld=0.80|0|F47C7C|10|_|BPF"
                            , map
                            , title: "{{ $user->first_name }} {{ $user->last_name }}"
                            , });
                            @break

                        @case(6)
                            {{ 'shop'.$loop->iteration }} = new google.maps.Marker({
                            position: {
                                lat: {{ $user->lat ?? 13.736717}},
                                lng: {{ $user->lng}}
                            }
                            ,icon : "https://chart.apis.google.com/chart?chst=d_map_spin&chld=0.80|0|F47C7C|10|_|BPA"
                            , map
                            , title: "{{ $user->first_name }} {{ $user->last_name }}"
                            , });
                            @break

                        @case(7)
                            {{ 'shop'.$loop->iteration }} = new google.maps.Marker({
                            position: {
                                lat: {{ $user->lat ?? 13.736717}},
                                lng: {{ $user->lng}}
                            }
                            ,icon : "https://chart.apis.google.com/chart?chst=d_map_spin&chld=0.80|0|A1DE93|10|_|CD"
                            , map
                            , title: "{{ $user->first_name }} {{ $user->last_name }}"
                            , });
                            @break

                        @case(8)
                            {{ 'shop'.$loop->iteration }} = new google.maps.Marker({
                            position: {
                                lat: {{ $user->lat ?? 13.736717}},
                                lng: {{ $user->lng}}
                            }
                            ,icon : "https://chart.apis.google.com/chart?chst=d_map_spin&chld=0.80|0|70A1D7|10|_|SME"
                            , map
                            , title: "{{ $user->first_name }} {{ $user->last_name }}"
                            , });
                            @break

                        @case(9)
                            {{ 'shop'.$loop->iteration }} = new google.maps.Marker({
                            position: {
                                lat: {{ $user->lat ?? 13.736717}},
                                lng: {{ $user->lng}}
                            }
                            ,icon : "https://chart.apis.google.com/chart?chst=d_map_spin&chld=0.80|0|E0BBE4|10|_|BF"
                            , map
                            , title: "{{ $user->first_name }} {{ $user->last_name }}"
                            , });
                            @break

                    @endswitch

                    @endif
                    {{ 'shop'.$loop->iteration }}.addListener("click", () => {
                                    map.setZoom(10);
                                    map.setCenter({{ 'shop'.$loop->iteration }}.getPosition());
                                });

                                map.addListener("center_changed", () => {
                                    window.setTimeout(() => {
                                        map.panTo({{ 'shop'.$loop->iteration }}.getPosition());
                                    }, 8000);
                                });
                                {{ 'shop'.$loop->iteration }}.addListener("click", () => {
                                    infowindow{{ $user->id }}.open(map, {{ 'shop'.$loop->iteration }});
                                });
                                var infowindow{{ $user->id }} = new google.maps.InfoWindow({
                                    content: html,
                                });

                @endforeach
            @endif
        }
</script>

@endsection

@extends('layouts.admin.main')

@section('content')
<section class="wp-chart mb-4 card">
    <div class="card-header">
        <h3>ข้อมูลการเข้าชม</h3>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
        </div>
        <div class="col-md-4"></div>
    </div>
    <hr>
</section>

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
                            @foreach (App\Models\User::whereRaw("id not in (select user_id from role_user where role_id
                            =
                            1)")->get() as $user)
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
                                <td><a href="#" class="btn btn-info"><i class="fa fa-user-circle"
                                            aria-hidden="true"></i>
                                        ดูโปรไฟล์</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-success text-white">
                    รายการสินค้า
                </div>
                <div class="card-body">
                    <table class="table data-table table-hover table-responsive table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ชื่อสินค้า</th>
                                <th>รูปภาพ</th>
                                <th>ราคาต่อหน่วย (บาท)</th>
                                <th>หน่วยเป็น</th>
                                <th>จาก</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (App\Models\Product::all() as $product)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $product->name }}</td>
                                <td>
                                    <img src="{{ url('public/'.Storage::url($product->file_image)) }}"
                                        style="width: 150px;height: 150px;object-fit:cover"
                                        onclick="window.open('{{ url('public/'.Storage::url($product->file_image)) }}','_blank')">
                                </td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->unit }}</td>
                                <td><a href="{{ url('profile/'.$product->user_id) }}" class="btn btn-info"><i
                                            class="fa fa-user-circle" aria-hidden="true"></i>
                                        ดูข้อมูลเพิ่มเติม</a></td>
                            </tr>
                            @endforeach
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
    src="https://maps.googleapis.com/maps/api/js?key=[            API KEY              ]&callback=initMap&libraries=places"
    defer></script>
{{-- <script>
    const myLatlng = {
            lat: 13.736717
            , lng: 100.523186
        };

        function initMap() {
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 5
                , center: myLatlng
            , });
            //ลูปสร้างมาร์กเกอร์
            @foreach(\App\Models\User::whereRaw("lat is not null and lng is not null")->get() as $user)
                var html = $("#info-popup").html();
                html = html.replace("%name%","{{ $user->first_name }} {{ $user->last_name }}");
                html = html.replace("%roles%","{{ $user->getTextRoles() }}");
                html = html.replace("%url%","{{ url('view-profile/')."/{$user->id}" }}");
                html = html.replace("%urlmap%","https://www.google.com/maps/place/{{ $user->lat }},{{ $user->lng}}");
                    {{ 'shop'.$loop->iteration }} = new google.maps.Marker({
                    position: {
                            lat: {{ $user->lat }},
                            lng: {{ $user->lng}}
                        }
                        ,icon : "https://developers.google.com/maps/documentation/javascript/examples/full/images/parking_lot_maps.png"
                        , map
                        , title: "{{ $user->first_name }} {{ $user->last_name }}"
                    , });

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
        }
</script> --}}
@endsection

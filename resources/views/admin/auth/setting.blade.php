@extends('layouts.admin.main')
@section('content')
    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header">ตั้งค่าโปรไฟล์ของฉัน</div>
        <div class="card-body">
            <form method="post" action="{{ url('/setting') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="col-12">
                        <h5>ข้อมูลทั่วไป <i class="fas fa-user"></i></h5>
                        <hr>
                    </div>
                    <div class="col-md-12">
                        <div class="text-center">
                            <img style="width:150px;height: 150px;object-fit: cover"
                                src="{{ asset('public/storage/' . Auth::user()->file_image) }}" id="img_preview"
                                class="rounded" alt="...">
                        </div>
                        <div class="form-group ">
                            <label for=""></label>
                            <input type="file" class="form-control-file" name="file_image" id="file_image"
                                placeholder="file_image" aria-describedby="fileHelpId">
                            <small id="fileHelpId" class="form-text text-muted">เลือกไฟล์รูปภาพ</small>
                        </div>
                        <hr>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">ชื่อ</label>
                            <input required value="{{ Auth::user()->first_name }}" type="text" name="first_name" id=""
                                class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">สกุล</label>
                            <input required value="{{ Auth::user()->last_name }}" type="text" name="last_name" id=""
                                class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">เบอร์มือถือ</label>
                            <input required value="{{ Auth::user()->phone }}" type="text" name="phone" min="10" max='15'
                                id="" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-12">
                        {!! Form::label('', 'สถานะของคุณ', []) !!}
                        {!! Form::select('Roles[]', App\Models\Role::where('name', '!=', 'admin')->pluck('label', 'id'), App\Models\RoleUser::where('user_id', Auth::user()->id)->pluck('role_id'), ['class' => 'form-control']) !!}
                    </div>

                    <div class="col-12">
                        <hr>
                        <h5>ข้อมูลที่อยู่ที่สามารถติดต่อได้ <i class="fas fa-home"></i></h5>
                        <hr>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">ที่อยู่</label>
                            <input required value="{{ Auth::user()->address }}" type="text" name="address" id=""
                                class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="form-group">
                            <label for="">หมู่</label>
                            <input required value="{{ Auth::user()->address_no }}" type="text" name="address_no" id=""
                                class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="form-group">
                            <label for="">ซอย</label>
                            <input required value="{{ Auth::user()->zoi }}" type="text" name="zoi" id=""
                                class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="form-group">
                            <label for="">ถนน</label>
                            <input required value="{{ Auth::user()->road }}" type="text" name="road" id=""
                                class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="form-group">
                            <label for="">ตำบล</label>
                            <input required value="{{ Auth::user()->district }}" type="text" name="district"
                                id="district" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="form-group">
                            <label for="">อำเภอ</label>
                            <input required value="{{ Auth::user()->amphure }}" type="text" name="amphure" id="amphoe"
                                class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="form-group">
                            <label for="">จังหวัด</label>
                            <input required value="{{ Auth::user()->province }}" type="text" name="province"
                                id="province" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="form-group">
                            <label for="">รหัสไปรษณีย์</label>
                            <input required value="{{ Auth::user()->zip }}" type="text" name="zip" id="zipcode"
                                class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-12">
                        <hr>
                        <h5>ข้อมูลสื่อ Social Media <i class="fas fa-users"></i></h5>
                        <hr>
                    </div>
                    <div class="input-group mb-3 col-md-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fab fa-line "></i></span>
                        </div>
                        <input type="text" class="form-control" name="line" id="line" value="{{ Auth::user()->line }}"
                            placeholder="เพิ่มข้อมูล Line">
                    </div>
                    <div class="input-group mb-3 col-md-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fab fa-facebook "></i></span>
                        </div>
                        <input type="text" class="form-control" name="facebook" id="facebook"
                            value="{{ Auth::user()->facebook }}" placeholder="เพิ่มข้อมูล url ใน facebook">
                    </div>
                    <div class="input-group mb-3 col-md-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fab fa-twitter "></i></span>
                        </div>
                        <input type="text" class="form-control" name="twitter" id="twitter"
                            value="{{ Auth::user()->twitter }}" placeholder="เพิ่มข้อมูล url ใน twitter">
                    </div>
                    <div class="input-group mb-3 col-md-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fab fa-instagram "></i></span>
                        </div>
                        <input type="text" class="form-control" name="instagram" value="{{ Auth::user()->instagram }}"
                            id="instagram" placeholder="เพิ่มข้อมูล url ใน instagram">
                    </div>
                </div>
                {!! Form::submit('บันทึกข้อมูล', ['class' => 'btn btn-info text-white btn-lg w-100']) !!}
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card text-center">
                <div class="card-header">
                    <h5>ตั้งค่าตำแหน่งของฉัน</h5>
                </div>
                <div class="row">
                    <div class="col-10 offset-1 mt-2 mb-2">
                        <div class="form-inline">
                            {!! Form::label('searchPlace', 'ค้นหาสถานที่ :&nbsp;', []) !!}
                            <input id="pac-input" class="form-control w-75" type="text" id="searchPlace"
                                placeholder="ค้นหาสถานที่..." />
                        </div>
                    </div>
                </div>
                <div id="map"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">ตั้งค่าสถานประกอบการ/ร้าน ของฉัน</div>
                <div class="card-body">
                    <form method="post" action="{{ url('/setting') }}">
                        @csrf
                        <div class="form-group">
                            <label for="">{{ __('users.shop_name') }}</label>
                            <input required value="{{ Auth::user()->shop_name }}" type="text" name="shop_name" id=""
                                class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="">{{ __('users.lat') }}</label>
                            <input required value="{{ Auth::user()->lat }}" type="text" name="lat" id="lat"
                                class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="">{{ __('users.lng') }}</label>
                            <input required value="{{ Auth::user()->lng }}" type="text" name="lng" id="lng"
                                class="form-control" placeholder="">
                        </div>
                        <a onclick=" getLocation1()" class="btn btn-danger text-white mb-1 w-100"><i
                                class="fa fa-location-arrow" aria-hidden="true"></i> ใช้ตำแหน่งจาก GPS</a>
                        {!! Form::submit('บันทึกข้อมูล', ['class' => 'btn btn-info text-white btn-lg w-100']) !!}
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')

    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCd9d0Ws4huhVYI0X8F9gPmP6UWK-stJf0&callback=initMap&libraries=places" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCd9d0Ws4huhVYI0X8F9gPmP6UWK-stJf0&callback=initMap&libraries=places" defer></script> --}}
    {{-- <script type="text/javascript" href="https://maps.googleapis.com/maps/api/js?key=AIzaSyCd9d0Ws4huhVYI0X8F9gPmP6UWK-stJf0&callback=initMap&libraries=places"></script> --}}


    <script>
        $('#file_image').on('change', function(e) {
            filePreview(this);
        });

        function filePreview(input) {
            // console.log(input)
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    // $('#img_pre').remove();
                    $('#img_preview').attr('src', e.target.result);
                    // $('#img_pre').attr('hidden', false);
                    // $("#text").remove();
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

    </script>

    {{-- New Map --}}
    {{-- <script src="https://unpkg.com/leaflet@1.3.0/dist/leaflet.js"></script> --}}

    <link rel="stylesheet" href="{{ asset('/public/leaflet/leaflet-gps.css') }}"/>

    {{-- <link rel="stylesheet" href="{{ asset('/public/leaflet/style.css') }}"/> --}}
    {{-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" /> --}}
    {{-- @push('scripts') --}}
    {{-- <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin="">
    </script> --}}

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet/0.0.1-beta.5/esri-leaflet.js"></script>
    <script
      src="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.js"></script>
    <link rel="stylesheet" type="text/css"
      href="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.css">
    <script src="{{ asset('/public/leaflet/leaflet-gps.js') }}"></script>

    {{-- <script>
        var map = new L.Map('map', {
            zoom: 7.5,
            center: new L.latLng([13.736717, 100.523186])
        });

        map.addLayer(new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png'));	//base layer

        var gps = new L.Control.Gps({
            //autoActive:true,
            autoCenter: true
        });//inizialize control

        gps
            .on('gps:located', function (e) {
                //	e.marker.bindPopup(e.latlng.toString()).openPopup()
                console.log("test")
                console.log(e.latlng, map.getCenter())
            })
            .on('gps:disabled', function (e) {
                e.marker.closePopup()
            });

        gps.addTo(map);

        var searchControl = new L.esri.Controls.Geosearch().addTo(map);

        var results = new L.LayerGroup().addTo(map);

        searchControl.on('results', function(data){
        results.clearLayers();
        for (var i = data.results.length - 1; i >= 0; i--) {
            results.addLayer(L.marker(data.results[i].latlng));
            console.log(data.results[i].latlng.lat)
            $("#lat").val(data.results[i].latlng.lat);
            $("#lng").val(data.results[i].latlng.lng);
        }
        });

   
        function getLocation1(){
            navigator.geolocation.getCurrentPosition(function (location) {
                var latlng = new L.LatLng(location.coords.latitude, location.coords.longitude);
                var marker = L.marker(latlng).addTo(map);
                map.setView(latlng,15.5);
                console.log("latlng")
            });
        }
    </script> --}}


    {{-- <script src="{{ asset('Leaflet.AccuratePosition.js') }}"></script>
    <script>
		var map = L.map('map').setView([40.44695, -345.23437], 1);

		L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
			attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
		}).addTo(map);

		function onAccuratePositionError (e) {
			addStatus(e.message, 'error');
		}

		function onAccuratePositionProgress (e) {
			var message = 'Progressing … (Accuracy: ' + e.accuracy + ')';
			addStatus(message, 'progressing');
		}

		function onAccuratePositionFound (e) {
			var message = 'Most accurate position found (Accuracy: ' + e.accuracy + ')';
			addStatus(message, 'done');
			map.setView(e.latlng, 12);
			L.marker(e.latlng).addTo(map);
		}

		function addStatus (message, className) {
			var ul = document.getElementById('status'),
				li = document.createElement('li');
			li.appendChild(document.createTextNode(message));
			ul.className = className;
			ul.appendChild(li);
		}

		map.on('accuratepositionprogress', onAccuratePositionProgress);
		map.on('accuratepositionfound', onAccuratePositionFound);
		map.on('accuratepositionerror', onAccuratePositionError);

		map.findAccuratePosition({
			maxWait: 10000,
			desiredAccuracy: 20
		});
	</script> --}}

    @include('admin.auth.edit-form-script')
@endsection

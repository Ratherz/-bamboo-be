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
                        {!! Form::select('Roles[]', App\Models\Role::where('name', '!=', 'admin')->pluck('label', 'id'),
                        App\Models\RoleUser::where('user_id', Auth::user()->id)->pluck('role_id'), ['class' =>
                        'form-control']) !!}
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
                            <input required value="{{ Auth::user()->district }}" type="text" name="district" id=""
                                class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="form-group">
                            <label for="">อำเภอ</label>
                            <input required value="{{ Auth::user()->amphure }}" type="text" name="amphure" id=""
                                class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="form-group">
                            <label for="">จังหวัด</label>
                            <input required value="{{ Auth::user()->province }}" type="text" name="province" id=""
                                class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="form-group">
                            <label for="">รหัสไปรษณีย์</label>
                            <input required value="{{ Auth::user()->zip }}" type="text" name="zip" id=""
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
                        <a onclick=" getLocation()" class="btn btn-danger text-white mb-1 w-100"><i
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
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDtPKAiQFAwF6J7FAimVOGkJwJmUb2o1Tg&callback=initMap&libraries=places"
        {{-- src="https://maps.googleapis.com/maps/api/js?key=[            API KEY              ]&callback=initMap&libraries=places" --}}
        defer></script>
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
    @include('admin.auth.edit-form-script')
@endsection

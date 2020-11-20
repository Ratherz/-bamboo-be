@extends('layouts.admin.nolayout')

@section('content')
<div class="container ">

    <div class="card mt-5">
        <div class="card-header bg-success ">
            <h4 class="text-white">ลงทะเบียนสมาชิก</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <h5>ข้อมูลเข้าสู่ระบบ</h5>
                        <hr>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">อีเมล์</label>
                            <input required type="text" name="email" id="" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">รหัสผ่าน</label>
                            <input required type="password" name="password" min="8" max='15' id="password"
                                class="form-control password" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">ยืนยันรหัสผ่าน</label>
                            <input required type="password" min="8" max='15' id="re-password"
                                class="form-control password" placeholder="">
                            <div id="valid-text"></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        {!! Form::label('', 'สถานะของคุณ', []) !!}
                        {!! Form::select('roles[]', App\Models\Role::where('name','!=','admin')->pluck('label','id'),
                        null, ['class'
                        =>'form-control']) !!}
                    </div>
                    <div class="col-12">
                        <hr>
                        <h5>ข้อมูลทั่วไป <i class="fas fa-user    "></i></h5>
                        <hr>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">ชื่อ</label>
                            <input required type="text" name="first_name" id="" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">สกุล</label>
                            <input required type="text" name="last_name" id="" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">เบอร์มือถือ</label>
                            <input required type="text" name="phone" min="10" max='15' id="" class="form-control"
                                placeholder="">
                        </div>
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-12">
                        <hr>
                        <h5>ข้อมูลที่อยู่ที่สามารถติดต่อได้ <i class="fas fa-home"></i></h5>
                        <hr>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">ที่อยู่</label>
                            <input required type="text" name="address" id="" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="form-group">
                            <label for="">หมู่</label>
                            <input required type="text" name="address_no" id="" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="form-group">
                            <label for="">ซอย</label>
                            <input required type="text" name="zoi" id="" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="form-group">
                            <label for="">ถนน</label>
                            <input required type="text" name="road" id="" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="form-group">
                            <label for="">ตำบล</label>
                            <input required type="text" name="district" id="" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="form-group">
                            <label for="">อำเภอ</label>
                            <input required type="text" name="amphure" id="" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="form-group">
                            <label for="">จังหวัด</label>
                            <input required type="text" name="province" id="" class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="form-group">
                            <label for="">รหัสไปรษณีย์</label>
                            <input required type="text" name="zip" id="" class="form-control" placeholder="">
                        </div>
                    </div>
                </div>
                {!! Form::submit('ลงทะเบียน', ['class' => 'btn btn-info text-white btn-lg w-100']) !!}
            </form>
        </div>
    </div>


</div>
@endsection

@section('scripts')
<script>
    $("#re-password").change(function (e) {
            e.preventDefault();
            if($("#re-password").val()!=$("#password").val()) {
                $(".password").addClass("is-invalid");
                alert("รหัสผ่านไม่ตรงกัน");
            }else{
                $(".password").removeClass("is-invalid");
            }
        });
</script>
@endsection

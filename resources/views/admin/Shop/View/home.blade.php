@extends('layouts.shop.app')

@section('content')
@foreach ($ListP as $ListProduct)


<div class="my-3 my-md-5">
    <div class="container">
        <div class="row">
            @foreach (App\Models\User::whereRaw('id='.$ListProduct->user_id)->get() as $OwnerList)
            <div class="col-lg-12">
                <form class="card">
                    <div class="card-body">
                        <h3 class="card-title">ข้อมูลสินค้า</h3>
                        <hr>
                        <div class="row">
                            <div class="col-lg-4">
                                <form>
                                    <div class="row">
                                        <div class="col-auto">

                                            <span class="avatar avatar-xl"><img src="{{ asset('public/storage/').'/'.$OwnerList->file_image }}"></span>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">

                                                <label class="form-label">ชื่อร้าน</label>
                                                {{$OwnerList->shop_name}}
                                            </div>
                                        </div>
                                    </div>


                                </form>
                            </div>
                            <div class="col-lg-8">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label><b>ชื่อสินค้า</b> {{$ListProduct->name}} </label>
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label><b>ราคา</b> {{$ListProduct->price}} </label>
                                    </div>
                                </div>

                                <div class="col-sm-12 ">
                                    <div class="form-group">
                                        <label class="form-label">ที่อยู่สินค้า</label>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">บ้านเลขที่</th>
                                                            <th scope="col">หมู่</th>
                                                            <th scope="col">ถนน</th>
                                                            <th scope="col">ซอย</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>{{$OwnerList->address}}</td>
                                                            <td>{{$OwnerList->address_no}}</td>
                                                            <td>{{$OwnerList->road}}</td>
                                                            <td>{{$OwnerList->zoi}}</td>
                                                        </tr>

                                                    </tbody>
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">ตำบล</th>
                                                            <th scope="col">อำเภอ</th>
                                                            <th scope="col">จังหวัด</th>
                                                            <th scope="col">รหัสไปรษณี</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>{{$OwnerList->district}}</td>
                                                            <td>{{$OwnerList->amphure}}</td>
                                                            <td>{{$OwnerList->province}}</td>
                                                            <td>{{$OwnerList->zip}}</td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">ช่องทางติดต่อผู้ขาย</label>
                                        <ul class="social-links list-inline mb-0 mt-2">
                                            <li class="list-inline-item">
                                                <a href="{{$OwnerList->facebook}}" title="{{$OwnerList->facebook}}" data-toggle="tooltip"><i class="fa fa-facebook"></i></a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="{{$OwnerList->Twitter}}" title="{{$OwnerList->Twitter}}" data-toggle="tooltip"><i class="fa fa-twitter"></i></a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="tel:+66{{$OwnerList->phone}}" title="{{$OwnerList->phone}}" data-toggle="tooltip"><i class="fa fa-phone"></i></a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="{{$OwnerList->instagram}}" title="{{$OwnerList->instagram}}" data-toggle="tooltip"><i class="fab fa-instagram"></i></a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="https://www.google.com/maps/search/?api=1&query={{$OwnerList->lat}},{{$OwnerList->lng}}" data-toggle="tooltip"><i class="fa fa-map"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>



                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">รูปสินค้า</h3>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12">
                                @foreach (App\Models\ProductImg::whereRaw('product='.$ListProduct->id)->get() as $pic)
                                
                                <a href="{{ url('shop-view/').'/'.$ListProduct->id }}"><img src="{{ asset('public/storage/').'/'.$pic->path }}"  width="auto" height="220px"></a>
                                
                                @endforeach
                            </div>

                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
@endforeach
@endforeach
@endsection
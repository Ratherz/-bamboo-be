@extends('layouts.shop.app')

@section('content')

@foreach ($Store as $StoreList)

<div class="page">
    <div class="page-main">
        <div class="my-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="media">
                                    <span class="avatar avatar-xxl mr-5"><img src="{{ asset('public/storage/').'/'.$StoreList->file_image }}"></span>
                                    <div class="media-body">
                                        <h4 class="m-0">{{$StoreList->shop_name}}</h4>
                                        <p class="text-muted mb-0">{{$StoreList->first_name}} {{$StoreList->last_name}}</p>
                                        <ul class="social-links list-inline mb-0 mt-2">
                                            <li class="list-inline-item">
                                                <a href="{{$StoreList->facebook}}" title="{{$StoreList->facebook}}" data-toggle="tooltip"><i class="fa fa-facebook"></i></a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="{{$StoreList->Twitter}}" title="{{$StoreList->Twitter}}" data-toggle="tooltip"><i class="fa fa-twitter"></i></a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="tel:+66{{$StoreList->phone}}" title="{{$StoreList->phone}}" data-toggle="tooltip"><i class="fa fa-phone"></i></a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="{{$StoreList->instagram}}" title="{{$StoreList->instagram}}" data-toggle="tooltip"><i class="fab fa-instagram"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-status bg-orange"></div>
                            <div class="card-header">
                                <h3 class="card-title">ข้อมูลที่ตั้ง</h3>
                            </div>
                            <div class="card-body">
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
                                            <td>{{$StoreList->address}}</td>
                                            <td>{{$StoreList->address_no}}</td>
                                            <td>{{$StoreList->road}}</td>
                                            <td>{{$StoreList->zoi}}</td>
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
                                            <td>{{$StoreList->district}}</td>
                                            <td>{{$StoreList->amphure}}</td>
                                            <td>{{$StoreList->province}}</td>
                                            <td>{{$StoreList->zip}}</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">

                    </div>

                    <div class="col-lg-12">
                        <hr>
                        <h3 style="text-align: center;">สินค้าทั้งหมดในร้านของเรา</h3>
                        <hr>
                    </div>
                    <div class="col-lg-12">
                        <div class="row">

                            @foreach (App\Models\Product::whereRaw('user_id ='.$StoreList->id)->get() as $item)
                            @foreach (App\Models\User::whereRaw('id='.$item->user_id)->get() as $OwnerList)
                            <div class="col-md-6 col-lg-3">
                                <div class="card">
                                    <div class="card-body " style="width: auto;height: 390px;">
                                    @foreach (App\Models\ProductImg::whereRaw('product='.$StoreList->id)->limit(1)->get() as $pic)
                                    <div class="carousel-item active">
                                        <a href="{{ url('shop-view/').'/'.$StoreList->id }}"><img src="{{ asset('public/storage/').'/'.$pic->path }}" class="d-block w-100"></a>
                                    </div>
                                    @endforeach
                                        <h4 class="card-title">{{ $item->name }}</h4>
                                        <label>ร้าน : <a href="{{ url('shop-store/').'/'.$OwnerList->shop_name}}">{{$OwnerList->shop_name}}</a></label>
                                        <div class=" d-flex align-items-center">
                                            <div class="product-price">
                                                <b>{{ $item->price }} ฿ / {{ $item->unit }} หน่วย</b>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
@extends('layouts.shop.app')

@section('content')
<div class="page">
    <div class="page-main">
        <div class="my-3">
            <div class="container">
                <div class="page-header">
                    <h3 class="page-title">
                        รายการสินค้า <br>
                        สำหรับ @foreach (Auth::user()->roles as $role)
                        {{ $role->role->label }}<br>
                        @endforeach
                    </h3>
                </div>
                @switch($role->role->id)

                @case(3) <div class="row">
                    @foreach (App\Models\Product::whereRaw('category_id=4 ||category_id = 3 ||category_id = 5')->get() as $products)
                    @foreach (App\Models\User::whereRaw('id='.$products->user_id)->get() as $OwnerList)

                    <div class="col-md-6 col-lg-3">
                        <div class="card">
                            @foreach (App\Models\ProductImg::whereRaw('product='.$products->id)->limit(1)->get() as $pic)
                            <div class="carousel-item active">
                                <a href="{{ url('shop-view/').'/'.$products->id }}"><img src="{{ asset('public/storage/').'/'.$pic->path }}" class="d-block w-100"></a>
                            </div>
                            @endforeach
                            <h4 class="card-title"> ชื่อสินค้า ชื่อสินค้า {{ $products->name }}</h4>
                            <label class="my-4 ml-4">ร้าน : <a href="{{ url('shop-store/').'/'.$OwnerList->shop_name}}">{{$OwnerList->shop_name}}</a></label>
                            <div class="mt-5 d-flex align-items-center">
                                <div class="product-price">
                                    <strong class="my-4 ml-4">{{ $products->price }} ฿ / {{ $products->unit }} หน่วย</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endforeach
                @break

                @case(4) <div class="row">
                    @foreach (App\Models\Product::whereRaw('category_id=4 ||category_id = 3 ||category_id = 5')->get() as $products)
                    @foreach (App\Models\User::whereRaw('id='.$products->user_id)->get() as $OwnerList)

                    <div class="col-md-6 col-lg-3">
                        <div class="card">
                            @foreach (App\Models\ProductImg::whereRaw('product='.$products->id)->limit(1)->get() as $pic)
                            <div class="carousel-item active">
                                <a href="{{ url('shop-view/').'/'.$products->id }}"><img src="{{ asset('public/storage/').'/'.$pic->path }}" class="d-block w-100"></a>
                            </div>
                            @endforeach
                            <h4 class="card-title my-4 ml-4">ชื่อสินค้า {{ $products->name }}</h4>
                            <label class="my-4 ml-4">ร้าน : <a href="{{ url('shop-store/').'/'.$OwnerList->shop_name}}">{{$OwnerList->shop_name}}</a></label>
                            <div class="mt-5 d-flex align-items-center">
                                <div class="product-price">
                                    <strong class="my-4 ml-4">{{ $products->price }} ฿ / {{ $products->unit }} หน่วย</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endforeach
                @break
                @case(5) <div class="row">
                    @foreach (App\Models\Product::whereRaw('category_id=4 ||category_id = 3 ||category_id = 5')->get() as $products)
                    @foreach (App\Models\User::whereRaw('id='.$products->user_id)->get() as $OwnerList)

                    <div class="col-md-6 col-lg-3">
                        <div class="card">
                            @foreach (App\Models\ProductImg::whereRaw('product='.$products->id)->limit(1)->get() as $pic)
                            <div class="carousel-item active">
                                <a href="{{ url('shop-view/').'/'.$products->id }}"><img src="{{ asset('public/storage/').'/'.$pic->path }}" class="d-block w-100"></a>
                            </div>
                            @endforeach
                            <h4 class="card-title my-4 ml-4">ชื่อสินค้า {{ $products->name }}</h4>
                            <label class="my-4 ml-4">ร้าน : <a href="{{ url('shop-store/').'/'.$OwnerList->shop_name}}">{{$OwnerList->shop_name}}</a></label>
                            <div class="mt-5 d-flex align-items-center">
                                <div class="product-price">
                                    <strong class="my-4 ml-4">{{ $products->price }} ฿ / {{ $products->unit }} หน่วย</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endforeach
                @break
                @case(6) <div class="row">
                    @foreach (App\Models\Product::whereRaw('category_id=4 ||category_id = 3 ||category_id = 5')->get() as $products)
                    @foreach (App\Models\User::whereRaw('id='.$products->user_id)->get() as $OwnerList)

                    <div class="col-md-6 col-lg-3">
                        <div class="card">
                            @foreach (App\Models\ProductImg::whereRaw('product='.$products->id)->limit(1)->get() as $pic)
                            <div class="carousel-item active">
                                <a href="{{ url('shop-view/').'/'.$products->id }}"><img src="{{ asset('public/storage/').'/'.$pic->path }}" class="d-block w-100"></a>
                            </div>
                            @endforeach
                            <h4 class="card-title my-4 ml-4">ชื่อสินค้า {{ $products->name }}</h4>
                            <label class="my-4 ml-4">ร้าน : <a href="{{ url('shop-store/').'/'.$OwnerList->shop_name}}">{{$OwnerList->shop_name}}</a></label>
                            <div class="mt-5 d-flex align-items-center">
                                <div class="product-price">
                                    <strong class="my-4 ml-4">{{ $products->price }} ฿ / {{ $products->unit }} หน่วย</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endforeach
                @break
                @case(7) <div class="row">
                    @foreach (App\Models\Product::whereRaw('category_id=1 ||category_id = 2 ')->get() as $products)
                    @foreach (App\Models\User::whereRaw('id='.$products->user_id)->get() as $OwnerList)

                    <div class="col-md-6 col-lg-3">
                        <div class="card">
                            @foreach (App\Models\ProductImg::whereRaw('product='.$products->id)->limit(1)->get() as $pic)
                            <div class="carousel-item active">
                                <a href="{{ url('shop-view/').'/'.$products->id }}"><img src="{{ asset('public/storage/').'/'.$pic->path }}" class="d-block w-100"></a>
                            </div>
                            @endforeach
                            <h4 class="card-title my-4 ml-4">ชื่อสินค้า {{ $products->name }}</h4>
                            <label class="my-4 ml-4">ร้าน : <a href="{{ url('shop-store/').'/'.$OwnerList->shop_name}}">{{$OwnerList->shop_name}}</a></label>
                            <div class="mt-5 d-flex align-items-center">
                                <div class="product-price">
                                    <strong class="my-4 ml-4">{{ $products->price }} ฿ / {{ $products->unit }} หน่วย</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endforeach
                    @endforeach
                    @break
                    @case(8) <div class="row">
                        @foreach (App\Models\Product::whereRaw('category_id=7 ')->get() as $products)
                        @foreach (App\Models\User::whereRaw('id='.$products->user_id)->get() as $OwnerList)

                        <div class="col-md-6 col-lg-3">
                            <div class="card">
                                @foreach (App\Models\ProductImg::whereRaw('product='.$products->id)->limit(1)->get() as $pic)
                                <div class="carousel-item active">
                                    <a href="{{ url('shop-view/').'/'.$products->id }}"><img src="{{ asset('public/storage/').'/'.$pic->path }}" class="d-block w-100"></a>
                                </div>
                                @endforeach
                                <h4 class="card-title my-4 ml-4">ชื่อสินค้า {{ $products->name }}</h4>
                                <label class="my-4 ml-4">ร้าน : <a href="{{ url('shop-store/').'/'.$OwnerList->shop_name}}">{{$OwnerList->shop_name}}</a></label>
                                <div class="mt-5 d-flex align-items-center">
                                    <div class="product-price">
                                        <strong class="my-4 ml-4">{{ $products->price }} ฿ / {{ $products->unit }} หน่วย</strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endforeach
                        @endforeach
                        @break
                        @case(9) <div class="row">
                            @foreach (App\Models\Product::whereRaw('category_id=1 ||category_id = 2 ')->get() as $products)
                            @foreach (App\Models\User::whereRaw('id='.$products->user_id)->get() as $OwnerList)

                            <div class="col-md-6 col-lg-3">
                                <div class="card">
                                    @foreach (App\Models\ProductImg::whereRaw('product='.$products->id)->limit(1)->get() as $pic)
                                    <div class="carousel-item active">
                                        <a href="{{ url('shop-view/').'/'.$products->id }}"><img src="{{ asset('public/storage/').'/'.$pic->path }}" class="d-block w-100"></a>
                                    </div>
                                    @endforeach
                                    <h4 class="card-title my-4 ml-4">ชื่อสินค้า {{ $products->name }}</h4>
                                    <label class="my-4 ml-4">ร้าน : <a href="{{ url('shop-store/').'/'.$OwnerList->shop_name}}">{{$OwnerList->shop_name}}</a></label>
                                    <div class="mt-5 d-flex align-items-center">
                                        <div class="product-price">
                                            <strong class="my-4 ml-4">{{ $products->price }} ฿ / {{ $products->unit }} หน่วย</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endforeach
                            @endforeach
                            @break
                            @default
                            ไม่มีข้อมูลสินค้าที่จะแสดงสำรหับผู้ดูแลระบบ
                            @endswitch

                        </div>



                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

@endsection
@extends('layouts.admin.main')

@section('content')
<section class="wp-chart mb-4 card">
    <div class="card-header">
        <h3>ข้อมูลหมวดหมู่สินค้า</h3>
    </div>
    <div class="row">
        <div class="col-md-12">
            <center>
                <div id="chartContainer1" style="height: 370px; width: 90%;"></div>
            </center>
        </div>
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
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-success text-white">
                    ผู้ประกอบการรายอื่น ๆ
                </div>
                <br/>
                <center>
                    <div id="chartContainer2" style="height: 400px; width: 90%;"></div>
                </center>
                <br/>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<script type="text/javascript">
    {{$idrole = Auth::user()->getIdRoles()}}
    @php
        $data_points  = array();
        $data_points_products  = array();
        // $count = DB::table('role_user')->where('role_id', 1)->count();
        if($idrole == 9){
            $count = DB::table("role_user")
                ->select(DB::raw("label , count(role_user.user_id) count "))
                ->join('roles', 'roles.id', '=', 'role_user.role_id')
                ->whereRaw("role_id BETWEEN 3 and 6")
                ->groupBy("label")
                ->havingRaw("COUNT(role_user.user_id)")
                ->get();

            $countproducts = DB::table("products")
                ->select(DB::raw(" categories.name, count(category_id) count "))
                ->join('categories', 'categories.id', '=', 'products.category_id')
                ->whereRaw(" categories.id BETWEEN 1 and 2 ")
                ->groupBy("categories.name")
                ->havingRaw("COUNT(category_id)")
                ->get();
        }
        elseif($idrole == 3 || $idrole == 4 || $idrole == 5 || $idrole == 6){
            $count = DB::table("role_user")
                ->select(DB::raw("label , count(role_user.user_id) count "))
                ->join('roles', 'roles.id', '=', 'role_user.role_id')
                ->whereRaw("role_id = 9 or role_id = 7")
                ->groupBy("label")
                ->havingRaw("COUNT(role_user.user_id)")
                ->get();

            $countproducts = DB::table("products")
                ->select(DB::raw(" categories.name, count(category_id) count "))
                ->join('categories', 'categories.id', '=', 'products.category_id')
                ->whereRaw("categories.id = 3 or categories.id = 10 or categories.id BETWEEN 4 and 5  ")
                ->groupBy("categories.name")
                ->havingRaw("COUNT(category_id)")
                ->get();
        }
        elseif($idrole == 7){
            $count = DB::table("role_user")
                ->select(DB::raw("label , count(role_user.user_id) count "))
                ->join('roles', 'roles.id', '=', 'role_user.role_id')
                ->whereRaw("role_id BETWEEN 3 and 6 or role_id = 8")
                ->groupBy("label")
                ->havingRaw("COUNT(role_user.user_id)")
                ->get();

            $countproducts = DB::table("products")
                ->select(DB::raw(" categories.name, count(category_id) count "))
                ->join('categories', 'categories.id', '=', 'products.category_id')
                ->whereRaw("categories.id BETWEEN 6 and 9 or categories.id = 11 or categories.id BETWEEN 1 and 2  ")
                ->groupBy("categories.name")
                ->havingRaw("COUNT(category_id)")
                ->get();
        }
        elseif($idrole == 8){
            $count = DB::table("role_user")
                ->select(DB::raw("label , count(role_user.user_id) count "))
                ->join('roles', 'roles.id', '=', 'role_user.role_id')
                ->whereRaw("role_id = $idrole-1 ")
                ->groupBy("label")
                ->havingRaw("COUNT(role_user.user_id)")
                ->get();

            $countproducts = DB::table("products")
                ->select(DB::raw(" categories.name, count(category_id) count "))
                ->join('categories', 'categories.id', '=', 'products.category_id')
                ->whereRaw("categories.id BETWEEN 4 and 5 ")
                ->groupBy("categories.name")
                ->havingRaw("COUNT(category_id)")
                ->get();
        }
        else{
            $count = DB::table("role_user")
                ->select(DB::raw("label , count(role_user.user_id) count "))
                ->join('roles', 'roles.id', '=', 'role_user.role_id')
                ->whereRaw("role_id BETWEEN 3 and 8 ")
                ->groupBy("label")
                ->havingRaw("COUNT(role_user.user_id)")
                ->get();

            $countproducts = DB::table("products")
                ->select(DB::raw(" categories.name, count(category_id) count "))
                ->join('categories', 'categories.id', '=', 'products.category_id')
                ->whereRaw("categories.id BETWEEN 1 and 11 ")
                ->groupBy("categories.name")
                ->havingRaw("COUNT(category_id)")
                ->get();
        }
    @endphp

    @foreach($count as $countuser)
        @php
            $point = array("label" => $countuser->label, "y" => $countuser->count);
            array_push($data_points, $point);
        @endphp
    @endforeach

    @foreach($countproducts as $produts)
        @php
            $point = array("label" => $produts->name, "y" => $produts->count);
            array_push($data_points_products, $point);
        @endphp
    @endforeach

    window.onload = function () {
        var chart1 = new CanvasJS.Chart("chartContainer1",{
            animationEnabled: true,
            exportEnabled: true,
            theme: "light1", // "light1", "light2", "dark1", "dark2"
            title:{
                text: "หมวดหมู่สินค้า"
            },
            axisY: {
            includeZero: true
            },
            data: [{
                type: "column", //change type to bar, line, area, pie, etc
                //indexLabel: "{y}", //Shows y value on all Data Points
                indexLabelFontColor: "#5A5757",
                indexLabelFontSize: 16,
                indexLabelPlacement: "outside",
                dataPoints: @php echo json_encode($data_points_products, JSON_NUMERIC_CHECK); @endphp
            }]
        });
        var chart2 = new CanvasJS.Chart("chartContainer2",{
            title :{
            // text: "Live Data"
            },
            data: [{
            type: "column",
            dataPoints : @php echo json_encode($data_points, JSON_NUMERIC_CHECK); @endphp
            }]
        });

        chart1.render();
        chart2.render();
    }
</script>


@endsection

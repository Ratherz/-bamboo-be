@extends('layouts.admin.main')

@section('content')

    <div class="card">
        <div class="card-header">Product {{ $product->id }}</div>
        <div class="card-body">
            @if ($product->user_id == Auth::user()->id)
                <a href="{{ url('/products') }}" title="Back"><button class="btn btn-warning btn-sm"><i
                            class="fa fa-arrow-left" aria-hidden="true"></i> ย้อนกลับ</button></a>
                <a href="{{ url('/products/' . $product->id . '/edit') }}" title="Edit Product"><button
                        class="btn btn-primary btn-sm"><i class="fa fa-pencil-square" aria-hidden="true"></i>
                        แก้ไข</button></a>
                {!! Form::open([
                'method' => 'DELETE',
                'url' => ['products', $product->id],
                'style' => 'display:inline',
                ]) !!}
                {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i> ลบ', [
                'type' => 'submit',
                'class' => 'btn btn-danger btn-sm',
                'title' => 'Delete Product',
                'onclick' => 'return confirm("Confirm delete?")',
                ]) !!}
                {!! Form::close() !!}
                <br />
                <br />

                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $product->id }}</td>
                            </tr>
                            <tr>
                                <th> {{ trans('products.name') }} </th>
                                <td> {{ $product->name }} </td>
                            </tr>
                            <tr>
                                <th> {{ trans('products.price') }} </th>
                                <td> {{ $product->price }} </td>
                            </tr>
                            <tr>
                                <th> {{ trans('products.unit') }} </th>
                                <td> {{ $product->unit }} </td>
                            </tr>
                            <tr>
                                <th> {{ trans('products.category_id') }} </th>
                                <td> {{ $product->category_id }} </td>
                            </tr>
                            <tr>
                                <th> {{ trans('products.file_image') }} </th>
                                <td>
                                    @foreach ($productImg as $item)
                                        <img src="{{ url('public/storage/' . $item['path']) }}"
                                            style="width: 300px;height: 200px;object-fit: cover;">
                                    @endforeach
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

        </div>
    </div>
@else
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>สินค้านี้ไม่ใช่สินค้าของคุณโปรดอย่าพยายามเข้าถึง</strong>
    </div>

    <script>
        $(".alert").alert();

    </script>
    @endif



@endsection

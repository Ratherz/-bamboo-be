@extends('layouts.admin.main')

@section('content')

<div class="card">
    <div class="card-header">Products</div>
    <div class="card-body">
        <a href="{{ url('/products/create') }}" class="btn btn-success btn-sm" title="Add New Product">
            <i class="fa fa-plus" aria-hidden="true"></i> เพิ่มใหม่
        </a>

        {!! Form::open(['method' => 'GET', 'url' => '/products', 'class' => 'form-inline my-2 my-lg-0 float-right',
        'role' => 'search']) !!}
        <div class="input-group">
            <input type="text" class="form-control" name="search" placeholder="ค้นหา..."
                value="{{ request('search') }}">
            <span class="input-group-append">
                <button class="btn btn-secondary" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </span>
        </div>
        {!! Form::close() !!}

        <br />
        <br />
        <div class="table-responsive">
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ trans('products.name') }}</th>
                        <th>{{ trans('products.price') }}</th>
                        <th>{{ trans('products.unit') }}</th>
                        <th>{{ trans('products.category_id') }}</th>
                        <th>{{ trans('products.file_image') }}</th>
                        <th>การกระทำ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->price }}</td>
                        <td>{{ $item->unit }}</td>
                        <td>{{ $item->category_id }}</td>
                        <td>{{ $item->file_image }}</td>
                        <td>
                            <a href="{{ url('/products/' . $item->id) }}" title="View Product"><button
                                    class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i>
                                    ดู</button></a>
                            <a href="{{ url('/products/' . $item->id . '/edit') }}" title="Edit Product"><button
                                    class="btn btn-primary btn-sm"><i class="fa fa-pencil-square"
                                        aria-hidden="true"></i> แก้ไข</button></a>
                            {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/products', $item->id],
                            'style' => 'display:inline'
                            ]) !!}
                            {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i> ลบ', array(
                            'type' => 'submit',
                            'class' => 'btn btn-danger btn-sm',
                            'title' => 'Delete Product',
                            'onclick'=>'return confirm("ยืนยันที่จะลบ ?")'
                            )) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination-wrapper"> {!! $products->appends(['search' => Request::get('search')])->render() !!}
            </div>
        </div>

    </div>
</div>

@endsection

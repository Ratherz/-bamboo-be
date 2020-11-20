@extends('layouts.admin.main')

@section('content')
    <div class="card">
        <div class="card-header">Category {{ $category->id }}</div>
        <div class="card-body">

            <a href="{{ url('/categories') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> ย้อนกลับ</button></a>
            <a href="{{ url('/categories/' . $category->id . '/edit') }}" title="Edit Category"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square" aria-hidden="true"></i> แก้ไข</button></a>
            {!! Form::open([
                'method'=>'DELETE',
                'url' => ['categories', $category->id],
                'style' => 'display:inline'
            ]) !!}
                {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i> ลบ', array(
                        'type' => 'submit',
                        'class' => 'btn btn-danger btn-sm',
                        'title' => 'Delete Category',
                        'onclick'=>'return confirm("Confirm delete?")'
                ))!!}
            {!! Form::close() !!}
            <br/>
            <br/>

            <div class="table-responsive">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <th>ID</th><td>{{ $category->id }}</td>
                        </tr>
                        <tr><th> {{ trans('categories.name') }} </th><td> {{ $category->name }} </td></tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>



@endsection

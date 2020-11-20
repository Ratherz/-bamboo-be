@extends('layouts.admin.main')

@section('content')
    <div class="card">
        <div class="card-header">Role {{ $role->id }}</div>
        <div class="card-body">

            <a href="{{ url('/roles') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> ย้อนกลับ</button></a>
            <a href="{{ url('/roles/' . $role->id . '/edit') }}" title="Edit Role"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square" aria-hidden="true"></i> แก้ไข</button></a>
            {!! Form::open([
                'method'=>'DELETE',
                'url' => ['roles', $role->id],
                'style' => 'display:inline'
            ]) !!}
                {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i> ลบ', array(
                        'type' => 'submit',
                        'class' => 'btn btn-danger btn-sm',
                        'title' => 'Delete Role',
                        'onclick'=>'return confirm("Confirm delete?")'
                ))!!}
            {!! Form::close() !!}
            <br/>
            <br/>

            <div class="table-responsive">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <th>ID</th><td>{{ $role->id }}</td>
                        </tr>
                        <tr><th> {{ trans('roles.name') }} </th><td> {{ $role->name }} </td></tr><tr><th> {{ trans('roles.label') }} </th><td> {{ $role->label }} </td></tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>



@endsection

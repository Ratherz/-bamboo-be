@extends('layouts.admin.main')

@section('content')

    <div class="card">
        <div class="card-header">Roles</div>
        <div class="card-body">
            <a href="{{ url('/roles/create') }}" class="btn btn-success btn-sm" title="Add New Role">
                <i class="fa fa-plus" aria-hidden="true"></i> เพิ่มใหม่
            </a>

            {!! Form::open(['method' => 'GET', 'url' => '/roles', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="ค้นหา..." value="{{ request('search') }}">
                <span class="input-group-append">
                    <button class="btn btn-secondary" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
            {!! Form::close() !!}

            <br/>
            <br/>
            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th>#</th><th>{{ trans('roles.name') }}</th><th>{{ trans('roles.label') }}</th><th>การกระทำ</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td><td>{{ $item->label }}</td>
                            <td>
                                <a href="{{ url('/roles/' . $item->id) }}" title="View Role"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> ดู</button></a>
                                <a href="{{ url('/roles/' . $item->id . '/edit') }}" title="Edit Role"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square" aria-hidden="true"></i> แก้ไข</button></a>
                                {!! Form::open([
                                    'method'=>'DELETE',
                                    'url' => ['/roles', $item->id],
                                    'style' => 'display:inline'
                                ]) !!}
                                    {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i> ลบ', array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-sm',
                                            'title' => 'Delete Role',
                                            'onclick'=>'return confirm("ยืนยันที่จะลบ ?")'
                                    )) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="pagination-wrapper"> {!! $roles->appends(['search' => Request::get('search')])->render() !!} </div>
            </div>

        </div>
    </div>

@endsection

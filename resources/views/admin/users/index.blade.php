@extends('layouts.admin.main')

@section('content')

<div class="card">
    <div class="card-header">Users</div>
    <div class="card-body">
        <a href="{{ url('/users/create') }}" class="btn btn-success btn-sm" title="Add New User">
            <i class="fa fa-plus" aria-hidden="true"></i> เพิ่มใหม่
        </a>

        {!! Form::open(['method' => 'GET', 'url' => '/users', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role'
        => 'search']) !!}
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
                        <th>{{ trans('users.email') }}</th>
                        {{-- <th>{{ trans('users.email_verified_at') }}</th> --}}
                        {{-- <th>{{ trans('users.password') }}</th> --}}
                        {{-- <th>{{ trans('users.remember_token') }}</th> --}}
                        <th>{{ trans('users.activate') }}</th>
                        <th>{{ trans('users.file_image') }}</th>
                        <th>{{ trans('users.first_name') }}</th>
                        <th>{{ trans('users.last_name') }}</th>
                        <th>{{ trans('users.phone') }}</th>
                        <th>{{ trans('users.address') }}</th>
                        <th>{{ trans('users.address_no') }}</th>
                        <th>{{ trans('users.zoi') }}</th>
                        <th>{{ trans('users.road') }}</th>
                        <th>{{ trans('users.district') }}</th>
                        <th>{{ trans('users.amphure') }}</th>
                        <th>{{ trans('users.province') }}</th>
                        <th>{{ trans('users.zip') }}</th>
                        {{-- <th>{{ trans('users.firebase_uid') }}</th> --}}
                        <th>การกระทำ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->email }}</td>
                        {{-- <td>{{ $item->email_verified_at }}</td> --}}
                        {{-- <td>{{ $item->password }}</td> --}}
                        {{-- <td>{{ $item->remember_token }}</td> --}}
                        <td>{{ $item->activate }}</td>
                        <td>{{ $item->file_image }}</td>
                        <td>{{ $item->first_name }}</td>
                        <td>{{ $item->last_name }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>{{ $item->address }}</td>
                        <td>{{ $item->address_no }}</td>
                        <td>{{ $item->zoi }}</td>
                        <td>{{ $item->road }}</td>
                        <td>{{ $item->district }}</td>
                        <td>{{ $item->amphure }}</td>
                        <td>{{ $item->province }}</td>
                        <td>{{ $item->zip }}</td>
                        {{-- <td>{{ $item->firebase_uid }}</td> --}}
                        <td>
                            <a href="{{ url('/users/' . $item->id) }}" title="View User"><button
                                    class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i>
                                    ดู</button></a>
                            <a href="{{ url('/users/' . $item->id . '/edit') }}" title="Edit User"><button
                                    class="btn btn-primary btn-sm"><i class="fa fa-pencil-square"
                                        aria-hidden="true"></i> แก้ไข</button></a>
                            {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/users', $item->id],
                            'style' => 'display:inline'
                            ]) !!}
                            {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i> ลบ', array(
                            'type' => 'submit',
                            'class' => 'btn btn-danger btn-sm',
                            'title' => 'Delete User',
                            'onclick'=>'return confirm("ยืนยันที่จะลบ ?")'
                            )) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination-wrapper"> {!! $users->appends(['search' => Request::get('search')])->render() !!}
            </div>
        </div>

    </div>
</div>

@endsection

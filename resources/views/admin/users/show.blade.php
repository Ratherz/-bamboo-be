@extends('layouts.admin.main')

@section('content')
    <div class="card">
        <div class="card-header">User {{ $user->id }}</div>
        <div class="card-body">

            <a href="{{ url('/users') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> ย้อนกลับ</button></a>
            <a href="{{ url('/users/' . $user->id . '/edit') }}" title="Edit User"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square" aria-hidden="true"></i> แก้ไข</button></a>
            {!! Form::open([
                'method'=>'DELETE',
                'url' => ['users', $user->id],
                'style' => 'display:inline'
            ]) !!}
                {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i> ลบ', array(
                        'type' => 'submit',
                        'class' => 'btn btn-danger btn-sm',
                        'title' => 'Delete User',
                        'onclick'=>'return confirm("Confirm delete?")'
                ))!!}
            {!! Form::close() !!}
            <br/>
            <br/>

            <div class="table-responsive">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <th>ID</th><td>{{ $user->id }}</td>
                        </tr>
                        <tr><th> {{ trans('users.email') }} </th><td> {{ $user->email }} </td></tr><tr><th> {{ trans('users.email_verified_at') }} </th><td> {{ $user->email_verified_at }} </td></tr><tr><th> {{ trans('users.password') }} </th><td> {{ $user->password }} </td></tr><tr><th> {{ trans('users.remember_token') }} </th><td> {{ $user->remember_token }} </td></tr><tr><th> {{ trans('users.activate') }} </th><td> {{ $user->activate }} </td></tr><tr><th> {{ trans('users.file_image') }} </th><td> {{ $user->file_image }} </td></tr><tr><th> {{ trans('users.first_name') }} </th><td> {{ $user->first_name }} </td></tr><tr><th> {{ trans('users.last_name') }} </th><td> {{ $user->last_name }} </td></tr><tr><th> {{ trans('users.phone') }} </th><td> {{ $user->phone }} </td></tr><tr><th> {{ trans('users.address') }} </th><td> {{ $user->address }} </td></tr><tr><th> {{ trans('users.address_no') }} </th><td> {{ $user->address_no }} </td></tr><tr><th> {{ trans('users.zoi') }} </th><td> {{ $user->zoi }} </td></tr><tr><th> {{ trans('users.road') }} </th><td> {{ $user->road }} </td></tr><tr><th> {{ trans('users.district') }} </th><td> {{ $user->district }} </td></tr><tr><th> {{ trans('users.amphure') }} </th><td> {{ $user->amphure }} </td></tr><tr><th> {{ trans('users.province') }} </th><td> {{ $user->province }} </td></tr><tr><th> {{ trans('users.zip') }} </th><td> {{ $user->zip }} </td></tr><tr><th> {{ trans('users.firebase_uid') }} </th><td> {{ $user->firebase_uid }} </td></tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>



@endsection

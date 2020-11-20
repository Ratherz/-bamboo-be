@extends('layouts.admin.main')

@section('content')

    <div class="card">
        <div class="card-header">Edit Role #{{ $role->id }}</div>
        <div class="card-body">
            <a href="{{ url('/roles') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> ย้อนกลับ</button></a>
            <br />
            <br />

            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            {!! Form::model($role, [
                'method' => 'PATCH',
                'url' => ['/roles', $role->id],
                'class' => 'form-horizontal',
                'files' => true
            ]) !!}

            @include ('admin.roles.form', ['formMode' => 'edit'])

            {!! Form::close() !!}

        </div>
    </div>



@endsection

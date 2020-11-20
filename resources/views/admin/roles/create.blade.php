@extends('layouts.admin.main')

@section('content')
    <div class="card">
        <div class="card-header">Create New Role</div>
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

            {!! Form::open(['url' => '/roles', 'class' => 'form-horizontal', 'files' => true]) !!}

            @include ('admin.roles.form', ['formMode' => 'create'])

            {!! Form::close() !!}

        </div>
    </div>



@endsection

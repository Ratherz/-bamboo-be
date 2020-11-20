@extends('layouts.admin.main')

@section('content')
    @php
    $databaseName = \DB::connection()->getDatabaseName();
    $tables = DB::select("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND
    TABLE_SCHEMA='$databaseName'");

    @endphp
    <div class="card">
        <div class="card-header">ตัวช่วยสร้าง</div>
        <div class="card-body">
            <form class="form-horizontal" method="post" action="{{ url('/generator') }}">
                {{ csrf_field() }}
                <div class="row  pt-1 pb-1">
                    <label for="crud_name" class="col-3 text-right">Crud Name:</label>
                    <div class="col-9">
                        <input type="text" name="crud_name" class="form-control" id="crud_name" placeholder="Posts"
                            required="true">
                    </div>
                </div>

                <div class="row pt-1 pb-1">
                    <div class="col-3 text-right"><label for="selected_table">Select table :</label></div>
                    <div class="col-9">
                        <select class="form-control" name="selected_table" id="selected_table" onchange="changeCrudName()">
                            @foreach ($tables as $table)
                                <option value="{{ $table->TABLE_NAME }}">{{ $table->TABLE_NAME }}</option>
                            @endforeach
                            <option></option>
                        </select>
                    </div>
                </div>

                <div class="row  pt-1 pb-1">
                    <label for="controller_namespace" class="col-3 text-right">Controller
                        Namespace:</label>
                    <div class="col-9">
                        <input type="text" name="controller_namespace" class="form-control" value="Admin"
                            id="controller_namespace" placeholder="Admin">
                    </div>
                </div>
                <div class="row  pt-1 pb-1">
                    <label for="controller_namespace" class="col-3 text-right">Model
                        Namespace:</label>
                    <div class="col-9">
                        <input type="text" name="model_namespace" class="form-control" value="Models" id="model_namespace"
                            placeholder="">
                    </div>
                </div>
                <div class="row pt-1 pb-1">
                    <label for="route_group" class="col-3 text-right">Route Group
                        Prefix:</label>
                    <div class="col-9">
                        <input type="text" name="route_group" class="form-control" id="route_group" value="admin"
                            placeholder="admin">
                    </div>
                </div>
                <div class="row pt-1 pb-1">
                    <label for="view_path" class="col-3 text-right">View Path:</label>
                    <div class="col-9">
                        <input type="text" name="view_path" class="form-control" id="view_path" value="admin"
                            placeholder="admin">
                    </div>
                </div>
                <div class="row pt-1 pb-1">
                    <label for="route" class="col-3 text-right">Want to add route?</label>
                    <div class="col-9">
                        <select name="route" class="form-control" id="route">
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <label for="form_helper" class="col-3 text-right">Form Helper</label>
                    <div class="col-9">
                        <input type="text" name="form_helper" class="form-control" id="form_helper"
                            placeholder="laravelcollective" value="laravelcollective">
                    </div>
                </div>
                <input type="hidden" name="soft_deletes" value="no">
                <input type="hidden" name="localize" value="th">
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <label for="choice">ต้องการจะสร้างอะไร</label>
                        <select class="form-control" name="choice" id="choice">
                            <option value="CRUD">CRUD</option>
                            <option value="Controller">Controller</option>
                            <option value="Model">Model</option>
                            <option value="View">View</option>
                            <option value="Migration">Migration</option>
                            <option value="Lang">Lang</option>
                            <option value="API CRUD">API CRUD</option>
                            <option value="API Controller">API Controller</option>
                        </select>
                    </div>
                    <div class="col-md-8">
                        <label for=""></label>
                        <button type="submit" class="btn btn-primary w-100 h-50 mt-2" name="generate">กดเพื่อสร้าง</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if (session('flash_message'))
        <div class="alert alert-success">
            {{ session('flash_message') }}
        </div>
    @endif
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click', '.btn-add', function(e) {
                e.preventDefault();
                var tableFields = $('.table-fields'),
                    currentEntry = $(this).parents('.entry:first'),
                    newEntry = $(currentEntry.clone()).appendTo(tableFields);
                newEntry.find('input').val('');
                tableFields.find('.entry:not(:last) .btn-add')
                    .removeClass('btn-add').addClass('btn-remove')
                    .removeClass('btn-success').addClass('btn-danger')
                    .html('<span class="fa fa-minus"></span>');
            }).on('click', '.btn-remove', function(e) {
                $(this).parents('.entry:first').remove();

                e.preventDefault();
                return false;
            });
        });

        function changeCrudName() {
            var value = $("#selected_table").val();
            value = value.split("_");
            var rawName = '';
            value.forEach(element => {
                rawName += capitalize(element);
            });
            $("#crud_name").val(rawName);
        }

        const capitalize = (s) => {
            if (typeof s !== 'string') return ''
            return s.charAt(0).toUpperCase() + s.slice(1)
        }

    </script>
@endsection

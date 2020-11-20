<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', trans('products.name'), ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] :
    ['class' => 'form-control']) !!}
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
    {!! Form::label('price', trans('products.price'), ['class' => 'control-label']) !!}
    {!! Form::number('price', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] :
    ['class' => 'form-control']) !!}
    {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('unit') ? 'has-error' : ''}}">
    {!! Form::label('unit', trans('products.unit'), ['class' => 'control-label']) !!}
    {!! Form::text('unit', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] :
    ['class' => 'form-control']) !!}
    {!! $errors->first('unit', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('category_id') ? 'has-error' : ''}}">
    {!! Form::label('category_id', trans('products.category_id'), ['class' => 'control-label']) !!}
    {!! Form::select($name='category_id',
    $list=App\Models\Category::whereRaw("name in ('ไผ่ลำต้น','ไผ่หน่อ')")->pluck('name','id'), null, ['class' =>
    'form-control']) !!}
    {!! $errors->first('category_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('file_image') ? 'has-error' : ''}}">
    {!! Form::label('file_image', trans('products.file_image'), ['class' => 'control-label']) !!}
    {!! Form::file('file_image', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] :
    ['class' => 'form-control']) !!}
    {!! $errors->first('file_image', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    {!! Form::label('description', trans('products.description'), ['class' => 'control-label']) !!}
    {!! Form::textArea('description', null, ('required' == 'required') ? ['class' => 'form-control'] :
    ['class' => 'form-control']) !!}
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'แก้ไข' : 'สร้าง', ['class' => 'btn btn-primary']) !!}
</div>

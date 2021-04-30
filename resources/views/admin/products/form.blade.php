<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    {!! Form::label('name', trans('products.name'), ['class' => 'control-label']) !!}
    {!! Form::text('name', null, 'required' == 'required' ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
    {!! Form::label('price', trans('products.price'), ['class' => 'control-label']) !!}
    {!! Form::number('price', null, 'required' == 'required' ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('unit') ? 'has-error' : '' }}">
    {!! Form::label('unit', trans('products.unit'), ['class' => 'control-label']) !!}
    {!! Form::text('unit', null, 'required' == 'required' ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('unit', '<p class="help-block">:message</p>') !!}
</div>

@foreach (App\Models\RoleUser::whereRaw('user_id=' . Auth::user()->id)->get() as $list)

@endforeach

@switch($list->role_id)

    @case(3)
        <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
            {!! Form::label('category_id', trans('products.category_id'), ['class' => 'control-label']) !!}
            {!! Form::select($name = 'category_id', $list = App\Models\Category::whereRaw("name in ('ไผ่หน่อ')")->pluck('name', 'id'), null, ['class' => 'form-control']) !!}
            {!! $errors->first('category_id', '<p class="help-block">:message</p>') !!}
        </div>
    @break
    @case(4)
        <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
            {!! Form::label('category_id', trans('products.category_id'), ['class' => 'control-label']) !!}
            {!! Form::select($name = 'category_id', $list = App\Models\Category::whereRaw("name in ('ไผ่ลำต้น')")->pluck('name', 'id'), null, ['class' => 'form-control']) !!}
            {!! $errors->first('category_id', '<p class="help-block">:message</p>') !!}
        </div>
    @break
    @case(5)
        <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
            {!! Form::label('category_id', trans('products.category_id'), ['class' => 'control-label']) !!}
            {!! Form::select($name = 'category_id', $list = App\Models\Category::whereRaw("name in ('ไผ่ลำต้น','ไผ่หน่อ')")->pluck('name', 'id'), null, ['class' => 'form-control']) !!}
            {!! $errors->first('category_id', '<p class="help-block">:message</p>') !!}
        </div>
    @break

    @case(6)
        <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
            {!! Form::label('category_id', trans('products.category_id'), ['class' => 'control-label']) !!}
            {!! Form::select($name = 'category_id', $list = App\Models\Category::whereRaw("name in ('ไผ่ลำต้น','ไผ่หน่อ')")->pluck('name', 'id'), null, ['class' => 'form-control']) !!}
            {!! $errors->first('category_id', '<p class="help-block">:message</p>') !!}
        </div>
    @break
    @case(7)
        <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
            {!! Form::label('category_id', trans('products.category_id'), ['class' => 'control-label']) !!}
            {!! Form::select($name = 'category_id', $list = App\Models\Category::whereRaw("name in ('รับจ้างตัดไผ่')")->pluck('name', 'id'), null, ['class' => 'form-control']) !!}
            {!! $errors->first('category_id', '<p class="help-block">:message</p>') !!}
        </div>
    @break
    @case(8)
        <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
            {!! Form::label('category_id', trans('products.category_id'), ['class' => 'control-label']) !!}
            {!! Form::select($name = 'category_id', $list = App\Models\Category::whereRaw("name in ('อาหาร','ไผ่แปรรูป','วัสดุ','เฟอร์นิเจอร์','สุขภาพ')")->pluck('name', 'id'), null, ['class' => 'form-control']) !!}
            {!! $errors->first('category_id', '<p class="help-block">:message</p>') !!}
        </div>
    @break
    @case(9)
        <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
            {!! Form::label('category_id', trans('products.category_id'), ['class' => 'control-label']) !!}
            {!! Form::select($name = 'category_id', $list = App\Models\Category::whereRaw("name in ('ปุ๋ยสำหรับไผ่','เกษตร')")->pluck('name', 'id'), null, ['class' => 'form-control']) !!}
            {!! $errors->first('category_id', '<p class="help-block">:message</p>') !!}
        </div>
    @break

    @default
        ไม่มีข้อมูลสินค้าที่จะแสดงสำรหับผู้ดูแลระบบ
@endswitch








<!-- 

<form class="form-horizontal" enctype="multipart/form-data" method="post" >
<input required type="file" class="form-control" name="file_image" placeholder="address" multiple>
</form>
 -->

<div class="form-group {{ $errors->has('file_image') ? 'has-error' : '' }}">
    {!! Form::label('file_image', trans('products.file_image'), ['class' => 'control-label']) !!}
    {!! Form::file('file_image[]', ['file' => true, 'class' => 'form-control']) !!}
    {!! $errors->first('file_image', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('file_image2') ? 'has-error' : '' }}">
    {!! Form::label('file_image2', trans('products.file_image'), ['class' => 'control-label']) !!}
    {!! Form::file('file_image2[]', ['file' => true, 'class' => 'form-control']) !!}
    {!! $errors->first('file_image2', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('file_image3') ? 'has-error' : '' }}">
    {!! Form::label('file_image3', trans('products.file_image'), ['class' => 'control-label']) !!}
    {!! Form::file('file_image3[]', ['file' => true, 'class' => 'form-control']) !!}
    {!! $errors->first('file_image3', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
    {!! Form::label('description', trans('products.description'), ['class' => 'control-label']) !!}
    {!! Form::textArea('description', null, 'required' == 'required' ? ['class' => 'form-control'] : ['class' => 'form-control']) !!}
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'แก้ไข' : 'สร้าง', ['class' => 'btn btn-primary']) !!}
</div>

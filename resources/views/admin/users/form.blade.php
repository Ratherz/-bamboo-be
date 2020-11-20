<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    {!! Form::label('email', trans('users.email'), ['class' => 'control-label']) !!}
    {!! Form::text('email', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class'
    => 'form-control']) !!}
    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('email_verified_at') ? 'has-error' : ''}}">
    {!! Form::label('email_verified_at', trans('users.email_verified_at'), ['class' => 'control-label']) !!}
    {!! Form::input('datetime-local', 'email_verified_at', null, ('' == 'required') ? ['class' => 'form-control',
    'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('email_verified_at', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
    {!! Form::label('password', trans('users.password'), ['class' => 'control-label']) !!}
    {!! Form::text('password', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required']
    : ['class' => 'form-control']) !!}
    {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('remember_token') ? 'has-error' : ''}}">
    {!! Form::label('remember_token', trans('users.remember_token'), ['class' => 'control-label']) !!}
    {!! Form::text('remember_token', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] :
    ['class' => 'form-control']) !!}
    {!! $errors->first('remember_token', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('activate') ? 'has-error' : ''}}">
    {!! Form::label('activate', trans('users.activate'), ['class' => 'control-label']) !!}
    {!! Form::number('activate', null, ('required' == 'required') ? ['class' => 'form-control', 'required' =>
    'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('activate', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('file_image') ? 'has-error' : ''}}">
    {!! Form::label('file_image', trans('users.file_image'), ['class' => 'control-label']) !!}
    {!! Form::file('file_image', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] :
    ['class' => 'form-control']) !!}
    {!! $errors->first('file_image', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('first_name') ? 'has-error' : ''}}">
    {!! Form::label('first_name', trans('users.first_name'), ['class' => 'control-label']) !!}
    {!! Form::text('first_name', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] :
    ['class' => 'form-control']) !!}
    {!! $errors->first('first_name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('last_name') ? 'has-error' : ''}}">
    {!! Form::label('last_name', trans('users.last_name'), ['class' => 'control-label']) !!}
    {!! Form::text('last_name', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] :
    ['class' => 'form-control']) !!}
    {!! $errors->first('last_name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
    {!! Form::label('phone', trans('users.phone'), ['class' => 'control-label']) !!}
    {!! Form::text('phone', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class'
    => 'form-control']) !!}
    {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
    {!! Form::label('address', trans('users.address'), ['class' => 'control-label']) !!}
    {!! Form::text('address', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] :
    ['class' => 'form-control']) !!}
    {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('address_no') ? 'has-error' : ''}}">
    {!! Form::label('address_no', trans('users.address_no'), ['class' => 'control-label']) !!}
    {!! Form::text('address_no', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] :
    ['class' => 'form-control']) !!}
    {!! $errors->first('address_no', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('zoi') ? 'has-error' : ''}}">
    {!! Form::label('zoi', trans('users.zoi'), ['class' => 'control-label']) !!}
    {!! Form::text('zoi', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' =>
    'form-control']) !!}
    {!! $errors->first('zoi', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('road') ? 'has-error' : ''}}">
    {!! Form::label('road', trans('users.road'), ['class' => 'control-label']) !!}
    {!! Form::text('road', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class'
    => 'form-control']) !!}
    {!! $errors->first('road', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('district') ? 'has-error' : ''}}">
    {!! Form::label('district', trans('users.district'), ['class' => 'control-label']) !!}
    {!! Form::text('district', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] :
    ['class' => 'form-control']) !!}
    {!! $errors->first('district', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('amphure') ? 'has-error' : ''}}">
    {!! Form::label('amphure', trans('users.amphure'), ['class' => 'control-label']) !!}
    {!! Form::text('amphure', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] :
    ['class' => 'form-control']) !!}
    {!! $errors->first('amphure', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('province') ? 'has-error' : ''}}">
    {!! Form::label('province', trans('users.province'), ['class' => 'control-label']) !!}
    {!! Form::text('province', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] :
    ['class' => 'form-control']) !!}
    {!! $errors->first('province', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('zip') ? 'has-error' : ''}}">
    {!! Form::label('zip', trans('users.zip'), ['class' => 'control-label']) !!}
    {!! Form::text('zip', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' =>
    'form-control']) !!}
    {!! $errors->first('zip', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('firebase_uid') ? 'has-error' : ''}}">
    {!! Form::label('firebase_uid', trans('users.firebase_uid'), ['class' => 'control-label']) !!}
    {!! Form::text('firebase_uid', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] :
    ['class' => 'form-control']) !!}
    {!! $errors->first('firebase_uid', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('firebase_uid') ? 'has-error' : ''}}">
    <label for="roles-assign">บทบาท</label>
    {!! Form::select('Roles[]', App\Models\Role::pluck('label','id'),!empty($user)?
    $user->roles->pluck('role_id','role_id') :
    null,
    ['id'=>'roles-assign','multiple'=>true,'class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'แก้ไข' : 'สร้าง', ['class' => 'btn btn-primary']) !!}
</div>

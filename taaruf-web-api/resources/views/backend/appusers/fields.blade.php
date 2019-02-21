<!-- Gender Field -->
<div class="form-group col-sm-6">
    {!! Form::label('gender', 'Gender:') !!}
    {!! Form::text('gender', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- No Hp Field -->
<div class="form-group col-sm-6">
    {!! Form::label('no_hp', 'No Hp:') !!}
    {!! Form::text('no_hp', null, ['class' => 'form-control']) !!}
</div>

<!-- Otp Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('otp_code', 'Otp Code:') !!}
    {!! Form::number('otp_code', null, ['class' => 'form-control']) !!}
</div>

<!-- Verified Field -->
<div class="form-group col-sm-6">
    {!! Form::label('verified', 'Verified:') !!}
    {!! Form::text('verified', null, ['class' => 'form-control']) !!}
</div>

<!-- Remember Token Field -->
<div class="form-group col-sm-6">
    {!! Form::label('remember_token', 'Remember Token:') !!}
    {!! Form::text('remember_token', null, ['class' => 'form-control']) !!}
</div>

<!-- Device Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('device_id', 'Device Id:') !!}
    {!! Form::text('device_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('backend.appusers.index') !!}" class="btn btn-default">Cancel</a>
</div>

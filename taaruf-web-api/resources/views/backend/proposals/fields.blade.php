<!-- Id Pengirim Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_pengirim', 'Id Pengirim:') !!}
    {!! Form::number('id_pengirim', null, ['class' => 'form-control']) !!}
</div>

<!-- Id Penerima Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_penerima', 'Id Penerima:') !!}
    {!! Form::number('id_penerima', null, ['class' => 'form-control']) !!}
</div>

<!-- Isi Proposal Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('isi_proposal', 'Isi Proposal:') !!}
    {!! Form::textarea('isi_proposal', null, ['class' => 'form-control']) !!}
</div>

<!-- Readed Field -->
<div class="form-group col-sm-6">
    {!! Form::label('readed', 'Readed:') !!}
    {!! Form::text('readed', null, ['class' => 'form-control']) !!}
</div>

<!-- Respon Field -->
<div class="form-group col-sm-6">
    {!! Form::label('respon', 'Respon:') !!}
    {!! Form::text('respon', null, ['class' => 'form-control']) !!}
</div>

<!-- Balasan Penerima Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('balasan_penerima', 'Balasan Penerima:') !!}
    {!! Form::textarea('balasan_penerima', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('backend.proposals.index') !!}" class="btn btn-default">Cancel</a>
</div>

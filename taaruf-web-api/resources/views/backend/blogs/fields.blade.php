<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Picture Field -->
<div class="form-group col-sm-6">
    {!! Form::label('picture', 'Picture:') !!}
    <div class="input-group">
        {!! Form::text('picture', null, ['class' => 'form-control', 'id' => 'picture']) !!}
        <div class="input-group-append">
            <button type="button" class="btn btn-primary midia" data-input="picture">Pilih Gambar</button>
        </div>
    </div>
</div>

<!-- Content Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('content', 'Content:') !!}
    {!! Form::textarea('content', null, ['class' => 'form-control summernote']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('backend.blogs.index') !!}" class="btn btn-default">Cancel</a>
</div>

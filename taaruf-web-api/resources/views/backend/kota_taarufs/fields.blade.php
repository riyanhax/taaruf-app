<!-- Nama Field -->
<div class="form-group col-sm-6">
    {!! Form::label('picture', 'Picture:') !!}
        <div class="input-group">
            {!! Form::text('nama', null, ['class' => 'form-control', 'id' => 'nama']) !!}
            <div class="input-group-append">
                <button type="button" class="btn btn-primary midia" data-input="nama">Pilih Gambar</button>
            </div>
        </div>
    </div>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('administrative', 'Administrative:') !!}
    {!! Form::text('administrative', (isset($kotaTaaruf) ? (optional($kotaTaaruf->province_data)->province ? optional($kotaTaaruf->province_data)->province . ' > ' : '') . (optional($kotaTaaruf->city_data)->city_name ? optional($kotaTaaruf->city_data)->city_name . ' > ' : '') . optional($kotaTaaruf->subdistrict_data)->subdistrict_name : ''), ['class' => 'form-control typeahead', 'autocomplete' => 'off', 'placeholder' => 'Ketik Nama Kecamatan']) !!}
    @isset($kotaTaaruf)
    <div class="form-text text-muted">Biarkan jika tidak diubah</div>
    @endisset
</div>

{!! Form::hidden('province', null) !!}
{!! Form::hidden('city', null) !!}
{!! Form::hidden('subdistrict', null) !!}

<!-- Address Field -->
<div class="form-group col-sm-12 col-lg-6">
    {!! Form::label('address', 'Address:') !!}
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('backend.kotaTaarufs.index') !!}" class="btn btn-default">Cancel</a>
</div>

@section('scripts')
<script>
    let _item = [];
    $('.typeahead').typeahead({
        ajax: {
            url: '{{url('api/v1/administrative/search')}}',
            preProcess: function (data) {
                if (!data) {
                    // Hide the list, there was some error
                    return false;
                }
                // We good!
                $.each(data, function(i, item) {
                    _item[item.id] = item;
                });
                return data;
            }
        },
        onSelect: function(item) {
            var selected = _item[item.value];

            $("input[name=subdistrict]").val(selected.subdistrict.id);
            $("input[name=city]").val(selected.city.id);
            $("input[name=province]").val(selected.province.id);
            // add_sparepart(_item[item.value]);
        }
    });
</script>
@stop
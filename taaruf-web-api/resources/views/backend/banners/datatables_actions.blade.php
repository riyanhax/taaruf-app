{!! Form::open(['route' => ['backend.banners.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
{{--     <a href="{{ route('backend.banners.show', $id) }}" class='btn btn-default btn-xs'>
        View
    </a>
 --}}    <a href="{{ route('backend.banners.edit', $id) }}" class='btn btn-default btn-xs'>
        Edit
    </a>
    {!! Form::button('Delete', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => "return confirm('Are you sure?')"
    ]) !!}
</div>
{!! Form::close() !!}

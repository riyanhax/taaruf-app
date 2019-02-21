{!! Form::open(['route' => ['backend.appusers.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('backend.appusers.show', $id) }}" class='btn btn-default btn-xs'>
        View
    </a>
    <a href="{{ route('backend.appusers.edit', $id) }}" class='btn btn-default btn-xs'>
        Edit
    </a>
    {!! Form::button('Delete', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => "return confirm('Are you sure?')"
    ]) !!}
</div>
{!! Form::close() !!}

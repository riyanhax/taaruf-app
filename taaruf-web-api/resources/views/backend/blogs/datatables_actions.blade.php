{!! Form::open(['route' => ['backend.blogs.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
{{--     <a href="{{ route('backend.blogs.show', $id) }}" class='btn btn-default btn-xs'>
        View
    </a>
 --}}    <a href="{{ route('backend.blogs.edit', $id) }}" class='btn btn-default btn-xs'>
        Edit
    </a>
    {!! Form::button('Delete', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => "return confirm('Are you sure?')"
    ]) !!}
</div>
{!! Form::close() !!}

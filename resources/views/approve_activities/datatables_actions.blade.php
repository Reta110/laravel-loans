{!! Form::open(['route' => ['approve-activities.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @can('advancedActions')
    <a href="{{ route('approve-activities.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-eye-open"></i>
    </a>

    <a href="{{ route('approve-activities.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-check"></i>
    </a>
    @endcan
    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
    'type' => 'submit',
    'class' => 'btn btn-danger btn-xs',
    'onclick' => "return confirm('".__('messages.are_you_sure')."')",
    ]) !!}
    
</div>
{!! Form::close() !!}
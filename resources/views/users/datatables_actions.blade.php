{!! Form::open(['route' => ['users.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('users.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-eye-open"></i>
    </a>
    @can('advancedActions')
      <a href="{{ route('users.edit', $id) }}" class='btn btn-default btn-xs'>
          <i class="glyphicon glyphicon-edit"></i>
      </a>
      {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
          'type' => 'submit',
          'class' => 'btn btn-danger btn-xs',
          'onclick' => "return confirm('".__('messages.are_you_sure')."')",
      ]) !!}
      @endcan
</div>
{!! Form::close() !!}

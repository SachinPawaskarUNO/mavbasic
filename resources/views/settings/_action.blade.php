<div class='pull-right'>
    <button type="button" class="btn btn-default btn-primary dropdown-toggle"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Actions <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
        <li><a href="{{ url('/' . $resource) }}"><i class="fa fa-fw fa-btn fa-list-alt"></i>All</a></li>
        @if($CRUD_Action != 'Create')
            @if($CRUD_Action == 'Update')
                @ability('sysadmin,admin','manage-'.$resource.',view-'.$resource)
                <li><a href="{{ url('/' . $resource . '/' . $id) }}"><i class="fa fa-fw fa-btn fa-undo"></i>Discard Changes</a></li>
                @endability
            @else
                @ability('sysadmin,admin','manage-'.$resource.',edit-'.$resource)
                <li><a href="{{ url('/' . $resource . '/' . $id . '/edit') }}"><i class="fa fa-fw fa-btn fa-pencil-square-o"></i>Edit</a></li>
                @endability
            @endif
        @endif
    </ul>
</div>

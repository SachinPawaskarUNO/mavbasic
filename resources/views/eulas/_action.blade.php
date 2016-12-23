@if($CRUD_Action == 'List')
    @ability('sysadmin,admin','manage-'.$resource.',create-'.$resource)
    <div class='pull-right'>
        <button type="button" class="btn btn-default btn-primary dropdown-toggle"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Actions <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            <li><a href="{{ url('/' . $resource. '/create') }}"><i class="fa fa-fw fa-btn fa-file-o"></i>Create</a></li>
        </ul>
    </div>
    @endability
@else
    <div class='pull-right'>
        <button type="button" class="btn btn-default btn-primary dropdown-toggle"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Actions <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            <li><a href="{{ url('/' . $resource) }}"><i class="fa fa-fw fa-btn fa-list-alt"></i>All</a></li>
            @if($CRUD_Action != 'Create')
                @ability('sysadmin,admin','manage-'.$resource.',create-'.$resource)
                <li><a href="{{ url('/' . $resource. '/create') }}"><i class="fa fa-fw fa-btn fa-file-o"></i>Create</a></li>
                @endability
                @if($CRUD_Action == 'Update')
                    @ability('sysadmin,admin','manage-'.$resource.',view-'.$resource)
                    <li><a href="{{ url('/' . $resource . '/' . $object->id) }}"><i class="fa fa-fw fa-btn fa-undo"></i>Discard Changes</a></li>
                    @endability
                @else
                    @if ($object->status === 'Draft')
                    @ability('sysadmin,admin','manage-'.$resource.',edit-'.$resource)
                    <li><a href="{{ url('/' . $resource . '/' . $object->id . '/edit') }}"><i class="fa fa-fw fa-btn fa-pencil-square-o"></i>Edit</a></li>
                    @endability
                    @endif
                @endif
                @if (! in_array("delete", $disableMenu))
                    @ability('sysadmin,admin','manage-'.$resource.',delete-'.$resource)
                    <li>
                        <form class= 'delete-menu' action="{{ url('/' . $resource . '/' . $object->id) }}" method="POST" onsubmit="return deleteConfirm();">
                            {{ csrf_field() }}{{ method_field('DELETE') }}
                            <button type="submit" id="delete" class="actionlink"><i class="fa fa-fw fa-btn fa-trash-o"></i>Delete</button>
                        </form>
                    </li>
                    @endability
                @endif
            @endif
        </ul>
    </div>
@endif

<div class='pull-right'>
    <button type="button" class="btn btn-default btn-primary dropdown-toggle"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Actions <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
        <li><a href="{{ url('/' . $resource) }}"><i class="fa fa-fw fa-btn fa-list-alt"></i>All</a></li>
        @if($audit->activity == 'deleted')
            @ability('sysadmin','manage-'.$resource.',restore-'.$resource)
            <li><a href="{{ url('/' . $resource . '/' . $id . '/restore') }}"><i class="fa fa-fw fa-btn fa-trash" style="color: green;"></i>Restore Trash</a></li>
            @endability
        @endif
    </ul>
</div>

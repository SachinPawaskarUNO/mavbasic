<div class='pull-right'>
    <button type="button" class="btn btn-default btn-primary dropdown-toggle"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        @lang('labels.actions') <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
        <li><a href="{{ url('/' . $resource) }}"><i class="fa fa-fw fa-btn fa-list-alt"></i>@lang('labels.all')</a></li>
        @if($audit->activity === 'deleted')
            @ability('sysadmin','manage-'.$resource.',restore-'.$resource)
            <li><a href="{{ url('/' . $resource . '/' . $object->id . '/restore') }}"><i class="fa fa-fw fa-btn fa-trash" style="color: green;"></i>@lang('labels.restore_trash')</a></li>
            @endability
        @endif
    </ul>
</div>

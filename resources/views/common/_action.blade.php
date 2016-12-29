{{--
 * Action buttons for Views
 *
 * @category   Action for Views
 * @package    Common
 * @author     Sachin Pawaskar - spawaskar@unomaha.edu
 * @copyright  2016-2017
 * @license    The MIT License (MIT)
 * @version    GIT: $Id$
 * @since      File available since Release 1.0.0
--}}

{{--
 * Reusable action buttons for views based off view context (CRUD functionality)
 * @params: $CRUD_Action : ['List', 'Create', 'View', 'Update']
 * @params: $resource : The route resource name e.g. 'users', 'roles'
 * @params: $object : The actual instance of the model
 * @params: $disableMenu : ['list', 'create', 'update', 'delete', 'discard']
 * @params: $pluginMenus : []
   eg. 'pluginMenus' => [array('url' => 'users/'.$user->id.'/settings', 'menuicon' => 'fa-cog', 'menulabel' => 'labels.settings'),
                         array('url' => 'users/'.$user->id.'/settings', 'menuicon' => 'fa-institution', 'menulabel' => 'labels.orgs')]])
--}}

@if($CRUD_Action == 'List')
@ability('sysadmin,admin','manage-'.$resource.',create-'.$resource)
<div class='pull-right'>
    <button type="button" class="btn btn-default btn-primary dropdown-toggle"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        @lang('labels.actions') <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
        @if (! in_array("list", $disableMenu))
        <li><a href="{{ url('/' . $resource. '/create') }}"><i class="fa fa-fw fa-btn fa-file-o"></i>@lang('labels.create')</a></li>
        @endif
    </ul>
</div>
@endability
@else
<div class='pull-right'>
    <button type="button" class="btn btn-default btn-primary dropdown-toggle"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        @lang('labels.actions') <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
        @if (! in_array("list", $disableMenu))
        <li><a href="{{ url('/' . $resource) }}"><i class="fa fa-fw fa-btn fa-list-alt"></i>@lang('labels.all')</a></li>
        @endif
        @if($CRUD_Action != 'Create')
            @if (! in_array("create", $disableMenu))
            @ability('sysadmin,admin','manage-'.$resource.',create-'.$resource)
            <li><a href="{{ url('/' . $resource. '/create') }}"><i class="fa fa-fw fa-btn fa-file-o"></i>@lang('labels.create')</a></li>
            @endability
            @endif
            @if($CRUD_Action == 'Update')
                @if (! in_array("discard", $disableMenu))
                @ability('sysadmin,admin','manage-'.$resource.',view-'.$resource)
                <li><a href="{{ url('/' . $resource . '/' . $object->id) }}"><i class="fa fa-fw fa-btn fa-undo"></i>@lang('labels.discard_changes')</a></li>
                @endability
                @endif
            @else
                @if (! in_array("edit", $disableMenu))
                @ability('sysadmin,admin','manage-'.$resource.',edit-'.$resource)
                <li><a href="{{ url('/' . $resource . '/' . $object->id . '/edit') }}"><i class="fa fa-fw fa-btn fa-pencil-square-o"></i>@lang('labels.edit')</a></li>
                @endability
                @endif
            @endif
            @if (! in_array("delete", $disableMenu))
            @ability('sysadmin,admin','manage-'.$resource.',delete-'.$resource)
            <li>
                <form class= 'delete-menu' action="{{ url('/' . $resource . '/' . $object->id) }}" method="POST" onsubmit="return deleteConfirm();">
                    {{ csrf_field() }}{{ method_field('DELETE') }}
                    <button type="submit" id="delete" class="actionlink"><i class="fa fa-fw fa-btn fa-trash-o"></i>@lang('labels.delete')</button>
                </form>
            </li>
            @endability
            @endif
        @endif
        @if (! empty($pluginMenus))
            <li class="divider"></li>
            @foreach($pluginMenus as $menu)
                <li><a href="{{ url($menu['url']) }}"><i class="fa fa-fw fa-btn {{ $menu['menuicon'] }}"></i>@lang($menu['menulabel'])</a></li>
            @endforeach
        @endif
    </ul>
</div>
@endif
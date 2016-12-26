@if (Auth::user()->getSettingJsonValuesCount($setting) && Auth::user()->getSettingValue($setting) != 0)
    <li class="dropdown-submenu">
        <a tabindex="-1" href="#"><i class="fa fa-btn fa-fw fa-list-ol"></i>@lang('labels.'.$menu)</a>
        <ul class="dropdown-menu">
            @foreach(Auth::user()->getSettingJsonValuesArray($setting) as $current)
            <li><a href="{{ url('/'.$resource.'/'.$current['id'].'/') }}"><i class="fa fa-btn fa-fw {{ $menuicon }}"></i>{{$current['name']}}</a></li>
            @endforeach
        </ul>
    </li>
@endif

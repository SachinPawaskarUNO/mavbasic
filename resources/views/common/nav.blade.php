<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <div class="pull-left navbar-brand" style="padding: 0px;">
                <a class="navbar-brand" style="padding: 0px;" href="{{ url('/') }}"><img src="/images/UNO-icon-color.png" style="height: 48px;"></a>
            </div>

        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            @if (Auth::check())
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li><a href="{{ url('/home') }}"><i class="fa fa-btn fa-fw fa-lg fa-home"></i></a></li>
                {{-- Menu for Users with Administration Role Only --}}
                @ability('sysadmin,admin', 'manage-users,create-users,edit-users,view-users,delete-users,
                          manage-roles,create-roles,edit-roles,view-roles,delete-roles,
                          manage-settings,create-settings,edit-settings,view-settings,delete-settings')
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <i class="fa fa-btn fa-fw fa-cogs"></i>@lang('labels.administration')<span class="caret"></span></a>

                    <ul class="dropdown-menu multi level" role="menu">
                        @ability('sysadmin,admin', 'manage-users,create-users,edit-users,view-users,delete-users,manage-roles,create-roles,edit-roles,view-roles,delete-roles')
                        <li class="dropdown-submenu">
                            <a tabindex="-1" href="#"><i class="fa fa-btn fa-fw fa-user-secret"></i>@lang('labels.user_management')</a>
                            <ul class="dropdown-menu">
                                @ability('admin', 'manage-users,create-users,edit-users,view-users,delete-users')
                                <li><a href="{{ url('/users') }}"><i class="fa fa-btn fa-fw fa-user"></i>@lang('labels.users')</a></li>
                                @endability
                                @ability('admin', 'manage-roles,create-roles,edit-roles,view-roles,delete-roles')
                                <li><a href="{{ url('/roles') }}"><i class="fa fa-btn fa-fw fa-users"></i>@lang('labels.roles')</a></li>
                                @endability
                                @include ('common._mrulist', ['setting' => 'MRUList_Users', 'menu' => 'recent_users', 'menuicon' => 'fa-user', 'resource' => 'users'])
                            </ul>
                        </li>
                        @endability
                        @ability('sysadmin,admin', 'manage-settings,create-settings,edit-settings,view-settings,delete-settings')
                        <li><a href="{{ url('/settings') }}"><i class="fa fa-btn fa-fw fa-cog"></i>@lang('labels.setting_management')</a></li>
                        <li><a href="{{ url('/eulas') }}"><i class="fa fa-btn fa-fw fa-gavel"></i>@lang('labels.eula_management')</a></li>
                        @endability
                        @ability('sysadmin', '')
                        <li class="divider"></li>
                        <li><a href="{{ url('/orgs') }}"><i class="fa fa-btn fa-fw fa-institution"></i>@lang('labels.org_management')</a></li>
                        <li><a href="{{ url('/audits') }}"><i class="fa fa-btn fa-fw fa-binoculars"></i>@lang('labels.audit_management')</a></li>
                        @endability

                        {{--<li class="divider"></li>--}}
                        {{--<li><a href="{{ url('/files') }}"><i class="fa fa-btn fa-fw fa-file"></i>Files</a></li>--}}
                    </ul>
                </li>
                @endability
            </ul>
            @endif

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}"><i class="fa fa-btn fa-fw fa-lg fa-sign-in"></i>@lang('labels.login')</a></li>
                    <li><a href="{{ url('/register') }}">@lang('labels.register')</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <b class="caret"></b></a>
                        {{-- ToDo: See if we should use this menu structure throughout --}}
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa fa-btn fa-fw fa-sign-out"></i>@lang('labels.logout')
                                </a>
                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                            </li>
                            <li><a href="{{ url('/password/change') }}"><i class="fa fa-btn fa-fw fa-lock"></i>@lang('labels.change_password')</a></li>
                            <li><a href="{{ url('/users/'. Auth::user()->id . '/settings') }}"><i class="fa fa-btn fa-fw fa-cog"></i>@lang('labels.settings')</a></li>
                            <li class="divider"></li>
                            <li><a href="https://SachinPawaskarUNO.github.io/mavbasic" target="_blank"><i class="fa fa-btn fa-fw fa-question-circle-o"></i>@lang('labels.online_help')</a></li>
                            <li><a href="#wizard" data-toggle="modal"><i class="fa fa-btn fa-fw fa-info"></i>@lang('labels.about')</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

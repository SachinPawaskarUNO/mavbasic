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
                        <i class="fa fa-btn fa-fw fa-cogs"></i>Administration<span class="caret"></span></a>

                    <ul class="dropdown-menu multi level" role="menu">
                        @ability('sysadmin,admin', 'manage-users,create-users,edit-users,view-users,delete-users,manage-roles,create-roles,edit-roles,view-roles,delete-roles')
                        <li class="dropdown-submenu">
                            <a tabindex="-1" href="#"><i class="fa fa-btn fa-fw fa-user-secret"></i>User Management</a>
                            <ul class="dropdown-menu">
                                @ability('admin', 'manage-users,create-users,edit-users,view-users,delete-users')
                                <li><a href="{{ url('/users') }}"><i class="fa fa-btn fa-fw fa-user"></i>Users</a></li>
                                @endability
                                @ability('admin', 'manage-roles,create-roles,edit-roles,view-roles,delete-roles')
                                <li><a href="{{ url('/roles') }}"><i class="fa fa-btn fa-fw fa-users"></i>Roles</a></li>
                                @endability
                                @include ('common._mrulist', ['setting' => 'MRUList_Users', 'menu' => 'Recent Users', 'menuicon' => 'fa-user', 'resource' => 'users'])
                            </ul>
                        </li>
                        @endability
                        @ability('sysadmin,admin', 'manage-settings,create-settings,edit-settings,view-settings,delete-settings')
                        <li><a href="{{ url('/settings') }}"><i class="fa fa-btn fa-fw fa-cog"></i>Setting Management</a></li>
                        @endability
                        @ability('sysadmin', '')
                        <li class="divider"></li>
                        <li><a href="{{ url('/audits') }}"><i class="fa fa-btn fa-fw fa-binoculars"></i>Audit Management</a></li>
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
                    <li><a href="{{ url('/login') }}"><i class="fa fa-btn fa-fw fa-lg fa-sign-in"></i>Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <b class="caret"></b></a>
                        {{-- ToDo: See if we should use this menu structure throughout --}}
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa fa-btn fa-fw fa-sign-out"></i>Logout
                                </a>
                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                            </li>
                            <li><a href="{{ url('/password/change') }}"><i class="fa fa-btn fa-fw fa-lock"></i>Change Password</a></li>
                            <li><a href="{{ url('/users/'. Auth::user()->id . '/settings') }}"><i class="fa fa-btn fa-fw fa-cog"></i>Settings</a></li>
                            <li class="divider"></li>
                            <li><a href="https://SachinPawaskarUNO.github.io/mavbasic" target="_blank"><i class="fa fa-btn fa-fw fa-question-circle-o"></i>Online Help</a></li>
                        </ul>

                        {{--<ul class="dropdown-menu" role="menu">--}}
                            {{--<li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-fw fa-sign-out"></i>Logout</a></li>--}}
                            {{--<li><a href="{{ url('/change-password') }}"><i class="fa fa-btn fa-fw fa-lock"></i>Change Password</a></li>--}}
                            {{--<li class="divider"></li>--}}
                            {{--<li><a href="{{ url('/help') }}"><i class="fa fa-btn fa-fw fa-question-circle"></i>Help</a></li>--}}
                        {{--</ul>--}}
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

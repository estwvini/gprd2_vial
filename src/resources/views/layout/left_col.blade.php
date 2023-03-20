<style>
    .left_col, .nav_title {
        background-color: {{ $menuStyles['color'] }} !important;
    }

    .nav-sm ul.nav.child_menu, li.active, .nav.side-menu > li.active > a,
    li.active-sm {
        background: {{ $menuStyles['active_color'] }};
    }

    .scroll-submenu {
        max-height: 200px;
        overflow-y: auto;
        overflow-x: hidden;
    }

    .profile_info span, .profile_info h2,
    span.fa-chevron-down, .nav-md ul.nav.child_menu li:after,
    .nav-md ul.nav.child_menu li:before, .nav.side-menu > li.active,
    .nav.side-menu > li.current-page, .nav-sm .nav.child_menu li.active,
    .nav-sm .nav.side-menu li.active-sm, .nav.child_menu > li > a,
    .nav.side-menu > li > a {
        color: {{ $menuStyles['text_color'] }};
    }

</style>

<div class="left_col scroll-view hidden-print">
    <div class="navbar nav_title">
        <table class="height-auto gad-table mt-3 mr-3 mb-3 ml-3">
            <tr>
                <td><img src="{{ mix($logos['menu_logo']) }}" alt="LOGO" /></td>
                <td class="pl-3 gad-title"><span>{{ $gad['province_short_name'] }}</span></td>
            </tr>
        </table>
    </div>
    <div class="clearfix"></div>

    <!-- menu profile quick info -->
    <div class="profile">
        <div class="profile_pic">
            <img src="{{ mix(currentUser()->photoPath()) }}" alt="..." class="img-circle profile_img">
        </div>
        <div class="profile_info">
            <span>{{ trans('app.labels.welcome') }},</span>
            <h2>@currentfullname</h2>
        </div>
    </div>
    <!-- /menu profile quick info -->

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu" style="margin-top: 20px;">
        <div class="menu_section">
            <h3>&nbsp;</h3>

            <ul class="nav side-menu">

                @if(!currentUser()->hasRole('developer') && session()->get('module')->id == \Laverix\Acl\Models\Eloquent\Module::MODULE_GXR)
                    <li>
                        <a class="ajaxify start" href="{{ route('index.tasks') }}">
                            <i class="fa fa-tasks"></i> {{ trans('user_tasks.title') }}
                        </a>
                    </li>
                @endif

                <li>
                    <a class="ajaxify {{ session()->get('module')->id != \Laverix\Acl\Models\Eloquent\Module::MODULE_GXR ? 'start':'' }}" href="{{ $defaultRoute }}">
                        <i class="fa fa-dashboard"></i> {{ trans('app.labels.dashboard') }}
                    </a>
                </li>

                @each('layout.partial.menu', $menus, 'menu')

                @role('developer')
                <li>
                    <a href="javascript:">
                        <i class="fa fa-wrench"></i> {{ trans('configuration.title') }}
                        <span class="fa fa-chevron-down"></span>
                    </a>

                    <ul class="nav child_menu">
                        <li>
                            <a href="{{ route('index.permissions.configuration') }}" class="ajaxify">
                                {{ trans('configuration.permission.title') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('index.roles.configuration') }}" class="ajaxify">
                                {{ trans('configuration.role.title') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('index.menus.configuration') }}" class="ajaxify">
                                {{ trans('configuration.menu.title') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('edit.ui.configuration') }}" class="ajaxify">
                                {{ trans('configuration.ui.title') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('index.settings.configuration') }}" class="ajaxify">
                                {{ trans('configuration.setting.title') }}
                            </a>
                        </li>
                    </ul>
                </li>
                @endrole
            </ul>
        </div>
    </div>
    <!-- /sidebar menu -->

    <!-- /menu footer buttons -->
    <div class="sidebar-footer hidden-small">
        <a href="{{ route('dashboard.app') }}" class="ajaxify" title="{{ trans('app.labels.dashboard') }}" data-toggle="tooltip" data-placement="top">
            <span class="glyphicon glyphicon-dashboard"></span>
        </a>

        <a href="{{ route('index.profile') }}" class="ajaxify" title="{{ trans('app.labels.profile') }}" data-toggle="tooltip" data-placement="top">
            <span class="glyphicon glyphicon-user"></span>
        </a>

        <a href="javascript:" title="{{ trans('app.labels.change_password') }}" id="change-passwd-left" data-toggle="tooltip" data-placement="top">
            <span class="fa fa-key"></span>
        </a>

        <a href="{{ route('logout') }}" class="logout" title="{{ trans('app.labels.exit') }}" data-toggle="tooltip" data-placement="top">
            <span class="glyphicon glyphicon-off"></span>
        </a>
    </div>

    <!-- /menu footer buttons -->
</div>

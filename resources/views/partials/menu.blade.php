<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        @can('user_management_access')
            <li class="c-sidebar-nav-item">
                <a target="_blank" href="{{ route("admin.livedash") }}" class="c-sidebar-nav-link">
                    <i class="c-sidebar-nav-icon fas fa-fw fa-phone fa-tachometer-alt">

                    </i>
                    {{ trans('global.livedash') }}
                </a>
            </li>
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('csat_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/answers*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-address-card c-sidebar-nav-icon">
                    </i>
                    {{ trans('cruds.csat.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('csat_report')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.csat.answers") }}" class="c-sidebar-nav-link {{ request()->is("csat/answers") || request()->is("csat/answers") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-external-link-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.csat.answers') }}
                            </a>
                        </li>
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.csat.answers_horizontal") }}" class="c-sidebar-nav-link {{ request()->is("csat/answers_horizontal") || request()->is("csat/answers_horizontal") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-external-link-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.csat.answers_horizontal') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('abandoned_call_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.abandoned-calls.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/abandoned-calls") || request()->is("admin/abandoned-calls/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-ban c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.abandonedCall.title') }}
                </a>
            </li>
        @endcan
        @can('contact_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.contacts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/contacts") || request()->is("admin/contacts/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-ship c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.contact.title') }}
                </a>
            </li>
        @endcan
        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                        </i>
                        {{ trans('global.change_password') }}
                    </a>
                </li>
            @endcan
        @endif
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>

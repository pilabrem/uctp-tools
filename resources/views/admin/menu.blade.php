@inject('request', 'Illuminate\Http\Request')

@can('manage users')

<li class="{{ $request->segment(1) == 'settings' ? 'active' : '' }}">
    <a href="{{ route('settings.setting.index') }}">
        <i class="fa fa-gears"></i>
        <span class="title">@lang('global.settings')</span>
    </a>
</li>

<li
    class="treeview {{(Route::is('admin.users.*') || Route::is('admin.roles.*') || Route::is('admin.permissions.*')) ? 'active' : null}}">
    <a href="#">
        <i class="fa fa-users"></i>
        <span class="title">@lang('global.user-management.title')</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li class="{{ $request->segment(2) == 'permissions' ? 'active active-sub' : '' }}">
            <a href="{{ route('admin.permissions.index') }}">
                <i class="fa fa-briefcase"></i>
                <span class="title">
                    @lang('global.permissions.title')
                </span>
            </a>
        </li>
        <li class="{{ $request->segment(2) == 'roles' ? 'active active-sub' : '' }}">
            <a href="{{ route('admin.roles.index') }}">
                <i class="fa fa-briefcase"></i>
                <span class="title">
                    @lang('global.roles.title')
                </span>
            </a>
        </li>
        <li class="{{ $request->segment(2) == 'users' ? 'active active-sub' : '' }}">
            <a href="{{ route('admin.users.index') }}">
                <i class="fa fa-user"></i>
                <span class="title">
                    @lang('global.users.title')
                </span>
            </a>
        </li>
    </ul>
</li>
@endcan

<li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
    <a href="{{ route('auth.change_password') }}">
        <i class="fa fa-key"></i>
        <span class="title">@lang('global.change_password.title')</span>
    </a>
</li>


@can('manage users')

@if (Route::has('generator_tables.generator_table.index'))
<li class="{{ $request->segment(1) == 'generator_tables' ? 'active' : '' }}">
    <a href="{{ route('generator_tables.generator_table.index') }}" target="_blank">
        <i class="fa fa-code"></i>
        <span class="title">Code generator</span>
    </a>
</li>
@endif

@endcan

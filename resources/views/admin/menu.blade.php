<li class="{{ Route::is('problem_view_forms.problem_view_form.*') ? 'active' : '' }}">
    <a href="{{ route('problem_view_forms.problem_view_form.index') }}">
        <i class="fa fa-circle" style="color: red;"></i>
        <span class="title">Problem instance viewer</span>
    </a>
</li>
<li class="{{ Route::is('solution_view_forms.solution_view_form.*') ? 'active' : '' }}">
    <a href="{{ route('solution_view_forms.solution_view_form.index') }}">
        <i class="fa fa-circle" style="color: green;"></i>
        <span class="title">Solution instance viewer</span>
    </a>
</li>

@can('manage users')

    <li class="{{ Route::is('settings.setting.*') ? 'active' : '' }}">
        <a href="{{ route('settings.setting.index') }}">
            <i class="fa fa-gears"></i>
            <span class="title">@lang('global.settings')</span>
        </a>
    </li>

    <li
        class="treeview {{ Route::is('admin.users.*') || Route::is('admin.roles.*') || Route::is('admin.permissions.*') ? 'active' : null }}">
        <a href="#">
            <i class="fa fa-users"></i>
            <span class="title">@lang('global.user-management.title')</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{ Route::is('admin.permissions.*') ? 'active active-sub' : '' }}">
                <a href="{{ route('admin.permissions.index') }}">
                    <i class="fa fa-briefcase"></i>
                    <span class="title">
                        @lang('global.permissions.title')
                    </span>
                </a>
            </li>
            <li class="{{ Route::is('admin.roles.*') ? 'active active-sub' : '' }}">
                <a href="{{ route('admin.roles.index') }}">
                    <i class="fa fa-briefcase"></i>
                    <span class="title">
                        @lang('global.roles.title')
                    </span>
                </a>
            </li>
            <li class="{{ Route::is('admin.users.*') ? 'active active-sub' : '' }}">
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

@auth
    <li class="{{ Route::is('auth.change_password') ? 'active' : '' }}">
        <a href="{{ route('auth.change_password') }}">
            <i class="fa fa-key"></i>
            <span class="title">@lang('global.change_password.title')</span>
        </a>
    </li>
@endauth



@can('manage users')
    @if (Route::has('generator_tables.generator_table.index'))
        <li class="{{ Route::is('generator_tables.generator_table.*') ? 'active' : '' }}">
            <a href="{{ route('generator_tables.generator_table.index') }}" target="_blank">
                <i class="fa fa-code"></i>
                <span class="title">Code generator</span>
            </a>
        </li>
        @if (env('APP_ENV') === 'local')
            <li class="{{ Route::is('import_shema_from_xmls.import_shema_from_xml.*') ? 'active' : '' }}">
                <a href="{{ route('import_shema_from_xmls.import_shema_from_xml.index') }}" target="_blank">
                    <i class="fa fa-code"></i>
                    <span class="title">Import Schema (diagrams.net)</span>
                </a>
            </li>
        @endif
    @endif
@endcan

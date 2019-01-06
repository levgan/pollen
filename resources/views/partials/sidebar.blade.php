@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">

             

            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/') }}">
                    <i class="fa fa-wrench"></i>
                    <span class="title">@lang('global.app_dashboard')</span>
                </a>
            </li>

            @can('user_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>@lang('global.user-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('permission_access')
                    <li>
                        <a href="{{ route('admin.permissions.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span>@lang('global.permissions.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('role_access')
                    <li>
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span>@lang('global.roles.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('user_access')
                    <li>
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-user"></i>
                            <span>@lang('global.users.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            
            @can('table_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i>
                    <span>@lang('global.table-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('poll_access')
                    <li>
                        <a href="{{ route('admin.polls.index') }}">
                            <i class="fa fa-table"></i>
                            <span>@lang('global.polls.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('question_access')
                    <li>
                        <a href="{{ route('admin.questions.index') }}">
                            <i class="fa fa-table"></i>
                            <span>@lang('global.questions.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('questiontype_access')
                    <li>
                        <a href="{{ route('admin.questiontypes.index') }}">
                            <i class="fa fa-table"></i>
                            <span>@lang('global.questiontypes.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('option_access')
                    <li>
                        <a href="{{ route('admin.options.index') }}">
                            <i class="fa fa-table"></i>
                            <span>@lang('global.options.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('response_access')
                    <li>
                        <a href="{{ route('admin.responses.index') }}">
                            <i class="fa fa-table"></i>
                            <span>@lang('global.responses.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            
            @can('vote_access')
            <li>
                <a href="{{ route('admin.votes.index') }}">
                    <i class="fa fa-check-square-o"></i>
                    <span>@lang('global.vote.title')</span>
                </a>
            </li>@endcan
            

            

            



            <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">@lang('global.app_change_password')</span>
                </a>
            </li>

            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('global.app_logout')</span>
                </a>
            </li>
        </ul>
    </section>
</aside>


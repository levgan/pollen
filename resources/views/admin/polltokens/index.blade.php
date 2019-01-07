@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.polltokens.title')</h3>
    @can('polltoken_create')
    <p>
        <a href="{{ route('admin.polltokens.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.polltokens.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.polltokens.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
        </ul>
    </p>
    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($polltokens) > 0 ? 'datatable' : '' }} @can('polltoken_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('polltoken_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('global.polltokens.fields.title')</th>
                        <th>@lang('global.polltokens.fields.description')</th>
                        <th>@lang('global.polltokens.fields.user')</th>
                        <th>@lang('global.users.fields.email')</th>
                        <th>@lang('global.polltokens.fields.token')</th>
                        <th>@lang('global.polltokens.fields.poll')</th>
                        <th>@lang('global.polls.fields.description')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($polltokens) > 0)
                        @foreach ($polltokens as $polltoken)
                            <tr data-entry-id="{{ $polltoken->id }}">
                                @can('polltoken_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='title'>{{ $polltoken->title }}</td>
                                <td field-key='description'>{{ $polltoken->description }}</td>
                                <td field-key='user'>{{ $polltoken->user->name ?? '' }}</td>
<td field-key='email'>{{ isset($polltoken->user) ? $polltoken->user->email : '' }}</td>
                                <td field-key='token'>{{ $polltoken->token }}</td>
                                <td field-key='poll'>{{ $polltoken->poll->title ?? '' }}</td>
<td field-key='description'>{{ isset($polltoken->poll) ? $polltoken->poll->description : '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.polltokens.restore', $polltoken->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.polltokens.perma_del', $polltoken->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('polltoken_view')
                                    <a href="{{ route('admin.polltokens.show',[$polltoken->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('polltoken_edit')
                                    <a href="{{ route('admin.polltokens.edit',[$polltoken->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('polltoken_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.polltokens.destroy', $polltoken->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('polltoken_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.polltokens.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection
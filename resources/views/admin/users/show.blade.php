@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.users.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.users.fields.name')</th>
                            <td field-key='name'>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.email')</th>
                            <td field-key='email'>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.users.fields.role')</th>
                            <td field-key='role'>
                                @foreach ($user->role as $singleRole)
                                    <span class="label label-info label-many">{{ $singleRole->title }}</span>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#responses" aria-controls="responses" role="tab" data-toggle="tab">Responses</a></li>
<li role="presentation" class=""><a href="#polltokens" aria-controls="polltokens" role="tab" data-toggle="tab">Poll tokens</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="responses">
<table class="table table-bordered table-striped {{ count($responses) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.responses.fields.user')</th>
                        <th>@lang('global.responses.fields.name')</th>
                        <th>@lang('global.responses.fields.question')</th>
                        <th>@lang('global.responses.fields.option')</th>
                        <th>@lang('global.responses.fields.poll')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($responses) > 0)
            @foreach ($responses as $response)
                <tr data-entry-id="{{ $response->id }}">
                    <td field-key='user'>{{ $response->user->name ?? '' }}</td>
                                <td field-key='name'>{{ $response->name }}</td>
                                <td field-key='question'>{{ $response->question->title ?? '' }}</td>
                                <td field-key='option'>{{ $response->option->title ?? '' }}</td>
                                <td field-key='poll'>{{ $response->poll->title ?? '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.responses.restore', $response->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.responses.perma_del', $response->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('response_view')
                                    <a href="{{ route('admin.responses.show',[$response->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('response_edit')
                                    <a href="{{ route('admin.responses.edit',[$response->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('response_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.responses.destroy', $response->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="polltokens">
<table class="table table-bordered table-striped {{ count($polltokens) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.polltokens.fields.title')</th>
                        <th>@lang('global.polltokens.fields.description')</th>
                        <th>@lang('global.polltokens.fields.user')</th>
                        <th>@lang('global.polltokens.fields.token')</th>
                        <th>@lang('global.polltokens.fields.poll')</th>
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
                    <td field-key='title'>{{ $polltoken->title }}</td>
                                <td field-key='description'>{{ $polltoken->description }}</td>
                                <td field-key='user'>{{ $polltoken->user->name ?? '' }}</td>
                                <td field-key='token'>{{ $polltoken->token }}</td>
                                <td field-key='poll'>{{ $polltoken->poll->title ?? '' }}</td>
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

            <p>&nbsp;</p>

            <a href="{{ route('admin.users.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop



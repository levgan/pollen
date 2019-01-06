@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.questions.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.questions.fields.title')</th>
                            <td field-key='title'>{{ $question->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.questions.fields.description')</th>
                            <td field-key='description'>{{ $question->description }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.questions.fields.questiontype')</th>
                            <td field-key='questiontype'>
                                @foreach ($question->questiontype as $singleQuestiontype)
                                    <span class="label label-info label-many">{{ $singleQuestiontype->title }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('global.questions.fields.option')</th>
                            <td field-key='option'>
                                @foreach ($question->option as $singleOption)
                                    <span class="label label-info label-many">{{ $singleOption->title }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('global.questions.fields.poll')</th>
                            <td field-key='poll'>
                                @foreach ($question->poll as $singlePoll)
                                    <span class="label label-info label-many">{{ $singlePoll->title }}</span>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#polls" aria-controls="polls" role="tab" data-toggle="tab">Polls</a></li>
<li role="presentation" class=""><a href="#responses" aria-controls="responses" role="tab" data-toggle="tab">Responses</a></li>
<li role="presentation" class=""><a href="#options" aria-controls="options" role="tab" data-toggle="tab">Options</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="polls">
<table class="table table-bordered table-striped {{ count($polls) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.polls.fields.title')</th>
                        <th>@lang('global.polls.fields.description')</th>
                        <th>@lang('global.polls.fields.question')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($polls) > 0)
            @foreach ($polls as $poll)
                <tr data-entry-id="{{ $poll->id }}">
                    <td field-key='title'>{{ $poll->title }}</td>
                                <td field-key='description'>{{ $poll->description }}</td>
                                <td field-key='question'>
                                    @foreach ($poll->question as $singleQuestion)
                                        <span class="label label-info label-many">{{ $singleQuestion->title }}</span>
                                    @endforeach
                                </td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.polls.restore', $poll->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.polls.perma_del', $poll->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('poll_view')
                                    <a href="{{ route('admin.polls.show',[$poll->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('poll_edit')
                                    <a href="{{ route('admin.polls.edit',[$poll->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('poll_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.polls.destroy', $poll->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="responses">
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
<div role="tabpanel" class="tab-pane " id="options">
<table class="table table-bordered table-striped {{ count($options) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.options.fields.title')</th>
                        <th>@lang('global.options.fields.description')</th>
                        <th>@lang('global.options.fields.value')</th>
                        <th>@lang('global.options.fields.question')</th>
                        <th>@lang('global.options.fields.questiontype')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($options) > 0)
            @foreach ($options as $option)
                <tr data-entry-id="{{ $option->id }}">
                    <td field-key='title'>{{ $option->title }}</td>
                                <td field-key='description'>{{ $option->description }}</td>
                                <td field-key='value'>{{ $option->value }}</td>
                                <td field-key='question'>
                                    @foreach ($option->question as $singleQuestion)
                                        <span class="label label-info label-many">{{ $singleQuestion->title }}</span>
                                    @endforeach
                                </td>
                                <td field-key='questiontype'>
                                    @foreach ($option->questiontype as $singleQuestiontype)
                                        <span class="label label-info label-many">{{ $singleQuestiontype->title }}</span>
                                    @endforeach
                                </td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.options.restore', $option->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.options.perma_del', $option->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('option_view')
                                    <a href="{{ route('admin.options.show',[$option->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('option_edit')
                                    <a href="{{ route('admin.options.edit',[$option->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('option_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.options.destroy', $option->id])) !!}
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

            <a href="{{ route('admin.questions.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop



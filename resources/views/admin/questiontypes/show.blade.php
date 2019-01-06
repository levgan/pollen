@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.questiontypes.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.questiontypes.fields.title')</th>
                            <td field-key='title'>{{ $questiontype->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.questiontypes.fields.description')</th>
                            <td field-key='description'>{{ $questiontype->description }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.questiontypes.fields.option')</th>
                            <td field-key='option'>
                                @foreach ($questiontype->option as $singleOption)
                                    <span class="label label-info label-many">{{ $singleOption->title }}</span>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#questions" aria-controls="questions" role="tab" data-toggle="tab">Questions</a></li>
<li role="presentation" class=""><a href="#options" aria-controls="options" role="tab" data-toggle="tab">Options</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="questions">
<table class="table table-bordered table-striped {{ count($questions) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.questions.fields.title')</th>
                        <th>@lang('global.questions.fields.description')</th>
                        <th>@lang('global.questions.fields.questiontype')</th>
                        <th>@lang('global.questions.fields.option')</th>
                        <th>@lang('global.questions.fields.poll')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($questions) > 0)
            @foreach ($questions as $question)
                <tr data-entry-id="{{ $question->id }}">
                    <td field-key='title'>{{ $question->title }}</td>
                                <td field-key='description'>{{ $question->description }}</td>
                                <td field-key='questiontype'>
                                    @foreach ($question->questiontype as $singleQuestiontype)
                                        <span class="label label-info label-many">{{ $singleQuestiontype->title }}</span>
                                    @endforeach
                                </td>
                                <td field-key='option'>
                                    @foreach ($question->option as $singleOption)
                                        <span class="label label-info label-many">{{ $singleOption->title }}</span>
                                    @endforeach
                                </td>
                                <td field-key='poll'>
                                    @foreach ($question->poll as $singlePoll)
                                        <span class="label label-info label-many">{{ $singlePoll->title }}</span>
                                    @endforeach
                                </td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.questions.restore', $question->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.questions.perma_del', $question->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('question_view')
                                    <a href="{{ route('admin.questions.show',[$question->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('question_edit')
                                    <a href="{{ route('admin.questions.edit',[$question->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('question_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.questions.destroy', $question->id])) !!}
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

            <a href="{{ route('admin.questiontypes.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop



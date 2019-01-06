@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.responses.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.responses.fields.user')</th>
                            <td field-key='user'>{{ $response->user->name ?? '' }}</td>
<td field-key='email'>{{ isset($response->user) ? $response->user->email : '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.responses.fields.name')</th>
                            <td field-key='name'>{{ $response->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.responses.fields.question')</th>
                            <td field-key='question'>{{ $response->question->title ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.responses.fields.option')</th>
                            <td field-key='option'>{{ $response->option->title ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.responses.fields.poll')</th>
                            <td field-key='poll'>{{ $response->poll->title ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.responses.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop



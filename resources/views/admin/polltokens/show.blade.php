@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.polltokens.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.polltokens.fields.title')</th>
                            <td field-key='title'>{{ $polltoken->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.polltokens.fields.description')</th>
                            <td field-key='description'>{{ $polltoken->description }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.polltokens.fields.user')</th>
                            <td field-key='user'>{{ $polltoken->user->name ?? '' }}</td>
<td field-key='email'>{{ isset($polltoken->user) ? $polltoken->user->email : '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.polltokens.fields.token')</th>
                            <td field-key='token'>{{ $polltoken->token }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.polltokens.fields.poll')</th>
                            <td field-key='poll'>{{ $polltoken->poll->title ?? '' }}</td>
<td field-key='description'>{{ isset($polltoken->poll) ? $polltoken->poll->description : '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.polltokens.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop



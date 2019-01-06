@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.questiontypes.title')</h3>
    @can('questiontype_create')
    <p>
        <a href="{{ route('admin.questiontypes.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($questiontypes) > 0 ? 'datatable' : '' }} @can('questiontype_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('questiontype_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('global.questiontypes.fields.title')</th>
                        <th>@lang('global.questiontypes.fields.description')</th>
                        <th>@lang('global.questiontypes.fields.option')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($questiontypes) > 0)
                        @foreach ($questiontypes as $questiontype)
                            <tr data-entry-id="{{ $questiontype->id }}">
                                @can('questiontype_delete')
                                    <td></td>
                                @endcan

                                <td field-key='title'>{{ $questiontype->title }}</td>
                                <td field-key='description'>{{ $questiontype->description }}</td>
                                <td field-key='option'>
                                    @foreach ($questiontype->option as $singleOption)
                                        <span class="label label-info label-many">{{ $singleOption->title }}</span>
                                    @endforeach
                                </td>
                                                                <td>
                                    @can('questiontype_view')
                                    <a href="{{ route('admin.questiontypes.show',[$questiontype->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('questiontype_edit')
                                    <a href="{{ route('admin.questiontypes.edit',[$questiontype->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('questiontype_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.questiontypes.destroy', $questiontype->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

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
    </div>
@stop

@section('javascript') 
    <script>
        @can('questiontype_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.questiontypes.mass_destroy') }}';
        @endcan

    </script>
@endsection
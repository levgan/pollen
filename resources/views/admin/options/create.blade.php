@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.options.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.options.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('title', trans('global.options.fields.title').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('title'))
                        <p class="help-block">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('description', trans('global.options.fields.description').'', ['class' => 'control-label']) !!}
                    {!! Form::text('description', old('description'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('description'))
                        <p class="help-block">
                            {{ $errors->first('description') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('value', trans('global.options.fields.value').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('value', old('value'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('value'))
                        <p class="help-block">
                            {{ $errors->first('value') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('question', trans('global.options.fields.question').'', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-question">
                        {{ trans('global.app_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-question">
                        {{ trans('global.app_deselect_all') }}
                    </button>
                    {!! Form::select('question[]', $questions, old('question'), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-question' ]) !!}
                    <p class="help-block"></p>
                    @if($errors->has('question'))
                        <p class="help-block">
                            {{ $errors->first('question') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('questiontype', trans('global.options.fields.questiontype').'', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-questiontype">
                        {{ trans('global.app_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-questiontype">
                        {{ trans('global.app_deselect_all') }}
                    </button>
                    {!! Form::select('questiontype[]', $questiontypes, old('questiontype'), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-questiontype' ]) !!}
                    <p class="help-block"></p>
                    @if($errors->has('questiontype'))
                        <p class="help-block">
                            {{ $errors->first('questiontype') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent

    <script>
        $("#selectbtn-question").click(function(){
            $("#selectall-question > option").prop("selected","selected");
            $("#selectall-question").trigger("change");
        });
        $("#deselectbtn-question").click(function(){
            $("#selectall-question > option").prop("selected","");
            $("#selectall-question").trigger("change");
        });
    </script>

    <script>
        $("#selectbtn-questiontype").click(function(){
            $("#selectall-questiontype > option").prop("selected","selected");
            $("#selectall-questiontype").trigger("change");
        });
        $("#deselectbtn-questiontype").click(function(){
            $("#selectall-questiontype > option").prop("selected","");
            $("#selectall-questiontype").trigger("change");
        });
    </script>
@stop
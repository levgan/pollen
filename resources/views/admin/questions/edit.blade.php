@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.questions.title')</h3>
    
    {!! Form::model($question, ['method' => 'PUT', 'route' => ['admin.questions.update', $question->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('title', trans('global.questions.fields.title').'*', ['class' => 'control-label']) !!}
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
                    {!! Form::label('description', trans('global.questions.fields.description').'', ['class' => 'control-label']) !!}
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
                    {!! Form::label('questiontype', trans('global.questions.fields.questiontype').'', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-questiontype">
                        {{ trans('global.app_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-questiontype">
                        {{ trans('global.app_deselect_all') }}
                    </button>
                    {!! Form::select('questiontype[]', $questiontypes, old('questiontype') ? old('questiontype') : $question->questiontype->pluck('id')->toArray(), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-questiontype' ]) !!}
                    <p class="help-block"></p>
                    @if($errors->has('questiontype'))
                        <p class="help-block">
                            {{ $errors->first('questiontype') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('option', trans('global.questions.fields.option').'', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-option">
                        {{ trans('global.app_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-option">
                        {{ trans('global.app_deselect_all') }}
                    </button>
                    {!! Form::select('option[]', $options, old('option') ? old('option') : $question->option->pluck('id')->toArray(), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-option' ]) !!}
                    <p class="help-block"></p>
                    @if($errors->has('option'))
                        <p class="help-block">
                            {{ $errors->first('option') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('poll', trans('global.questions.fields.poll').'', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-poll">
                        {{ trans('global.app_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-poll">
                        {{ trans('global.app_deselect_all') }}
                    </button>
                    {!! Form::select('poll[]', $polls, old('poll') ? old('poll') : $question->poll->pluck('id')->toArray(), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-poll' ]) !!}
                    <p class="help-block"></p>
                    @if($errors->has('poll'))
                        <p class="help-block">
                            {{ $errors->first('poll') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent

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

    <script>
        $("#selectbtn-option").click(function(){
            $("#selectall-option > option").prop("selected","selected");
            $("#selectall-option").trigger("change");
        });
        $("#deselectbtn-option").click(function(){
            $("#selectall-option > option").prop("selected","");
            $("#selectall-option").trigger("change");
        });
    </script>

    <script>
        $("#selectbtn-poll").click(function(){
            $("#selectall-poll > option").prop("selected","selected");
            $("#selectall-poll").trigger("change");
        });
        $("#deselectbtn-poll").click(function(){
            $("#selectall-poll > option").prop("selected","");
            $("#selectall-poll").trigger("change");
        });
    </script>
@stop
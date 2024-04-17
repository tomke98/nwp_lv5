@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('messages.add_task')</div>
                @if (!Auth::guest())
                <div class="panel-body">
                    <form method="post" action="addAssignment">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="added_by" value="{{ Auth::user()->name }}">
                        <label for="task_name" class="col-md-4 control-label">@lang('messages.name')</label>
                        <input type="text" class="form-control" name="task_name" required>
                        <label for="task_name_eng" class="col-md-4 control-label">@lang('messages.name_english')</label>
                        <input type="text" class="form-control" name="task_name_eng" required>
                        <label for="task_assignment"
                            class="col-md-4 control-label">@lang('messages.description')</label>
                        <input type="text" class="form-control" name="task_assignment" required>
                        <br>
                        <label for="study_type" class="col-md-4 control-label">@lang('messages.study_type')</label>
                        <div class="col-md-3">
                            <select required class="selectpicker" name="study_type">
                                <option value="Diplomski">@lang('messages.graduate')</option>
                                <option value="Preddiplomski">@lang('messages.undergraduate')</option>
                                <option value="Strucni">@lang('messages.prof_stud_prog')</option>
                            </select>
                        </div>
                        <br>
                        <br>
                        <button type="submit"
                            class="btn btn-primary btn-lg btn-block">@lang('messages.add_task')</button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

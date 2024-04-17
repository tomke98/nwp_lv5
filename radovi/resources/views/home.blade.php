@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                @if (!Auth::guest())
                @foreach($dataUsers as $user)
                @if(Auth::user()->email == $user->email)
                <div class="panel-body">
                    <p>@lang('messages.welcome1'){{ $user->name }}@lang('messages.welcome2')</p>
                </div>
                @endif
                @endforeach
                @endif
            </div>
        </div>
    </div>
    @if(!Auth::guest())
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                @if(Auth::user()->role == 'admin')
                <div class="panel-heading">
                    <p>{{ Auth::user()->name }}@lang('messages.admin_message')</p>
                </div>
                <div class="panel-body">
                    <label for="hrvatski" class="col-md-4 control-label">@lang('messages.menu_lang_cro')</label>
                    <form method="post" action="croatian" name="hrvatski">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        <input type="hidden" name="localization" value="hr">
                        <button type="submit" class="btn btn-success">Hr</button>
                    </form>
                    <label for="engleski" class="col-md-4 control-label">@lang('messages.menu_lang_eng')</label>
                    <form method="post" action="english" name="engleski">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        <input type="hidden" name="localization" value="en">
                        <button type="submit" class="btn btn-success">En</button>
                    </form>
                </div>
                <div class="panel-body">
                    @foreach($dataUsers as $user)
                    @if($user->role != 'admin')
                    <div class="row">
                        <div class="col-md-3">
                            <h4>{{ $user->name }}</h4>
                        </div>
                        <div class="col-md-3">
                            <h4>{{ $user->role }}</h4>
                        </div>
                        <div class="col-md-6">
                            <form method="post" action="changeUserRole">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="user_id" value="{{$user->id}}">
                                <div class="col-md-3">
                                    <select required class="selectpicker" name="role">
                                        <option value="nastavnik">@lang('messages.profesor')</option>
                                        <option value="student">@lang('messages.student')</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-info">@lang('messages.button')</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
                @elseif(Auth::user()->role == 'nastavnik')
                <div class="panel-heading">
                    <p>{{ Auth::user()->name }}@lang('messages.prof_message')</p>
                </div>
                <div class="panel-body">
                    <label for="hrvatski" class="col-md-4 control-label">@lang('messages.menu_lang_cro')</label>
                    <form method="post" action="croatian" name="hrvatski">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        <input type="hidden" name="localization" value="hr">
                        <button type="submit" class="btn btn-success">Hr</button>
                    </form>
                    <label for="engleski" class="col-md-4 control-label">@lang('messages.menu_lang_eng')</label>
                    <form method="post" action="english" name="engleski">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        <input type="hidden" name="localization" value="en">
                        <button type="submit" class="btn btn-success">En</button>
                    </form>
                    <a href="{{ url('/addAssignment') }}">@lang('messages.add_task')</a>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">@lang('messages.name')</th>
                                <th scope="col">@lang('messages.name_english')</th>
                                <th scope="col">@lang('messages.description')</th>
                                <th scope="col">@lang('messages.study_type')</th>
                                <th scope="col">@lang('messages.student')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataTasks as $task)
                            @if($task->added_by==Auth::user()->name)
                            <tr>
                                <td scope="row">{{ $task->name }}</td>
                                <td scope="row">{{ $task->name_en }}</td>
                                <td scope="row">{{ $task->assignment }}</td>
                                <td scope="row">{{ $task->study_type }}</td>
                                <td scope="row">
                                    @if($task->accepted_student == null)
                                    <form method="get" action="accept">
                                        <input type="hidden" name="task_id" value="{{ $task->id }}">
                                        <button type="submit"
                                            class="btn btn-info">@lang('messages.chooseStudent')</button>
                                    </form>
                                    @else
                                    <label>Odabrani student:</label>
                                    <p>{{$task->accepted_student}}</p>
                                    @endif
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="panel-heading">
                    <p>{{ Auth::user()->name }}@lang('messages.stud_message')</p>
                </div>
                <div class="panel-body">
                    <label for="hrvatski" class="col-md-4 control-label">@lang('messages.menu_lang_cro')</label>
                    <form method="post" action="croatian" name="hrvatski">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        <input type="hidden" name="localization" value="hr">
                        <button type="submit" class="btn btn-success">Hr</button>
                    </form>
                    <label for="engleski" class="col-md-4 control-label">@lang('messages.menu_lang_eng')</label>
                    <form method="post" action="english" name="engleski">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        <input type="hidden" name="localization" value="en">
                        <button type="submit" class="btn btn-success">En</button>
                    </form>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">@lang('messages.name')</th>
                                <th scope="col">@lang('messages.name_english')</th>
                                <th scope="col">@lang('messages.description')</th>
                                <th scope="col">@lang('messages.study_type')</th>
                                <th scope="col">@lang('messages.profesor')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataTasks as $task)
                            <tr>
                                <td scope="row">{{ $task->name }}</td>
                                <td scope="row">{{ $task->name_en }}</td>
                                <td scope="row">{{ $task->assignment }}</td>
                                <td scope="row">{{ $task->study_type }}</td>
                                <td scope="row">{{ $task->added_by }}</td>
                                <td scope="row">
                                    <form method="post" action="applyForTask">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="user" value="{{Auth::user()->name}}">
                                        <input type="hidden" name="task_id" value="{{$task->id}}">
                                        <button type="submit" class="btn btn-info">@lang('messages.apply')</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

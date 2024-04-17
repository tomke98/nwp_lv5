<?php

namespace App\Http\Controllers;

use App;
use Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class TaskController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function openMenu() {
        $loggedUser = DB::table('users')->where('email', Auth::user()->email)->first();
        App::setlocale($loggedUser->localization);
        return view('add_task');
    }

    public function addAssignment() {
        $taskName = Request::input('task_name');
        $taskNameEng = Request::input('task_name_eng');
        $taskAssignment = Request::input('task_assignment');
        $studyType = Request::input('study_type');
        $addedBy = Request::input('added_by');
        DB::table('tasks')->insert(
            [
                'name' => $taskName,
                'name_en' => $taskNameEng,
                'assignment' => $taskAssignment,
                'study_type' => $studyType,
                'added_by' => $addedBy
            ]
        );
        return redirect('/home');
    }

    public function acceptStudent(){
        $taskId = Request::input('task_id');
        $tasksData = DB::table('tasks')->get()->where('id', $taskId);
        foreach ($tasksData as $task) {
            $students = array();
            $appliedStudents = array();
            array_push($appliedStudents, $task->applied_students);
            $appliedStudentsParts = explode(',', $appliedStudents[0]);
            foreach($appliedStudentsParts as $part){
                array_push($students, $part);
            }
        }
        return view('task_details', ['tasksData' => $tasksData, 'students' => $students]);
    }
}

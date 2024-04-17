<?php

namespace App\Http\Controllers;

use App;
use Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    //svim akcijama u kontroleru dajemo auth medusloj
    public function __construct() {
        $this->middleware('auth');
    }

    //postavljanje uloge korisnika
    public function setUserRole() {
        //ako je korisnik ulogiran dohvatiti njegov id i unesenu ulogu (role)
        if (Auth::check()) {
            $userId = Auth::user()->id;
            $userRole = Request::input('role');
            DB::table('users')->where('id', $userId)->update(['role' => $userRole]);
            return view('home');
        }
    }

    //promjena uloge korisnika
    public function changeUserRole() {
        $userId = Request::input('user_id');
        $userRole = Request::input('role');
        DB::table('users')->where('id', $userId)->update(['role' => $userRole]);
        return Redirect::to('/home');
    }

    //prijava korisnika s ulogom student za odredeni rad
    public function applyForTask() {
        $user = Request::input('user');
        $taskId = Request::input('task_id');
        $appliedStudents = DB::table('tasks')->get()->where('id', $taskId)->pluck('applied_students');
        //konverzija svih prijavljenih studenata u tip podatka string
        $stringsOfAppliedStudents = (string)$appliedStudents[0];
        //provjera ako je uloga korisnika jednaka student te nalazi li se korisnik u prijavljenim studentima
        if (Auth::user()->role == 'student' && strpos($stringsOfAppliedStudents, $user) !== true) {
            if ($stringsOfAppliedStudents == "") {
                $stringsOfAppliedStudents = $user;
            } else {
                //u slucaju da postoji vise prijavljenih studenata, odvoji ih zarezima
                $stringsOfAppliedStudents = $stringsOfAppliedStudents . ", " . $user;
            }
        }
        DB::table('tasks')->where('id', $taskId)->update(['applied_students' => $stringsOfAppliedStudents]);
        return Redirect::to('/home');
    }

    //potvrdivanje jednog od prijavljenih studenata
    public function confirmStudent() {
        $student = Request::input('student');
        $taskId = Request::input('task_id');
        DB::table('tasks')->where('id', $taskId)->update(['accepted_student' => $student]);
        return Redirect::to('/home');
    }
}

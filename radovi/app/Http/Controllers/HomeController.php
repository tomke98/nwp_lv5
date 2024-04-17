<?php

namespace App\Http\Controllers;

use App;
use Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $user = DB::table('users')->where('email', Auth::user()->email)->first();
        App::setlocale($user->localization);
        $users = DB::table('users')->get();
        $dataUsers = array();
        foreach ($users as $user) {
            array_push($dataUsers, $user);
        }
        $tasks = DB::table('tasks')->get();
        $dataTasks = array();
        foreach ($tasks as $task) {
            array_push($dataTasks, $task);
        }
        return view('home', ['dataUsers' => $dataUsers, 'dataTasks' => $dataTasks]);
    }

    //postavljanje lokalizacije na engleski jezik
    public function setLocalizationToEng() {
        $userId = Request::input('user_id');
        DB::table('users')->where('id', $userId)->update(['localization' => 'en']);
        return Redirect::to('/home');
    }
    //postavljanje lokalizacije na hrvatski jezik
    public function setLocalizationToCro() {
        $userId = Request::input('user_id');
        DB::table('users')->where('id', $userId)->update(['localization' => 'hr']);
        return Redirect::to('/home');
    }
}

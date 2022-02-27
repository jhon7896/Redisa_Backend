<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProfile;
use App\Models\User;
use App\Models\Role;
use DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $usuario = UserProfile::find(auth()->user()->user_id);
        $usuario_count = User::all()->count();
        $latest_members = User::where('created_at','>=',Carbon::now()->subdays(15))->get();
        $count_members = User::where('created_at','>=',Carbon::now()->subdays(15))->count();

        $last_sessions = [];
        foreach($latest_members as $user)
        {
            $fechaActual = Carbon::now();
            $fechaVigencia = Carbon::parse($user->user_lastLogin);
            $last_sessions[] = $fechaVigencia->diff($fechaActual);
        }

        return view('welcome', compact('usuario', 'usuario_count', 'latest_members', 'count_members', 'last_sessions'));
    }
}

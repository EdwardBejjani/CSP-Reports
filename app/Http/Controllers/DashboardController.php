<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function home()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard.index');
        } else {
            return redirect()->route('auth.login');
        }
    }

    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('auth.login');
        } else {
            return view('dashboard.index', compact('user'));
        }
    }

    public function new_users($date = null)
    {
        if ($date == null) {
            $date = Carbon::now()->format('Y-m');
        }
        $user = Auth::user();
        $response = Dashboard::new_users($user->username, $user->password, $date);
        return view('dashboard.new_users');
    }
}

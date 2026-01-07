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

    public function new_users_date()
    {
        return view('dashboard.index');
    }

    public function new_users(Request $request)
    {
        $year = $request->input('year');
        $month = $request->input('month');

        if ($year && $month) {
            $selectedDate = Carbon::create($year, $month, 1);
            if ($selectedDate->isAfter(Carbon::now())) {
                return redirect()->back()->with('error', 'Cannot select a future date.');
            }
            $date = $selectedDate->format('Y-m');
        } else {
            $date = Carbon::now()->format('Y-m');
        }
        $user = Auth::user();
        $response = Dashboard::new_users($user->username, $date);
        return view('dashboard.new_users', compact('response', 'date'));
    }

    public function inactive_users_date()
    {
        return view('dashboard.index');
    }
    public function inactive_users(Request $request)
    {
        $year = $request->input('year');
        $month = $request->input('month');

        if ($year && $month) {
            $selectedDate = Carbon::create($year, $month, 1);
            if ($selectedDate->isAfter(Carbon::now())) {
                return redirect()->back()->with('error', 'Cannot select a future date.');
            }
            $date = $selectedDate->format('Y-m');
        } else {
            $date = Carbon::now()->format('Y-m');
        }
        $user = Auth::user();
        $response = Dashboard::inactive_users($user->username, $date);
        return view('dashboard.inactive_users', compact('response', 'date'));
    }

    public function payments_date()
    {
        $user = Auth::user();

        return view('dashboard.index', compact('user'));
    }
    public function payments(Request $request)
    {
        $year = $request->input('year');
        $month = $request->input('month');
        $collector = $request->input('collector');
        if ($year && $month) {
            $selectedDate = Carbon::create($year, $month, 1);
            if ($selectedDate->isAfter(Carbon::now())) {
                return redirect()->back()->with('error', 'Cannot select a future date.');
            }
            $date = $selectedDate->format('Y-m');
        } else {
            $date = Carbon::now()->format('Y-m');
        }
        $user = Auth::user();
        $response = Dashboard::payments($user->username, $date, $collector);
        return view('dashboard.payments', compact('response', 'date', 'collector'));
    }
}

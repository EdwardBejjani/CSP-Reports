<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Dashboard;
use App\Models\GoogleSheets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $date = Carbon::now()->format('Y-m');
            $new_users = Dashboard::new_users($user->username, $date);
            $inactive_users = Dashboard::inactive_users($user->username, $date);
            $payments = Dashboard::payments_vs_total($user->username, $date);
            $payments_left = $payments['total_users'] - $payments['payments_collected'];
            $payments['payments_left'] = $payments_left;
            return view('dashboard.index', compact('new_users', 'inactive_users', 'payments'));
        } else {
            return redirect()->route('auth.login');
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
        $allPayments = Dashboard::payments($user->username, $date, $collector);

        $perPage = 17;
        $currentPage = request()->input('page', 1);
        $currentPageItems = array_slice($allPayments, ($currentPage - 1) * $perPage, $perPage);
        $payments = new LengthAwarePaginator($currentPageItems, count($allPayments), $perPage, $currentPage, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);

        return view('dashboard.payments', [
            'payments' => $payments,
            'allPayments' => $allPayments,
            'date' => $date,
            'collector' => $collector,
        ]);
    }

    public function support(Request $request)
    {
        $query = DB::table('tickets');

        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('username', 'like', "%{$searchTerm}%")
                    ->orWhere('name', 'like', "%{$searchTerm}%")
                    ->orWhere('problem', 'like', "%{$searchTerm}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $tickets = $query->paginate(10);
        return view('dashboard.support', compact('tickets'));
    }

    public function graphs(Request $request)
    {
        $filters = $this->getGraphFilterOptions();

        $query = DB::table('tickets');

        if ($request->filled('month')) {
            $query->whereMonth('created_at', $request->input('month'));
        }

        if ($request->filled('problem')) {
            $query->where('problem', $request->input('problem'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('support')) {
            $query->where('support', $request->input('support'));
        }

        if ($request->filled('technician')) {
            $query->where('technician', $request->input('technician'));
        }

        $tickets = $query->get();

        return view('dashboard.graphs', array_merge(compact('tickets'), $filters));
    }

    private function getGraphFilterOptions()
    {
        $problems = DB::table('tickets')->distinct()->pluck('problem');
        $statuses = DB::table('tickets')->distinct()->pluck('status');
        $supports = DB::table('tickets')->distinct()->pluck('support');
        $technicians = DB::table('tickets')->distinct()->pluck('technician');

        return compact('problems', 'statuses', 'supports', 'technicians');
    }
}

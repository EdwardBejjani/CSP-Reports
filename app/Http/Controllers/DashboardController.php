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
    public function transactions_form()
    {
        $type = [
            'New' => 0,
            'Renew' => 0,
            'Transfer' => 0,
            'Rent' => 0,
            'Refill' => 0,
            'Comission' => 0,
            'Withdraw' => 0,
            'Reset' => 0,
            'Changeservice' => 0,
            'Refund' => 0,
            'Boost' => 0,
            'Itv' => 0,
            'ResetItv' => 0,
            'Days' => 0,
            'ResetDays' => 0,
            'Addon' => 0,
            'Rename' => 0,
            'paid' => 0,
            'unpaid' => 0,
            'cash' => 0,
            'discount' => 0,
            'wu' => 0,
            'cheque' => 0,
            'maintenance' => 0,
        ];
        $date_from = Carbon::now()->startOfMonth()->format('Y-m-d');
        $date_till = Carbon::now()->format('Y-m-d');
        $paid_from = Carbon::now()->startOfMonth()->format('Y-m-d');
        $paid_till = Carbon::now()->format('Y-m-d');
        $username = '';
        $includereseller = false;
        $resellers = Dashboard::get_resellers();
        return view('dashboard.transactions', compact('resellers', 'date_from', 'date_till', 'paid_from', 'paid_till', 'username', 'includereseller', 'type'));
    }
    public function transactions(Request $request)
    {
        $type = [
            'New' => $request->input('New'),
            'Renew' => $request->input('Renew'),
            'Transfer' => $request->input('Transfer'),
            'Rent' => $request->input('Rent'),
            'Refill' => $request->input('Refill'),
            'Comission' => $request->input('Comission'),
            'Withdraw' => $request->input('Withdraw'),
            'Reset' => $request->input('Reset'),
            'Changeservice' => $request->input('Changeservice'),
            'Refund' => $request->input('Refund'),
            'Boost' => $request->input('Boost'),
            'Itv' => $request->input('Itv'),
            'ResetItv' => $request->input('ResetItv'),
            'Days' => $request->input('Days'),
            'ResetDays' => $request->input('ResetDays'),
            'Addon' => $request->input('Addon'),
            'Rename' => $request->input('Rename'),
            'paid' => $request->input('paid'),
            'unpaid' => $request->input('unpaid'),
            'cash' => $request->input('cash'),
            'discount' => $request->input('discount'),
            'wu' => $request->input('wu'),
            'cheque' => $request->input('cheque'),
            'maintenance' => $request->input('maintenance'),
        ];
        $date_from = $request->input('date_from');
        $date_till = $request->input('date_till');
        $paid_from = $request->input('paid_from');
        $paid_till = $request->input('paid_till');
        $credit = $request->input('credit');
        $debit = $request->input('debit');
        $username = $request->input('username');
        $includereseller = $request->input('includereseller');
        $resellers = Dashboard::get_resellers();
        $allTransactions = Dashboard::get_transactions($date_from, $date_till, $paid_from, $paid_till, $credit, $debit, $username, $includereseller, $type);

        $perPage = 15;
        $currentPage = request()->input('page', 1);
        $currentPageItems = array_slice($allTransactions, ($currentPage - 1) * $perPage, $perPage);
        $transactions = new LengthAwarePaginator($currentPageItems, count($allTransactions), $perPage, $currentPage);

        return view('dashboard.transactions', compact('transactions', 'resellers', 'date_from', 'date_till', 'paid_from', 'paid_till', 'username', 'includereseller', 'type'));

    }
}

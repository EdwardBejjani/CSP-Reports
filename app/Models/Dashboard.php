<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    public static function new_users($user, $date)
    {
        if ($user == 'ramy.b' || $user == 'pascale.b') {
            $radius_user = 'ramy.b';
            $radius_pass = 'CloudSP@2025';
            $prefix = 'my';
        } elseif ($user == 'georges.f') {
            $prefix = 'data';
            $radius_user = 'georges.f';
            $radius_pass = 'CloudSP@2024';
        }
        $search_params = [
            'username' => request()->input('username', ''),
            'shortname' => request()->input('shortname', ''),
            'address' => request()->input('address', ''),
            'phone' => request()->input('phone', ''),
            'resellername' => request()->input('resellername', ''),
            'servicename' => request()->input('servicename', ''),
            'fuplevel' => request()->input('fuplevel', ''),
            'macaddr' => request()->input('macaddr', ''),
            'ip' => request()->input('ip', ''),
            'last_act' => request()->input('last_act', ''),
            'expire_datetime' => request()->input('expire_datetime', ''),
            'created_datetime' => request()->input('created_datetime', $date),
            'price' => request()->input('price', ''),
            'region' => request()->input('region', ''),
            'nationality' => request()->input('nationality', ''),
            'building' => request()->input('building', ''),
            'note' => request()->input('note', ''),
            'pageIndex' => 1,
            'pageSize' => request()->input('pageSize', 500),
            'status' => request()->input('status', 7),
            'usersFilter' => $prefix
        ];
        $url = 'https://10.255.1.10/api/user/list/';
        $response = Http::withBasicAuth($radius_user, $radius_pass)
            ->withoutVerifying()
            ->get($url, $search_params)
            ->json()['data'];
        $table_data = [];
        foreach ($response as $item) {
            $table_data[] = $item;
        }
        return $table_data;

    }
    public static function inactive_users($user, $date)
    {
        if ($user == 'ramy.b' || $user == 'pascale.b') {
            $radius_user = 'ramy.b';
            $radius_pass = 'CloudSP@2025';
            $prefix = 'my';
        } elseif ($user == 'georges.f') {
            $radius_user = 'georges.f';
            $radius_pass = 'CloudSP@2024';
            $prefix = 'data';
        }
        $search_params = [
            'username' => request()->input('username', ''),
            'shortname' => request()->input('shortname', ''),
            'address' => request()->input('address', ''),
            'phone' => request()->input('phone', ''),
            'resellername' => request()->input('resellername', ''),
            'servicename' => request()->input('servicename', ''),
            'fuplevel' => request()->input('fuplevel', ''),
            'macaddr' => request()->input('macaddr', ''),
            'ip' => request()->input('ip', ''),
            'last_act' => request()->input('last_act', $date),
            'expire_datetime' => request()->input('expire_datetime', ''),
            'created_datetime' => request()->input('created_datetime', ''),
            'price' => request()->input('price', ''),
            'region' => request()->input('region', ''),
            'nationality' => request()->input('nationality', ''),
            'building' => request()->input('building', ''),
            'note' => request()->input('note', ''),
            'pageIndex' => 1,
            'pageSize' => request()->input('pageSize', 500),
            'status' => request()->input('status', 4),
            'usersFilter' => $prefix
        ];
        $url = 'https://10.255.1.10/api/user/list/';
        $response = Http::withBasicAuth($radius_user, $radius_pass)
            ->withoutVerifying()
            ->get($url, $search_params)
            ->json()['data'];
        $table_data = [];
        foreach ($response as $item) {
            if (str_starts_with($item['last_act'], $date)) {
                $table_data[] = $item;
            }
        }
        return $table_data;
    }

    public static function payments($user, $date, $collector)
    {
        $date_from = Carbon::createFromFormat('Y-m', $date)->startOfMonth()->format('Y-m-d');
        $date_till = Carbon::createFromFormat('Y-m', $date)->endOfMonth()->format('Y-m-d');
        $url = 'https://10.255.1.10/api/payments/list/';
        if ($user == 'ramy.b' || $user == 'pascale.b') {
            $radius_user = 'ramy.b';
            $radius_pass = 'CloudSP@2025';
        } elseif ($user == 'georges.f') {
            $radius_user = 'georges.f';
            $radius_pass = 'CloudSP@2024';
        }
        $search_params = [
            'username' => request()->input('username', ''),
            'fullname' => request()->input('fullname', ''),
            'date_from' => request()->input('date_from', $date_from),
            'date_till' => request()->input('date_till', $date_till),
            'collected_by' => request()->input('collected_by', $collector),
            'pageIndex' => 1,
            'pageSize' => request()->input('pageSize', 500),
        ];
        $response = Http::withBasicAuth($radius_user, $radius_pass)
            ->withoutVerifying()
            ->get($url, $search_params)
            ->json()['data'];
        foreach ($response as $item) {
            $table_data[] = $item;
        }
        return $table_data;
    }

    public static function payments_vs_total($user, $date)
    {
        $date_from = Carbon::createFromFormat('Y-m', $date)->startOfMonth()->format('Y-m-d');
        $date_till = Carbon::createFromFormat('Y-m', $date)->endOfMonth()->format('Y-m-d');
        $due_from = Carbon::createFromFormat('Y-m', $date)->startOfMonth()->format('Y-m-d');
        $due_till = Carbon::now()->format('Y-m-d');
        $url = 'https://10.255.1.10/api/invoices/list/';
        if ($user == 'ramy.b' || $user == 'pascale.b') {
            $radius_user = 'ramy.b';
            $radius_pass = 'CloudSP@2025';
            $prefix = 'my';
        } elseif ($user == 'georges.f') {
            $radius_user = 'georges.f';
            $radius_pass = 'CloudSP@2024';
            $prefix = 'data';
        }
        $search_params = [
            'id' => request()->input('id', ''),
            'username' => request()->input('username', $prefix),
            'fullname' => request()->input('fullname', ''),
            'collector' => request()->input('collector', ''),
            'item' => request()->input('item', ''),
            'type' => request()->input('type', ''),
            'paid_from' => request()->input('paid_from', $due_from),
            'paid_till' => request()->input('paid_till', $due_till),
            'date_from' => request()->input('date_from', $date_from),
            'date_till' => request()->input('date_till', $date_till),
            'pageIndex' => 1,
            'pageSize' => request()->input('pageSize', 1000),
        ];
        $response = Http::withBasicAuth($radius_user, $radius_pass)
            ->withoutVerifying()
            ->get($url, $search_params)
            ->json()['data'];
        $payments_collected = 0;
        $amount_collected = 0;
        foreach ($response as $item) {
            if ($item['remaining'] == '0.00')
                $payments_collected += 1;
        }
        $search_params_users = [
            'username' => request()->input('username', ''),
            'shortname' => request()->input('shortname', ''),
            'address' => request()->input('address', ''),
            'phone' => request()->input('phone', ''),
            'resellername' => request()->input('resellername', ''),
            'servicename' => request()->input('servicename', ''),
            'fuplevel' => request()->input('fuplevel', ''),
            'macaddr' => request()->input('macaddr', ''),
            'ip' => request()->input('ip', ''),
            'last_act' => request()->input('last_act', ''),
            'expire_datetime' => request()->input('expire_datetime', ''),
            'created_datetime' => request()->input('created_datetime', ''),
            'price' => request()->input('price', ''),
            'region' => request()->input('region', ''),
            'nationality' => request()->input('nationality', ''),
            'building' => request()->input('building', ''),
            'note' => request()->input('note', ''),
            'pageIndex' => 1,
            'pageSize' => request()->input('pageSize', 999999),
            'status' => request()->input('status', 3),
            'usersFilter' => $prefix
        ];
        $total_users_response = Http::withBasicAuth($radius_user, $radius_pass)
            ->withoutVerifying()
            ->get('https://10.255.1.10/api/user/list/', $search_params_users)
            ->json()['data'];
        $total_users = count($total_users_response);
        $final_data = [
            'payments_collected' => $payments_collected,
            'amount_collected' => $amount_collected,
            'total_users' => $total_users
        ];
        return $final_data;
    }

    public static function get_resellers($resellers = [])
    {
        $username = 'admin';
        $password = 'CloudSP_@2025';
        $url = 'https://10.255.1.10/reseller/resellerlist/?Reseller=&pageIndex=1&pageSize=1000';
        $response = Http::withBasicAuth($username, $password)
            ->withoutVerifying()
            ->get($url)
            ->json()['data'];
        foreach ($response as $item) {
            $resellers[] = $item;
        }
        return $resellers;
    }

    public static function get_transactions($date_from, $date_till, $includereseller, $paid_from = '', $paid_till = '', $credit = '', $debit = '', $username = '', $type = [])
    {
        if ($includereseller == 1) {
            $includereseller = true;
        } else {
            $includereseller = false;
        }
        $username = 'admin';
        $password = 'CloudSP_@2025';
        $url = 'https://10.255.1.10/api/transactions/list/';
        $search_params = [
            'New' => request()->input('New', $type['New']),
            'Renew' => request()->input('Renew', $type['Renew']),
            'Transfer' => request()->input('Transfer', $type['Transfer']),
            'Rent' => request()->input('Rent', $type['Rent']),
            'Refill' => request()->input('Refill', $type['Refill']),
            'Comission' => request()->input('Comission', $type['Comission']),
            'Withdraw' => request()->input('Withdraw', $type['Withdraw']),
            'Reset' => request()->input('Reset', $type['Reset']),
            'Changeservice' => request()->input('Changeservice', $type['Changeservice']),
            'Refund' => request()->input('Refund', $type['Refund']),
            'Boost' => request()->input('Boost', $type['Boost']),
            'Itv' => request()->input('Itv', $type['Itv']),
            'ResetItv' => request()->input('ResetItv', $type['ResetItv']),
            'Days' => request()->input('Days', $type['Days']),
            'Addon' => request()->input('Addon', $type['Addon']),
            'Rename' => request()->input('Rename', $type['Rename']),
            'paid' => request()->input('paid', $type['paid']),
            'unpaid' => request()->input('unpaid', $type['unpaid']),
            'cash' => request()->input('cash', $type['cash']),
            'discount' => request()->input('discount', $type['discount']),
            'wu' => request()->input('wu', $type['wu']),
            'cheque' => request()->input('cheque', $type['cheque']),
            'maintenance' => request()->input('maintenance', $type['maintenance']),
            'date_from' => request()->input('date_from', $date_from),
            'date_till' => request()->input('date_till', $date_till),
            'paid_from' => request()->input('paid_from', $paid_from),
            'paid_till' => request()->input('paid_till', $paid_till),
            'credit' => request()->input('credit', $credit),
            'debit' => request()->input('debit', $debit),
            'username' => request()->input('username', $username),
            'includereseller' => request()->input('includereseller', $includereseller),
            'pageIndex' => 1,
            'pageSize' => request()->input('pageSize', 500),
        ];
        $response = Http::withBasicAuth($username, $password)
            ->withoutVerifying()
            ->get($url, $search_params)
            ->json()['data'];
        return $response;
    }
}

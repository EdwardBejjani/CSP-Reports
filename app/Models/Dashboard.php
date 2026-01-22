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
        Log::info($table_data);
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
        Log::info($table_data);
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
        Log::info($table_data);
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
}

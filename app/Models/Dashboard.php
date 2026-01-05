<?php

namespace App\Models;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    public static function new_users($user, $pass, $date)
    {
        $url = config('env.base_url') . '/api/user/list/?username=&shortname=&address=&phone=&resellername=&servicename=&fuplevel=&macaddr=&ip=&last_act=&expire_datetime=&created_datetime=' . $date . '&price=&balance=&region=&nationality=&note=&pageIndex=1&pageSize=50&status=0&usersFilter=my';
        $decrypt_pass = decrypt($pass);
        $response = Http::withBasicAuth($user, $pass)
            ->withoutVerifying()
            ->get($url)->json()['data'];
        $table_data = [];
        foreach ($response as $item) {
            $table_data[] = $item;
        }
        return $table_data;

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class Notify extends Controller
{
    public function get () {
        set_time_limit(0);
        if (!isset($_SERVER['HTTP_X_TOKEN']) || $_SERVER['HTTP_X_TOKEN'] == null) {
            die(json_encode(['error' => 'Token error!']));
        }
        $token = $_SERVER['HTTP_X_TOKEN'];
            $user = DB::table('users')->where('token', $token)->first();
            $data = DB::table('notifications')->where(['uid' => $user->id])->limit(2)->get();
            if (isset($data[0])) {
                $result = array(
                    'data' => $data
                );
                // encode to JSON, render the result (for AJAX)
                $json = json_encode($result);
                foreach ($data as $index => $value) {
                    $query = DB::delete('delete from notifications where id = ?', [$value->id]);
                }
                echo $json;
            }
            DB::disconnect();
    }
}

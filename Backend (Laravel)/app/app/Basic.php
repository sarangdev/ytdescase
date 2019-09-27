<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Basic extends Model
{
    public function getIP()
    {
        if ($_SERVER['REMOTE_ADDR']) {
            return $_SERVER['REMOTE_ADDR'];
        } else if ($_SERVER['HTTP_X_FORWARDED_FOR']) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else if ($_SERVER['HTTP_X_REAL_IP']) {
            return $_SERVER['HTTP_X_REAL_IP'];
        }
    }
}

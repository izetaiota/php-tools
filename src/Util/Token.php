<?php



namespace src\Util;

class Token
{
    public static function token($length = 20)
    {
        $token = bin2hex(random_bytes($length));

        return $token;
    }



}
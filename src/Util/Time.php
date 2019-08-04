<?php

namespace src\Util;


class Time
{
    /**
     * 获取十三位的时间戳
     * @modify
     */
    public static function get13TimeStamp()
    {
        list($t1, $t2) = explode(' ', microtime());

        return $t2 . ceil($t1 * 1000);

    }

}
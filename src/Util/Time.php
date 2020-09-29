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


    /**
     * @Desc 创建年月日时间区间范围
     * @param $ymdStart
     * @param bool $ymdEnd
     * @param int $range
     * @return array|false[]|string[]
     */
    public static function createYmdRange($ymdStart, $ymdEnd = true, $range = 86400)
    {
        if ($ymdEnd === true) $ymdEnd = date('Y-m-d');
        return array_map(function ($time) {
            return date('Y-m-d', $time);
        }, range(strtotime($ymdStart), strtotime($ymdEnd), $range));
    }


    /**
     * @Desc 获取年月到当今前一个月的区间
     * @param $startMon 2019-09
     * @return array
     */
    public static function createYmInterval($startMon)
    {
        $startTime = strtotime($startMon); // 开始时间
        $endTime = strtotime(date("Y-m", strtotime("-1 month"))); //结束时间

        $monArr = array();
        $monArr[] = $startMon; // 默认将开始时间添加进去，有需要的情况下自己更改;
        while (($startTime = strtotime('+1 month', $startTime)) <= $endTime) {
            $monArr[] = date('Y-m', $startTime); // 取得递增月;
        }

        return $monArr;
    }

}
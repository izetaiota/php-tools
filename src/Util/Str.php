<?php
/**
 * 字符串处理类
 */

namespace src\Util;

class Str
{
    /**
     * 截取字符串并添加省略符
     *
     * @param        $str
     * @param int    $len
     * @param string $strFix
     *
     * @return string
     */
    public static function cutStr($str, $len = 5, $strFix = '...')
    {
        return mb_substr($str, 0, $len) . (mb_strlen($str) > $len ? $strFix : '');
    }
}
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

    /**
     * @description 十进制转三十六
     *
     * @param $ten
     *
     * @return string
     */
    public static function tenTo36($ten)
    {
        return strtoupper(base_convert($ten, 10, 36));
    }


    /**
     * @description 三十六进制转十进制
     *
     * @param $ts
     *
     * @return string
     */
    public static function threeSixTo10($ts)
    {
        return base_convert($ts, 36, 10);
    }


    /**
     * @description ASCII 字符串转utf-8字符串【参考资料：https://blog.csdn.net/TottyAndBaty/article/details/83829163】
     * @modify
     *
     * @param string $hex_data 转码字符串
     *
     * @return string
     */
    public static function hex2bin($hex_data)
    {
        $bin_data = '';
        for ($i = 0; $i < strlen($hex_data); $i += 2) {

            $bin_data .= chr(hexdec(substr($hex_data, $i, 2)));
        }

        return $bin_data;
    }
}
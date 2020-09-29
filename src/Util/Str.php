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
     * @param         $str
     * @param int $len
     * @param Str $strFix
     *
     * @return Str
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
     * @return Str
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
     * @return Str
     */
    public static function threeSixTo10($ts)
    {
        return base_convert($ts, 36, 10);
    }


    /**
     * @description ASCII 字符串转utf-8字符串【参考资料：https://blog.csdn.net/TottyAndBaty/article/details/83829163】
     * @modify
     *
     * @param Str $hex_data 转码字符串
     *
     * @return Str
     */
    public static function hex2bin($hex_data)
    {
        $bin_data = '';
        for ($i = 0; $i < strlen($hex_data); $i += 2) {

            $bin_data .= chr(hexdec(substr($hex_data, $i, 2)));
        }

        return $bin_data;
    }


    /** php字符串处理之全角半角转换 start *************************************************************************/

    /**
     * 将unicode转换成字符 [参考资料：https://www.cnblogs.com/365star/p/5213963.html]
     *
     * @param int $unicode
     *
     * @return string UTF-8字符
     **/
    public static function unicode2Char($unicode)
    {
        if ($unicode < 128) {
            return chr($unicode);
        }
        if ($unicode < 2048) {
            return chr(($unicode >> 6) + 192) .
                chr(($unicode & 63) + 128);
        }
        if ($unicode < 65536) {
            return chr(($unicode >> 12) + 224) .
                chr((($unicode >> 6) & 63) + 128) .
                chr(($unicode & 63) + 128);
        }
        if ($unicode < 2097152) {
            return chr(($unicode >> 18) + 240) .
                chr((($unicode >> 12) & 63) + 128) .
                chr((($unicode >> 6) & 63) + 128) .
                chr(($unicode & 63) + 128);
        }

        return false;
    }

    /**
     * 将字符转换成unicode
     *
     * @param string $char 必须是UTF-8字符
     *
     * @return int
     **/
    public static function char2Unicode($char)
    {
        switch (strlen($char)) {
            case 1 :
                return ord($char);
            case 2 :
                return (ord($char{1}) & 63) |
                    ((ord($char{0}) & 31) << 6);
            case 3 :
                return (ord($char{2}) & 63) |
                    ((ord($char{1}) & 63) << 6) |
                    ((ord($char{0}) & 15) << 12);
            case 4 :
                return (ord($char{3}) & 63) |
                    ((ord($char{2}) & 63) << 6) |
                    ((ord($char{1}) & 63) << 12) |
                    ((ord($char{0}) & 7) << 18);
            default :
                trigger_error('Character is not UTF-8!', E_USER_WARNING);

                return false;
        }
    }

    /**
     * 全角转半角
     *
     * @param string $str
     *
     * @return string
     **/
    public static function sbc2Dbc($str)
    {
        return preg_replace(
        // 全角字符
            '/[\x{3000}\x{ff01}-\x{ff5f}]/ue',
            // 编码转换
            // 0x3000是空格，特殊处理，其他全角字符编码-0xfee0即可以转为半角
            '($unicode=char2Unicode(\'\0\')) == 0x3000 ? " " : (($code=$unicode-0xfee0) > 256 ? unicode2Char($code) : chr($code))',
            $str
        );
    }

    /**
     * 半角转全角
     *
     * @param string $str
     *
     * @return string
     **/
    public static function dbc2Sbc($str)
    {
        return preg_replace(
        // 半角字符
            '/[\x{0020}\x{0020}-\x{7e}]/ue',
            // 编码转换
            // 0x0020是空格，特殊处理，其他半角字符编码+0xfee0即可以转为全角
            '($unicode=char2Unicode(\'\0\')) == 0x0020 ? unicode2Char（0x3000） : (($code=$unicode+0xfee0) > 256 ? unicode2Char($code) : chr($code))',
            $str
        );
    }

    /** php字符串处理之全角半角转换 end *************************************************************************/


    /**
     * @Desc  判断是否是json字符串
     * @param $string
     * @return bool
     */
    public static function is_json($string)
    {
        if (is_string($string)) {
            @json_decode($string);
            return (json_last_error() == JSON_ERROR_NONE);
        } else {
            return false;
        }
    }
}
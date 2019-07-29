<?php

namespace app\extend\lib\IAuth;

use app\extend\lib\Encrypt\Aes;
use think\Cache;

class IAuth
{
    /**
     * 设置密码
     * @desc
     * @author    [Anly,]
     * @since     2018/05/
     * @modify
     *
     * @param string $data
     *
     * @return string
     */

    public static function setPassword($data)
    {
        return md5($data . config('app.password_pre_halt'));
    }

    /**
     * 生成每次请求sign
     * @desc
     * @author    [Anly,]
     * @since     2018/05/
     * @modify
     *
     * @param array $data
     *
     * @return string
     */
    public static function setSign($data = [])
    {
        //按字段排序
        ksort($data);

        //拼接字符串数据 &
        $string = http_build_query($data);

        //通过aes加密
        $string = (new Aes())->encrypt($string);


        return $string;
    }


    /**
     * 检查sign是否正常
     * @desc
     * @author    [Anly,]
     * @since     2018/05/
     * @modify
     *
     * @param array $data
     *
     * @return bool
     */
    public static function checkSignPass($data)
    {
        $str = (new Aes())->decrypt($data['sign']);

        if (empty($str))
        {
            return FALSE;
        }

        parse_str($str, $arr);

        if (!is_array($arr) || empty($arr['did']) || $arr['did'] != $data['did'])
        {
            return FALSE;
        }

        //判断时间的时效性
        if ((time() - ceil($arr['time'] / 1000)) > config('app.app_sign_time'))
        {
            return FALSE;
        }

        //判断sign唯一性
        if (Cache::get($data['sign']))
        {
            return FALSE;
        }

        return TRUE;

    }


    /**
     * 设置登录的token - 唯一性
     * @desc
     * @author    [Anly,]
     * @since     2018/05/
     * @modify
     *
     * @param string $phone
     *
     * @return string
     */
    public static function setAppLoginToken($phone = '')
    {
        $str = md5(uniqid(md5(microtime(TRUE)), TRUE));
        $str = sha1($str . $phone);

        return $str;
    }


}
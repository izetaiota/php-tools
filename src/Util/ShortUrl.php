<?php
/**
 * 短连接生成类
 */

namespace tools;


class ShortUrl
{
    /**
     * @description 创建百度短连接 注意：可以生成短网址条件：1.一级域名；2.网址可以访问。
     * @author      [zetaiota]
     * @since       2018/11/13
     * @modify
     *
     * @param $param
     *
     * @return string
     */
    public static function createDuUrl($param)
    {
        //短网址生成接口地址&传递的参数
        $url   = "http://dwz.cn/admin/create";
        $param = [
            "url" => $param,
        ];

        //curl初始化&curl配置
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($param));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        //执行cURL会话
        $ret = curl_exec($ch);
        //获取cURL连接资源句柄的信息
        $retInfo = curl_getinfo($ch);

        if ($retInfo['http_code'] == 200)
        {
            $data = json_decode($ret, TRUE);
            /**
             * Code:0：正常返回短网址,-1：短网址生成失败,-2：长网址不合法,-3：长网址存在安全隐患,-4：长网址插入数据库失败,-5：长网址在黑名单中，不允许注册;
             * ShortUrl:短网址
             * LongUrl:长网址（原网址）
             * ErrMsg:错误信息
             */
            if ($data['Code'] != 0)
            {
                return '短网址生成失败，错误原因为：' . $data['ErrMsg'];
            }
            else return $data['ShortUrl'];
        }
        else return 'make short url failed';
    }


    /**
     * @description 百度短网址还原长网址
     * @author      [zetaiota]
     * @since       2018/11/13
     * @modify
     *
     * @param $param
     *
     * @return string
     */
    public static function restoreDuUrl($param)
    {
        //短网址还原接口地址&传递的参数
        $url   = "http://dwz.cn/admin/query";
        $param = [
            "shortUrl" => $param,
        ];

        //curl初始化&curl配置
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($param));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        //执行cURL会话
        $ret = curl_exec($ch);
        //获取cURL连接资源句柄的信息
        $retInfo = curl_getinfo($ch);

        if ($retInfo['http_code'] == 200)
        {
            $data = json_decode($ret, TRUE);
            /**
             * Code:0：正常返回短网址,-1：短网址对应的长网址不合法,-2：短网址不存在,-3：查询的短网址不合法;
             * ShortUrl:短网址
             * LongUrl:长网址（原网址）
             * ErrMsg:错误信息
             */
            if ($data['Code'] != 0)
            {
                return '短网址恢复失败，错误原因为：' . $data['ErrMsg'];
            }
            else return $data['LongUrl'];
            //else return '短网址恢复成功!由[' . $data['ShortUrl'] . ']恢复的短网址为：[' . $data['LongUrl'] . ']';
        }
        else return 'make short url failed';
    }

}
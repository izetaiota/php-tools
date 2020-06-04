<?php
/**
 * 获取客户端ip地址
 */

namespace src\Util;


class IP
{
    /**
     * @description 获取客户端ip地址
     * @return mixed
     */
    public static function address()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
        {
            $ip_address = $_SERVER['HTTP_CLIENT_IP'];
        }

        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
            $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }

        else
        {
            $ip_address = $_SERVER['REMOTE_ADDR'];
        }

        return $ip_address;
    }

    /**
     * @description IP地址详情查询[淘宝ip库，ipip库]
     *
     * @param Str $ip IP地址
     *
     * @return array
     */
    public static function details($ip)
    {
        //淘宝ip库
        $tb = 'http://ip.taobao.com/service/getIpInfo.php?ip=' . $ip;
        //ipip Ip库
        $ipip = 'http://freeapi.ipip.net/' . $ip;

        //数据源
        $sourceDataTb = file_get_contents($tb);
        $sourceDataIp = file_get_contents($ipip);
        if ($sourceDataTb)
        {
            $dataTb  = json_decode($sourceDataTb)->data;
            $country = $dataTb->country;    //国家
            $region  = $dataTb->region;    //省份
            $city    = $dataTb->city;    //地区
            $isp     = $dataTb->isp;    //服务商

            $data = self::data($country, $region, $city, $isp);
        }
        elseif ($sourceDataIp)
        {
            $dataIp  = json_decode($sourceDataIp);
            $country = $dataIp[0];    //国家
            $region  = $dataIp[1];    //省份
            $city    = $dataIp[2];    //地区
            $isp     = $dataIp[4];    //服务商
            $data    = self::data($country, $region, $city, $isp);
        }
        else
        {
            $data = [];
        }

        return $data;
    }

    /**
     * @description 返回的ip数据
     *
     * @param Str $country 国家
     * @param Str $region  省份
     * @param Str $city    地区
     * @param Str $isp     服务商
     *
     * @return array
     */
    private static function data($country, $region, $city, $isp)
    {
        return $data = [
            'country' => $country,
            'region'  => $region,
            'city'    => $city,
            'isp'     => $isp,
        ];
    }

}
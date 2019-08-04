<?php

/**
 * 订单号生成类
 */

namespace tools;


class OrderSn
{
    /**
     * @description
     * 生成支付单编号(两位随机 + 从2000-01-01 00:00:00 到现在的秒数+微秒+会员ID%1000)，该值会传给第三方支付接口
     * 长度 =2位 + 10位 + 3位 + 3位  = 18位
     * 1000个会员同一微秒提订单，重复机率为1/100
     * @author    [zetaiota]
     * @since     2018/11/12
     * @modify
     *
     * @param int $uid 用户uid
     *
     * @return string
     */
    public static function makePaySn($uid)
    {
        return mt_rand(10, 99)
            . sprintf('%010d', time() - 946656000)
            . sprintf('%03d', (float)microtime() * 1000)
            . sprintf('%03d', (int)$uid % 1000);
    }


    /**
     * @description
     * 订单编号生成规则，n(n>=1)个订单表对应一个支付表，
     * 生成订单编号(年取1位 + $pay_id取13位 + 第N个子订单取2位)
     * 1000个会员同一微秒提订单，重复机率为1/100
     * @author    [zetaiota]
     * @since     2018/11/12
     * @modify
     *
     * @param int $pid 支付表自增ID
     *
     * @return string
     */
    public static function makeOrderSn($pid)
    {
        //记录生成子订单的个数，如果生成多个子订单，该值会累加
        static $num;
        if (empty($num))
        {
            $num = 1;
        }
        else
        {
            $num++;
        }

        return (date('y', time()) % 9 + 1) . sprintf('%013d', $pid) . sprintf('%02d', $num);
    }

    /**
     * @description 生成订单号 16位
     * @author      [zetaiota]
     * @since       2018/11/12
     * @modify
     * @return string
     */
    public static function orderSn()
    {
        $yCode   = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J'];
        $orderSn = $yCode[ intval(date('Y')) - 2011 ]
            . strtoupper(dechex(date('m')))
            . date('d')
            . substr(time(), -5)
            . substr(microtime(), 2, 5)
            . sprintf('%02d', rand(0, 99));

        return $orderSn;
    }

}
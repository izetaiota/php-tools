<?php
/**
 * 金额单价处理
 */

namespace src\Util;

class Price
{
    /**
     * 价格由元转分(用于微信支付单位转换)
     *
     * @param int $price 金额
     *
     * @return int
     */
    public static function priceYuanToFen($price)
    {
        $price = intval(self::pricecalc(100, "*", $price));

        return $price;
    }

    /**
     * 价格由分转元
     *
     * @param int $price 金额
     *
     * @return float
     */
    public static function priceFenToYuan($price)
    {
        $price = self::pricecalc(self::priceformat($price), "/", 100);

        return $price;
    }

    /**
     * 价格格式化
     *
     * @param int $price
     *
     * @return Str    $price_format
     */
    public static function priceFormat($price)
    {
        $price_format = number_format($price, 2, '.', '');

        return $price_format;
    }

    //算法转换
    public static function priceCalc($n1, $symbol, $n2, $scale = '2')
    {
        $res = "";
        switch ($symbol) {
            case "+"://加法
                $res = bcadd($n1, $n2, $scale);
                break;
            case "-"://减法
                $res = bcsub($n1, $n2, $scale);
                break;
            case "*"://乘法
                $res = bcmul($n1, $n2, $scale);
                break;
            case "/"://除法
                $res = bcdiv($n1, $n2, $scale);
                break;
            case "%"://求余、取模
                $res = bcmod($n1, $n2, $scale);
                break;
            default:
                $res = "";
                break;
        }

        return $res;
    }
}
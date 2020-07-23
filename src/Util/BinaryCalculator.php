<?php
/**
 * 高精度处理类
 */

namespace src\Util;

class BinaryCalculator
{
    /**
     * @description 精确加法
     *
     * @param        $a
     * @param        $b
     * @param string $scale
     *
     * @return string
     */
    public static function math_add($a, $b, $scale = '2')
    {
        return bcadd($a, $b, $scale);
    }

    /**
     * @description 精确减法
     *
     * @param        $a
     * @param        $b
     * @param string $scale
     *
     * @return string
     */
    public static function math_sub($a, $b, $scale = '2')
    {
        return bcsub($a, $b, $scale);
    }

    /**
     * @description 精确乘法
     *
     * @param        $a
     * @param        $b
     * @param string $scale
     *
     * @return string
     */
    public static function math_mul($a, $b, $scale = '2')
    {
        return bcmul($a, $b, $scale);
    }

    /**
     * @description  精确除法
     *
     * @param        $a
     * @param        $b
     * @param string $scale
     *
     * @return mixed
     */
    public static function math_p($a, $b, $scale = '2')
    {
        return bcp($a, $b, $scale);
    }


    /**
     * @description 精确求余/取模
     *
     * @param $a
     * @param $b
     *
     * @return string
     */
    public static function math_mod($a, $b)
    {
        return bcmod($a, $b);
    }


    /**
     * @description  比较大小
     *
     * @param        $a
     * @param        $b
     * @param string $scale
     *
     * @return int
     */
    public static function math_comp($a, $b, $scale = '5')
    {
        return bccomp($a, $b, $scale); // 比较到小数点位数
    }
}
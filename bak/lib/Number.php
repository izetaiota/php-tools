<?php

namespace lib;

/**
 * @description 数组处理类
 * @author      [zetaiota]
 * @since       2019/3/19
 * @copyright
 */
class Number
{
    /**
     * @description 二维数组分组
     * @author      [zetaiota]
     * @since       2019/3/19
     * @modify
     *
     * @param array  $arr 二维数组
     * @param string $key 要分组的key
     *
     * @return array
     */
    public static function array_group_by($arr, $key)
    {
        $grouped = [];
        foreach ($arr as $value)
        {
            $grouped[ $value[ $key ] ][] = $value;
        }
        // Recursively build a nested grouping if more parameters are supplied
        // Each grouped array value is grouped according to the next sequential key
        if (func_num_args() > 2)
        {
            $args = func_get_args();
            foreach ($grouped as $key => $value)
            {
                $parms           = array_merge([$value], array_slice($args, 2, func_num_args()));
                $grouped[ $key ] = call_user_func_array('array_group_by', $parms);
            }
        }

        return $grouped;
    }

}
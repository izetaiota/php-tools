<?php
/**
 * @description
 * @author    [zetaiota]
 * @since     2018/7/23
 * @copyright
 */

namespace expand;


class Func
{
    public static function tenTo36($ten) { return strtoupper(base_convert($ten, 10, 36)); }

    public static function threeSixTo10($ts) { return base_convert($ts, 36, 10); }

}
<?php

namespace lib;

/**
 * @description 雪花算法（参考资料：https://github.com/zh-ang/php-snowflake）
 * @author      [zetaiota]
 * @since       2019/3/7
 * @copyright
 */
class Snowflake
{
    public static function snowflakeNextId()
    {
        return snowflake_next_id();
    }

    public static function snowflakeExplain($data)
    {
        return snowflake_explain($data);
    }


}
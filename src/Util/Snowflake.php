<?php

namespace src\Util;

/**
 * @description 雪花算法（参考资料：https://github.com/zh-ang/php-snowflake）
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
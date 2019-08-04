<?php
/**
 * @description
 * @author    [Anly]
 * @since     2018/7/19
 * @copyright
 */

namespace expand;


class Redis
{
    private static $redis;

    /**
     * @description      连接redis数据库
     * @author           [zetaiota]
     * @since            2018/7/19
     * @modify
     * @return \Redis
     */
    private static function connect()
    {
        if (!self::$redis)
        {
            self::$redis = new \Redis();
            self::$redis->connect('127.0.0.1', 6379);
        }

        return self::$redis;
    }


    // +----------------------------------------------------------------------
    // | String操作
    // +----------------------------------------------------------------------
    /**
     * @description      设置key和value的值
     * @author           [zetaiota]
     * @since            2018/7/19
     * @modify
     *
     * @param string $key   key值
     * @param string $value value值
     *
     * @return bool
     */
    public static function set($key, $value)
    {
        return self::connect()->set($key, $value);
    }

    /**
     * @description 获取有关指定键的值
     * @author      [zetaiota]
     * @since       2018/7/19
     * @modify
     *
     * @param $key
     *
     * @return bool|string
     */
    public static function get($key)
    {
        return self::connect()->get($key);
    }

    /**
     * @description 从某个key所存储的字符串的指定偏移量开始，替换为另一指定字符串，成功返回替换后新字符串的长度。
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param $key
     * @param $offset
     * @param $value
     *
     * @return string
     */
    public static function setRange($key, $offset, $value)
    {
        return self::connect()->setRange($key, $offset, $value);
    }

    /**
     * @description 获取存储在指定key中字符串的子字符串
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param $key
     * @param $start
     * @param $end
     *
     * @return string
     */
    public static function getRange($key, $start, $end)
    {
        return self::connect()->getRange($key, $start, $end);
    }

    /**
     * @description 设置新值，返回旧值：若key不存在则设置值，返回false
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param $key
     * @param $newValue
     *
     * @return string
     */
    public static function getSet($key, $newValue)
    {
        return self::connect()->getSet($key, $newValue);
    }

    /**
     * @description 删除指定的键
     * @author      [zetaiota]
     * @since       2018/7/19
     * @modify
     *
     * @param $key
     *
     * @return int
     */
    public static function delete($key)
    {
        return self::connect()->delete($key);
    }

    /**
     * @description 不存在该键，设置关键值参数
     * @author      [zetaiota]
     * @since       2018/7/19
     * @modify
     *
     * @param $key
     * @param $value
     *
     * @return bool
     */
    public static function setnx($key, $value)
    {
        return self::connect()->setnx($key, $value);
    }

    /**
     * @description 验证指定的键是否存在
     * @author      [zetaiota]
     * @since       2018/7/19
     * @modify
     *
     * @param $key
     *
     * @return bool
     */
    public static function exists($key)
    {
        return self::connect()->exists($key);
    }

    /**
     * @description 数字递增存储键值键 +1
     * @author      [zetaiota]
     * @since       2018/7/19
     * @modify
     *
     * @param $key
     *
     * @return int
     */
    public static function incr($key)
    {
        return self::connect()->incr($key);
    }

    /**
     * @description 数字递减存储键值 -1
     * @author      [zetaiota]
     * @since       2018/7/19
     * @modify
     *
     * @param $key
     *
     * @return int
     */
    public static function decr($key)
    {
        return self::connect()->decr($key);
    }

    /**
     * @description 一次设置多个键值对：成功返回true
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param array $keyValue
     *
     * @return bool
     */
    public static function mset(array $keyValue)
    {
        return self::connect()->mset($keyValue);
    }

    /**
     * @description 一次设置多个键值对：成功返回true
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param array $key
     *
     * @return array
     */
    public static function mget(array $key)
    {
        return self::connect()->mget($key);
    }

    /**
     * @description 设置指定key的值及其过期时间，单位：秒
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param string $key
     * @param int    $time 过期时间
     * @param string $value
     *
     * @return bool
     */
    public static function setex($key, $time, $value)
    {
        return self::connect()->setex($key, $time, $value);
    }

    /**
     * @description 以毫秒为单位设置指定key的值和过期时间。成功返回true
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param $key
     * @param $time
     * @param $value
     *
     * @return bool
     */
    public static function psetex($key, $time, $value)
    {
        return self::connect()->psetex($key, $time, $value);
    }

    /**
     * @description setnx命令的批量操作。只有在给定所有key都不存在的时候才能设置成功，只要其中一个key存在，所有key都无法设置成功
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param array $keyValue
     *
     * @return int
     */
    public static function msetnx(array $keyValue)
    {
        return self::connect()->msetnx($keyValue);
    }

    /**
     * @description 获取指定key存储的字符串的长度，key不存在返回0，不为字符串返回false
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param $key
     *
     * @return int
     */
    public static function strlen($key)
    {
        return self::connect()->strlen($key);
    }

    /**
     * @description 给指定key存储的数字值增加指定增量值
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param $key
     * @param $num
     *
     * @return int
     */
    public static function incrBy($key, $num)
    {
        return self::connect()->incrBy($key, $num);
    }

    /**
     * @description 给指定key存储的数字值增加指定浮点数增量
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param $key
     * @param $num
     *
     * @return float
     */
    public static function incrByFloat($key, $num)
    {
        return self::connect()->incrByFloat($key, $num);
    }

    /**
     * @description 将指定key存储的数字值减去指定减量值
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param $key
     * @param $num
     *
     * @return int
     */
    public static function decrBy($key, $num)
    {
        return self::connect()->decrBy($key, $num);
    }

    /**
     * @description 为指定key追加值到原值末尾，若key不存在则相对于set()函数
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param $key
     * @param $value
     *
     * @return int
     */
    public static function append($key, $value)
    {
        return self::connect()->append($key, $value);
    }


    // +----------------------------------------------------------------------
    // | Hash操作
    // +----------------------------------------------------------------------
    /**
     * @description 为hash表中的字段赋值。成功返回1，失败返回0。若hash表不存在会先创建表再赋值，若字段已存在会覆盖旧值。
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param $key
     * @param $field
     * @param $value
     *
     * @return bool|int
     */
    public static function hSet($key, $field, $value)
    {
        return self::connect()->hSet($key, $field, $value);
    }

    /**
     * @description 获取hash表中指定字段的值。若hash表不存在则返回false
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param $key
     * @param $field
     *
     * @return string
     */
    public static function hGet($key, $field)
    {
        return self::connect()->hGet($key, $field);
    }

    /**
     * @description 查看hash表的某个字段是否存在，存在返回true，否则返回false
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param $key
     * @param $field
     *
     * @return bool
     */
    public static function hExists($key, $field)
    {
        return self::connect()->hExists($key, $field);
    }

    /**
     * @description 删除hash表的一个字段，不支持删除多个字段。成功返回1，否则返回0
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param $key
     * @param $field
     *
     * @return bool|int
     */
    public static function hDel($key, $field)
    {
        return self::connect()->hDel($key, $field);
    }

    /**
     * @description 同时设置某个hash表的多个字段值。成功返回true
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param $key
     * @param $fieldValue
     *
     * @return bool
     */
    public static function hMset($key, array $fieldValue)
    {
        return self::connect()->hMset($key, $fieldValue);
    }

    /**
     * @description 同时获取某个hash表的多个字段值。其中不存在的字段值为false
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param       $key
     * @param array $fieldValue
     *
     * @return array
     */
    public static function hMget($key, array $fieldValue)
    {
        return self::connect()->hMget($key, $fieldValue);
    }

    /**
     * @description 获取某个hash表所有的字段和值
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param $key
     *
     * @return array
     */
    public static function hGetAll($key)
    {
        return self::connect()->hGetAll($key);
    }

    /**
     * @description 获取某个hash表所有字段名。hash表不存在时返回空数组，key不为hash表时返回false
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param $key
     *
     * @return array
     */
    public static function hKeys($key)
    {
        return self::connect()->hKeys($key);
    }

    /**
     * @description  获取某个hash表所有字段值
     * @author       [zetaiota]
     * @since        2018/7/20
     * @modify
     *
     * @param $key
     *
     * @return array
     */
    public static function hVals($key)
    {
        return self::connect()->hVals($key);
    }

    /**
     * @description 为hash表中不存在的字段赋值。若hash表不存在则先创建，若字段已存在则不做任何操作。设置成功返回true，否则返回false
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param $key
     * @param $field
     * @param $value
     *
     * @return bool
     */
    public static function hSetNx($key, $field, $value)
    {
        return self::connect()->hSetNx($key, $field, $value);
    }

    /**
     * @description 获取某个hash表的字段数量。若hash表不存在返回0，若key不为hash表则返回false
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param $key
     *
     * @return int
     */
    public static function hLen($key)
    {
        return self::connect()->hLen($key);
    }

    /**
     * @description 为hash表中的指定字段加上指定增量值，若增量值为负数则相当于减法操作。
     * 若hash表不存在则先创建，若字段不存在则先初始化值为0再进行操作，
     * 若字段值为字符串则返回false。设置成功返回字段新值。
     * (为hash表中的指定字段加上指定浮点数增量值)
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param $key
     * @param $field
     * @param $num
     *
     * @return int
     */
    public static function hIncrBy($key, $field, $num)
    {
        return self::connect()->hIncrBy($key, $field, $num);
    }

    // +----------------------------------------------------------------------
    // | List操作
    // +----------------------------------------------------------------------
    /**
     * @description 由列表头部添加字符串值。如果不存在该键则创建该列表。如果该键存在，而且不是一个列表，返回FALSE。
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param $key
     * @param $value
     *
     * @return bool|int
     */
    public static function lpush($key, $value)
    {
        return self::connect()->lpush($key, $value);
    }

    /**
     * @description 由列表尾部添加字符串值。如果不存在该键则创建该列表。如果该键存在，而且不是一个列表，返回FALSE
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param $key
     * @param $value
     *
     * @return bool|int
     */
    public static function rpush($key, $value)
    {
        return self::connect()->rpush($key, $value);
    }

    /**
     * @description 返回和移除列表的第一个元素
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param $key
     *
     * @return string
     */
    public static function lpop($key)
    {
        return self::connect()->lpop($key);
    }

    /**
     * @description 移除并返回列表的最后一个元素，若key不存在或不是列表则返回false
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param $key
     *
     * @return string
     */
    public static function rPop($key)
    {
        return self::connect()->rPop($key);
    }

    /**
     * @description 获取列表指定区间中的元素。0表示列表第一个元素，-1表示最后一个元素，-2表示倒数第二个元素
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param $key
     * @param $start
     * @param $end
     *
     * @return array
     */
    public static function lrange($key, $start, $end)
    {
        return self::connect()->lrange($key, $start, $end);
    }

    /**
     * @description 将一个插入已存在的列表头部，列表不存在时操作无效
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param $key
     * @param $value
     *
     * @return int
     */
    public static function lPushx($key, $value)
    {
        return self::connect()->lPushx($key, $value);
    }

    /**
     * @description 将一个或多个值插入已存在的列表尾部，列表不存在时操作无效
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param $key
     * @param $value
     *
     * @return int
     */
    public static function rPushx($key, $value)
    {
        return self::connect()->rPushx($key, $value);
    }

    /**
     * @description  移除并获取列表的第一个元素。如果列表没有元素则会阻塞列表直到等待超时或发现可弹出元素为止。参数：key，超时时间（单位：秒）返回值：[0=>key,1=>value]，超时返回[]
     * @author       [zetaiota]
     * @since        2018/7/20
     * @modify
     *
     * @param $key
     * @param $time
     *
     * @return array
     */
    public static function blPop($key, $time)
    {
        return self::connect()->blPop($key, $time);
    }

    /**
     * @description  移除并获取列表的最后一个元素。如果列表没有元素则会阻塞列表直到等待超时或发现可弹出元素为止。参数：key，超时时间（单位：秒）返回值：[0=>key,1=>value]，超时返回[]
     * @author       [zetaiota]
     * @since        2018/7/20
     * @modify
     *
     * @param $key
     * @param $time
     *
     * @return array
     */
    public static function brPop($key, $time)
    {
        return self::connect()->brPop($key, $time);
    }

    /**
     * @description 移除列表中最后一个元素，将其插入另一个列表头部，并返回这个元素。若源列表没有元素则返回false
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param $key1
     * @param $key2
     *
     * @return string
     */
    public static function rpoplpush($key1, $key2)
    {
        return self::connect()->rpoplpush($key1, $key2);
    }

    /**
     * @description 移除列表中最后一个元素，将其插入另一个列表头部，并返回这个元素。如果列表没有元素则会阻塞列表直到等待超时或发现可弹出元素为止。参数：源列表，目标列表，超时时间（单位：秒）超时返回false
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param $key1
     * @param $key2
     * @param $time
     *
     * @return string
     */
    public static function brpoplpush($key1, $key2, $time)
    {
        return self::connect()->brpoplpush($key1, $key2, $time);
    }

    /**
     * @description 返回列表长度
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param $key
     *
     * @return int
     */
    public static function lLen($key)
    {
        return self::connect()->lLen($key);
    }

    /**
     * @description 通过索引获取列表中的元素。若索引超出列表范围则返回false
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param $key
     * @param $index
     *
     * @return String
     */
    public static function lindex($key, $index)
    {
        return self::connect()->lindex($key, $index);
    }

    /**
     * @description    在列表中指定元素前或后面插入元素。若指定元素不在列表中，或列表不存在时，不执行任何操作。参数：列表key，Redis::AFTER或Redis::BEFORE，基准元素，插入元素返回值：插入成功返回插入后列表元素个数，若基准元素不存在返回-1，若key不存在返回0，若key不是列表返回false
     * @author         [zetaiota]
     * @since          2018/7/20
     * @modify
     *
     * @param $key
     * @param $position
     * @param $pivot
     * @param $value
     *
     * @return int
     */
    public static function lInsert($key, $position, $pivot, $value)
    {
        return self::connect()->lInsert($key, $position, $pivot, $value);
    }

    /**
     * @description 返回实际删除元素个数
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param $key
     * @param $value
     * @param $count
     *
     * @return int
     */
    public static function lrem($key, $value, $count)
    {
        return self::connect()->lrem($key, $value, $count);
    }

    /**
     * @description 对一个列表进行修剪，只保留指定区间的元素，其他元素都删除。成功返回true
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param $key
     * @param $start
     * @param $end
     *
     * @return array
     */
    public static function ltrim($key, $start, $end)
    {
        return self::connect()->ltrim($key, $start, $end);
    }

    /**
     * @description 返回的列表的长度。如果列表不存在或为空，该命令返回0。如果该键不是列表，该命令返回FALSE。
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param $key
     */
    public static function lsize($key)
    {
        return self::connect()->lSize($key);
    }

    /**
     * @description 返回指定键存储在列表中指定的元素。 0第一个元素，1第二个… -1最后一个元素，-2的倒数第二…错误的索引或键不指向列表则返回FALSE
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param string $key   key值
     * @param int    $index 索引值
     */
    public static function lget($key, $index)
    {
        return self::connect()->lget($key, $index);
    }

    /**
     * @description 为列表指定的索引赋新的值,若不存在该索引返回false
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param string $key
     * @param int    $index 索引
     * @param string $value
     *
     * @return bool
     */
    public static function lset($key, $index, $value)
    {
        return self::connect()->lset($key, $index, $value);
    }

    /**
     * @description 返回在该区域中的指定键列表中开始到结束存储的指定元素，lGetRange(key, start, end)。0第一个元素，1第二个元素… -1最后一个元素，-2的倒数第二…
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param $key
     * @param $starIndex
     * @param $endIndex
     *
     * @return array
     */
    public static function lgetrange($key, $starIndex, $endIndex)
    {
        return self::connect()->lgetrange($key, $starIndex, $endIndex);
    }


    /**
     * @description 从列表中从头部开始移除count个匹配的值。如果count为零，所有匹配的元素都被删除。如果count是负数，内容从尾部开始删除
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param $key
     * @param $value
     * @param $count
     */
    public static function lremove($key, $value, $count)
    {
        return self::connect()->lremove($key, $value, $count);
    }

    /**
     * @description 取得所有指定键的值。如果一个或多个键不存在，该数组中该键的值为假
     * @author      [zetaiota]
     * @since       2018/7/19
     * @modify
     *
     * @param array $key
     *
     * @return array
     */
    public static function getMultiple(array $key)
    {
        return self::connect()->getMultiple($key);
    }


    // +----------------------------------------------------------------------
    // | Set操作
    // +----------------------------------------------------------------------
    /**
     * @description 判断指定元素是否是指定集合的成员，是返回true，否则返回false
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param $key
     * @param $value
     *
     * @return bool
     */
    public static function sismember($key, $value)
    {
        return self::connect()->sismember($key, $value);
    }

    /**
     * @description 返回集合中元素的数量
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param $key
     *
     * @return int
     */
    public static function scard($key)
    {
        return self::connect()->scard($key);
    }

    /**
     * @description      返回集合中的一个或多个随机成员元素，返回元素的数量和情况由函数的第二个参数count决定：如果count为正数，且小于集合基数，那么命令返回一个包含count个元素的数组，数组中的元素各不相同。如果count大于等于集合基数，那么返回整个集合。如果count为负数，那么命令返回一个数组，数组中的元素可能会重复出现多次，而数组的长度为count的绝对值。
     * @author           [zetaiota]
     * @since            2018/7/20
     * @modify
     *
     * @param $key
     * @param $count
     *
     * @return array|string
     */
    public static function sRandMember($key, $count)
    {
        return self::connect()->sRandMember($key, $count);
    }

    /**
     * @description 移除集合中指定的一个元素，忽略不存在的元素。删除成功返回1，否则返回0
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param $key
     * @param $value
     *
     * @return int
     */
    public static function srem($key, $value)
    {
        return self::connect()->srem($key, $value);
    }

    /**
     * @description 迭代集合中的元素。参数：key，迭代器变量，匹配模式，每次返回元素数量（默认为10个）
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param        $key
     * @param        $iterator
     * @param string $pattern
     * @param int    $count
     *
     * @return array|bool
     */
    public static function sscan($key, $iterator, $pattern = '', $count = 0)
    {
        return self::connect()->sscan($key, $iterator, $pattern = '', $count = 0);
    }

    /**
     * @description 将所有给定集合的并集存储在指定的目的集合中。若目的集合已存在则覆盖它。返回并集元素个数。参数：第一个参数为目标集合，存储并集
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param      $dstKey
     * @param      $key1
     * @param      $key2
     * @param null $keyN
     *
     * @return int
     */
    public static function sUnionStore($dstKey, $key1, $key2, $keyN = NULL)
    {
        return self::connect()->sUnionStore($dstKey, $key1, $key2, $keyN = NULL);
    }

    /**
     * @description 为一个Key添加一个值。如果这个值已经在这个Key中，则返回FALSE(若key存在，返回false)
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param $key
     * @param $value
     *
     * @return int
     */
    public static function sadd($key, $value)
    {
        return self::connect()->sadd($key, $value);
    }

    /**
     * @description 排序
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param $key
     *
     * @return array
     */
    public static function sort($key)
    {
        return self::connect()->sort($key);
    }

    /**
     * @description 删除Key中指定的value值
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param $key
     * @param $value
     */
    public static function sremove($key, $value)
    {
        return self::connect()->sremove($key, $value);
    }

    /**
     * @description 将Key1中的value移动到Key2中 (sadd添加，否则为false)
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param $key1
     * @param $key2
     * @param $value
     *
     * @return bool
     */
    public static function smove($key1, $key2, $value)
    {
        return self::connect()->smove($key1, $key2, $value);
    }

    /**
     * @description 检查集合中是否存在指定的值
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param $key
     * @param $value
     */
    public static function scontains($key, $value)
    {
        return self::connect()->scontains($key, $value);
    }

    /**
     * @description 返回集合中存储值的数量
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param $key
     *
     * @return mixed
     */
    public static function ssize($key)
    {
        return self::connect()->ssize($key);
    }

    /**
     * @description 随机移除并返回key中的一个值
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param $key
     *
     * @return string
     */
    public static function spop($key)
    {
        return self::connect()->spop($key);
    }

    /**
     * @description 返回一个所有指定键的交集。如果只指定一个键，那么这个命令生成这个集合的成员。如果不存在某个键，则返回FALSE
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param $key1
     * @param $key2
     *
     * @return array
     */
    public static function sinter($key1, $key2)
    {
        return self::connect()->sinter($key1, $key2);
    }

    /**
     * @description 执行sInter命令并把结果储存到新建的变量中
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param $newKey
     * @param $key1
     * @param $key2
     *
     * @return array|int
     */
    public static function sinterstore($newKey, $key1, $key2)
    {
        return self::connect()->sinterstore($newKey, $key1, $key2);

        //return self::connect()->smembers($newKey);
    }

    /**
     * @description 返回一个所有指定键的并集
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param $key1
     * @param $key2
     *
     * @return array
     */
    public static function sunion($key1, $key2)
    {
        return self::connect()->sunion($key1, $key2);
    }

    /**
     * @description 返回第一个集合中存在并在其他所有集合中不存在的结果
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param $key1
     * @param $key2
     *
     * @return array
     */
    public static function sdiff($key1, $key2)
    {
        return self::connect()->sdiff($key1, $key2);
    }

    /**
     * @description 执行sdiff命令并把结果储存到新建的变量中
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param $newKey
     * @param $key1
     * @param $key2
     *
     * @return array
     */
    public static function sdiffstore($newKey, $key1, $key2)
    {
        return self::connect()->sdiffstore($newKey, $key1, $key2);
    }

    /**
     * @description 返回集合的内容
     * @author      [zetaiota]
     * @since       2018/7/20
     * @modify
     *
     * @param $key
     *
     * @return array
     */
    public static function smembers($key)
    {
        return self::connect()->smembers($key);
    }

    // +----------------------------------------------------------------------
    // | Zset操作
    // +----------------------------------------------------------------------
    /**
     * @description     将一个或多个成员元素及其分数值加入到有序集当中。如果某个成员已经是有序集的成员，则更新这个成员的分数值，并通过重新插入这个成员元素，来保证该成员在正确的位置上。分数值可以是整数值或双精度浮点数。
     * @author    [zetaiota]
     * @since     2018/7/20
     * @modify
     *
     * @param      $key
     * @param      $score1
     * @param      $value1
     * @param null $score2
     * @param null $value2
     * @param null $scoreN
     * @param null $valueN
     *
     * @return int
     */
    public static function zAdd($key, $score1, $value1, $score2 = NULL, $value2 = NULL, $scoreN = NULL, $valueN = NULL)
    {
        return self::connect()->zAdd($key, $score1, $value1, $score2 = NULL, $value2 = NULL, $scoreN = NULL, $valueN = NULL);
    }

    /**
     * @description  返回有序集中指定区间内的成员。成员按分数值递增排序，分数值相同的则按字典序来排序。参数：第四个参数表示是否返回各个元素的分数值，默认为false。
     * @author    [zetaiota]
     * @since     2018/7/20
     * @modify
     *
     * @param      $key
     * @param      $start
     * @param      $end
     * @param null $withscores
     *
     * @return array
     */
    public static function zRange($key, $start, $end, $withscores = NULL)
    {
        return self::connect()->zRange($key, $start, $end, $withscores = NULL);
    }

    /**
     * @description 返回有序集中指定区间内的成员。成员按分数值递减排序，分数值相同的则按字典序的逆序来排序
     * @author    [zetaiota]
     * @since     2018/7/20
     * @modify
     * @return mixed
     */
    public static function zReverseRange()
    {
        return self::connect()->zReverseRange('scores', 0, -1, TRUE);
    }

    /**
     * @description 返回有序集中指定分数区间的成员列表，按分数值递增排序，分数值相同的则按字典序来排序。默认使用闭区间
     * @author    [zetaiota]
     * @since     2018/7/20
     * @modify
     * @return array
     */
    public static function zRangeByScore()
    {
        return self::connect()->zRangeByScore('scores', 90, 100, ['withscores' => TRUE]);
    }

    /**
     * @description 返回有序集中指定分数区间的成员列表，按分数值递减排序，分数值相同的则按字典序的逆序来排序。注意，区间表示的时候大值在前，小值在后，默认使用闭区间
     * @author    [zetaiota]
     * @since     2018/7/20
     * @modify
     *
     * @param       $key
     * @param       $start
     * @param       $end
     * @param array $options
     *
     * @return array
     */
    public static function zRevRangeByScore($key, $start, $end, array $options = [])
    {
        return self::connect()->zRevRangeByScore($key, $start, $end);
    }

    /**
     * @description  迭代有序集合中的元素。返回值：[元素名=>分数值,,..]
     * @author    [zetaiota]
     * @since     2018/7/20
     * @modify
     *
     * @param        $key
     * @param        $iterator
     * @param string $pattern
     * @param int    $count
     *
     * @return array|bool
     */
    public static function zscan($key, $iterator, $pattern = '', $count = 0)
    {
        return self::connect()->zscan($key, $iterator, $pattern = '', $count = 0);
    }

    /**
     * @description 返回指定有序集的元素数量
     * @author    [zetaiota]
     * @since     2018/7/20
     * @modify
     *
     * @param $key
     *
     * @return int
     */
    public static function zCard($key)
    {
        return self::connect()->zCard($key);
    }

    /**
     * @description 返回有序集中指定分数区间的成员数量
     * @author    [zetaiota]
     * @since     2018/7/20
     * @modify
     *
     * @param $key
     * @param $start
     * @param $end
     *
     * @return int
     */
    public static function zCount($key, $start, $end)
    {
        return self::connect()->zCount($key, $start, $end);
    }

    /**
     * @description 返回有序集中指定成员的分数值。若成员不存在则返回false
     * @author    [zetaiota]
     * @since     2018/7/20
     * @modify
     *
     * @param $key
     * @param $member
     *
     * @return float
     */
    public static function zScore($key, $member)
    {
        return self::connect()->zScore($key, $member);
    }

    /**
     * @description 返回有序集中指定成员的排名，按分数值递增排序。分数值最小者排名为0
     * @author    [zetaiota]
     * @since     2018/7/20
     * @modify
     *
     * @param $key
     * @param $member
     *
     * @return int
     */
    public static function zRank($key, $member)
    {
        return self::connect()->zRank($key, $member);
    }

    /**
     * @description 返回有序集中指定成员的排名，按分数值递减排序。分数值最大者排名为0
     * @author    [zetaiota]
     * @since     2018/7/20
     * @modify
     *
     * @param $key
     * @param $member
     *
     * @return int
     */
    public static function zRevRank($key, $member)
    {
        return self::connect()->zRevRank($key, $member);
    }

    /**
     * @description  移除有序集中的一个或多个成员，忽略不存在的成员。返回删除的元素个数
     * @author    [zetaiota]
     * @since     2018/7/20
     * @modify
     *
     * @param      $key
     * @param      $member1
     * @param null $member2
     * @param null $memberN
     *
     * @return int
     */
    public static function zRem($key, $member1, $member2 = NULL, $memberN = NULL)
    {
        return self::connect()->zRem($key, $member1, $member2 = NULL, $memberN = NULL);
    }

    /**
     * @description 移除有序集中指定排名区间的所有成员
     * @author    [zetaiota]
     * @since     2018/7/20
     * @modify
     *
     * @param $key
     * @param $start
     * @param $end
     *
     * @return int
     */
    public static function zRemRangeByRank($key, $start, $end)
    {
        return self::connect()->zRemRangeByRank($key, $start, $end);
    }

    /**
     * @description 移除有序集中指定分数值区间的所有成员
     * @author    [zetaiota]
     * @since     2018/7/20
     * @modify
     *
     * @param $key
     * @param $start
     * @param $end
     *
     * @return int
     */
    public static function zRemRangeByScore($key, $start, $end)
    {
        return self::connect()->zRemRangeByScore($key, $start, $end);
    }

    /**
     * @description 对有序集中指定成员的分数值增加指定增量值。若为负数则做减法，若有序集不存在则先创建，若有序集中没有对应成员则先添加，最后再操作
     * @author    [zetaiota]
     * @since     2018/7/20
     * @modify
     *
     * @param $key
     * @param $value
     * @param $member
     *
     * @return float
     */
    public static function zIncrBy($key, $value, $member)
    {
        return self::connect()->zIncrBy($key, $value, $member);
    }

    /**
     * @description 计算给定一个或多个有序集的交集，并将其存储到一个目的有序集中。结果集中某个成员的分数值是所有给定集下该成员分数值之和
     * @author    [zetaiota]
     * @since     2018/7/20
     * @modify
     *
     * @param $key1
     * @param $key2
     * @param $key3
     *
     * @return mixed
     */
    public static function zinterstore($key1,$key2,$key3)
    {
        return self::connect()->zinterstore($key1,$key2,$key3);
    }

    /**
     * @description 计算给定一个或多个有序集的并集，并将其存储到一个目的有序集中。结果集中某个成员的分数值是所有给定集下该成员分数值之和
     * @author    [zetaiota]
     * @since     2018/7/20
     * @modify
     *
     * @param $key1
     * @param $key2
     * @param $key3
     *
     * @return mixed
     */
    public static function zunionstore($key1,$key2,$key3)
    {
        return self::connect()->zunionstore($key1,$key2,$key3);
    }
}
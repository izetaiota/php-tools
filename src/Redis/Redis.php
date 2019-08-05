<?php
/**
 * Redis类
 */

namespace src\Redis;


class Redis
{
    private $redis;

    /**
     * Redis constructor.
     *
     * @param string $host
     * @param string $port
     * @param string $auth
     * @param string $db
     */
    public function __construct($host = '127.0.0.1', $port = '6379', $auth = '', $db = '')
    {
        $this->redis = new \Redis();
        $this->redis->connect($host, $port);
        $this->redis->auth($auth);
        $this->redis->select($db);
    }


    // +----------------------------------------------------------------------
    // | String操作
    // +----------------------------------------------------------------------
    /**
     * @description      设置key和value的值
     *
     * @param string $key   key值
     * @param string $value value值
     *
     * @return bool
     */
    public function set($key, $value)
    {
        return $this->redis->set($key, $value);
    }

    /**
     * @description 获取有关指定键的值
     *
     * @param $key
     *
     * @return bool|string
     */
    public function get($key)
    {
        return $this->redis->get($key);
    }

    /**
     * @description 从某个key所存储的字符串的指定偏移量开始，替换为另一指定字符串，成功返回替换后新字符串的长度。
     *
     * @param $key
     * @param $offset
     * @param $value
     *
     * @return string
     */
    public function setRange($key, $offset, $value)
    {
        return $this->redis->setRange($key, $offset, $value);
    }

    /**
     * @description 获取存储在指定key中字符串的子字符串
     *
     * @param $key
     * @param $start
     * @param $end
     *
     * @return string
     */
    public function getRange($key, $start, $end)
    {
        return $this->redis->getRange($key, $start, $end);
    }

    /**
     * @description 设置新值，返回旧值：若key不存在则设置值，返回false
     *
     * @param $key
     * @param $newValue
     *
     * @return string
     */
    public function getSet($key, $newValue)
    {
        return $this->redis->getSet($key, $newValue);
    }

    /**
     * @description 删除指定的键
     *
     * @param $key
     *
     * @return int
     */
    public function delete($key)
    {
        return $this->redis->delete($key);
    }

    /**
     * @description 不存在该键，设置关键值参数
     *
     * @param $key
     * @param $value
     *
     * @return bool
     */
    public function setnx($key, $value)
    {
        return $this->redis->setnx($key, $value);
    }

    /**
     * @description 验证指定的键是否存在
     *
     * @param $key
     *
     * @return bool
     */
    public function exists($key)
    {
        return $this->redis->exists($key);
    }

    /**
     * @description 数字递增存储键值键 +1
     *
     * @param $key
     *
     * @return int
     */
    public function incr($key)
    {
        return $this->redis->incr($key);
    }

    /**
     * @description 数字递减存储键值 -1
     *
     * @param $key
     *
     * @return int
     */
    public function decr($key)
    {
        return $this->redis->decr($key);
    }

    /**
     * @description 一次设置多个键值对：成功返回true
     *
     * @param array $keyValue
     *
     * @return bool
     */
    public function mset(array $keyValue)
    {
        return $this->redis->mset($keyValue);
    }

    /**
     * @description 一次设置多个键值对：成功返回true
     *
     * @param array $key
     *
     * @return array
     */
    public function mget(array $key)
    {
        return $this->redis->mget($key);
    }

    /**
     * @description 设置指定key的值及其过期时间，单位：秒
     *
     * @param string $key
     * @param int    $time 过期时间
     * @param string $value
     *
     * @return bool
     */
    public function setex($key, $time, $value)
    {
        return $this->redis->setex($key, $time, $value);
    }

    /**
     * @description 以毫秒为单位设置指定key的值和过期时间。成功返回true
     *
     * @param $key
     * @param $time
     * @param $value
     *
     * @return bool
     */
    public function psetex($key, $time, $value)
    {
        return $this->redis->psetex($key, $time, $value);
    }

    /**
     * @description setnx命令的批量操作。只有在给定所有key都不存在的时候才能设置成功，只要其中一个key存在，所有key都无法设置成功
     *
     * @param array $keyValue
     *
     * @return int
     */
    public function msetnx(array $keyValue)
    {
        return $this->redis->msetnx($keyValue);
    }

    /**
     * @description 获取指定key存储的字符串的长度，key不存在返回0，不为字符串返回false
     *
     * @param $key
     *
     * @return int
     */
    public function strlen($key)
    {
        return $this->redis->strlen($key);
    }

    /**
     * @description 给指定key存储的数字值增加指定增量值
     *
     * @param $key
     * @param $num
     *
     * @return int
     */
    public function incrBy($key, $num)
    {
        return $this->redis->incrBy($key, $num);
    }

    /**
     * @description 给指定key存储的数字值增加指定浮点数增量
     *
     * @param $key
     * @param $num
     *
     * @return float
     */
    public function incrByFloat($key, $num)
    {
        return $this->redis->incrByFloat($key, $num);
    }

    /**
     * @description 将指定key存储的数字值减去指定减量值
     *
     * @param $key
     * @param $num
     *
     * @return int
     */
    public function decrBy($key, $num)
    {
        return $this->redis->decrBy($key, $num);
    }

    /**
     * @description 为指定key追加值到原值末尾，若key不存在则相对于set()函数
     *
     * @param $key
     * @param $value
     *
     * @return int
     */
    public function append($key, $value)
    {
        return $this->redis->append($key, $value);
    }


    // +----------------------------------------------------------------------
    // | Hash操作
    // +----------------------------------------------------------------------
    /**
     * @description 为hash表中的字段赋值。成功返回1，失败返回0。若hash表不存在会先创建表再赋值，若字段已存在会覆盖旧值。
     *
     * @param $key
     * @param $field
     * @param $value
     *
     * @return bool|int
     */
    public function hSet($key, $field, $value)
    {
        return $this->redis->hSet($key, $field, $value);
    }

    /**
     * @description 获取hash表中指定字段的值。若hash表不存在则返回false
     *
     * @param $key
     * @param $field
     *
     * @return string
     */
    public function hGet($key, $field)
    {
        return $this->redis->hGet($key, $field);
    }

    /**
     * @description 查看hash表的某个字段是否存在，存在返回true，否则返回false
     *
     * @param $key
     * @param $field
     *
     * @return bool
     */
    public function hExists($key, $field)
    {
        return $this->redis->hExists($key, $field);
    }

    /**
     * @description 删除hash表的一个字段，不支持删除多个字段。成功返回1，否则返回0
     *
     * @param $key
     * @param $field
     *
     * @return bool|int
     */
    public function hDel($key, $field)
    {
        return $this->redis->hDel($key, $field);
    }

    /**
     * @description 同时设置某个hash表的多个字段值。成功返回true
     *
     * @param $key
     * @param $fieldValue
     *
     * @return bool
     */
    public function hMset($key, array $fieldValue)
    {
        return $this->redis->hMset($key, $fieldValue);
    }

    /**
     * @description 同时获取某个hash表的多个字段值。其中不存在的字段值为false
     *
     * @param       $key
     * @param array $fieldValue
     *
     * @return array
     */
    public function hMget($key, array $fieldValue)
    {
        return $this->redis->hMget($key, $fieldValue);
    }

    /**
     * @description 获取某个hash表所有的字段和值
     *
     * @param $key
     *
     * @return array
     */
    public function hGetAll($key)
    {
        return $this->redis->hGetAll($key);
    }

    /**
     * @description 获取某个hash表所有字段名。hash表不存在时返回空数组，key不为hash表时返回false
     *
     * @param $key
     *
     * @return array
     */
    public function hKeys($key)
    {
        return $this->redis->hKeys($key);
    }

    /**
     * @description  获取某个hash表所有字段值
     *
     * @param $key
     *
     * @return array
     */
    public function hVals($key)
    {
        return $this->redis->hVals($key);
    }

    /**
     * @description 为hash表中不存在的字段赋值。若hash表不存在则先创建，若字段已存在则不做任何操作。设置成功返回true，否则返回false
     *
     * @param $key
     * @param $field
     * @param $value
     *
     * @return bool
     */
    public function hSetNx($key, $field, $value)
    {
        return $this->redis->hSetNx($key, $field, $value);
    }

    /**
     * @description 获取某个hash表的字段数量。若hash表不存在返回0，若key不为hash表则返回false
     *
     * @param $key
     *
     * @return int
     */
    public function hLen($key)
    {
        return $this->redis->hLen($key);
    }

    /**
     * @description 为hash表中的指定字段加上指定增量值，若增量值为负数则相当于减法操作。
     * 若hash表不存在则先创建，若字段不存在则先初始化值为0再进行操作，
     * 若字段值为字符串则返回false。设置成功返回字段新值。
     * (为hash表中的指定字段加上指定浮点数增量值)
     *
     * @param $key
     * @param $field
     * @param $num
     *
     * @return int
     */
    public function hIncrBy($key, $field, $num)
    {
        return $this->redis->hIncrBy($key, $field, $num);
    }

    // +----------------------------------------------------------------------
    // | List操作
    // +----------------------------------------------------------------------
    /**
     * @description 由列表头部添加字符串值。如果不存在该键则创建该列表。如果该键存在，而且不是一个列表，返回FALSE。
     *
     * @param $key
     * @param $value
     *
     * @return bool|int
     */
    public function lpush($key, $value)
    {
        return $this->redis->lpush($key, $value);
    }

    /**
     * @description 由列表尾部添加字符串值。如果不存在该键则创建该列表。如果该键存在，而且不是一个列表，返回FALSE
     *
     * @param $key
     * @param $value
     *
     * @return bool|int
     */
    public function rpush($key, $value)
    {
        return $this->redis->rpush($key, $value);
    }

    /**
     * @description 返回和移除列表的第一个元素
     *
     * @param $key
     *
     * @return string
     */
    public function lpop($key)
    {
        return $this->redis->lpop($key);
    }

    /**
     * @description 移除并返回列表的最后一个元素，若key不存在或不是列表则返回false
     *
     * @param $key
     *
     * @return string
     */
    public function rPop($key)
    {
        return $this->redis->rPop($key);
    }

    /**
     * @description 获取列表指定区间中的元素。0表示列表第一个元素，-1表示最后一个元素，-2表示倒数第二个元素
     *
     * @param $key
     * @param $start
     * @param $end
     *
     * @return array
     */
    public function lrange($key, $start, $end)
    {
        return $this->redis->lrange($key, $start, $end);
    }

    /**
     * @description 将一个插入已存在的列表头部，列表不存在时操作无效
     *
     * @param $key
     * @param $value
     *
     * @return int
     */
    public function lPushx($key, $value)
    {
        return $this->redis->lPushx($key, $value);
    }

    /**
     * @description 将一个或多个值插入已存在的列表尾部，列表不存在时操作无效
     *
     * @param $key
     * @param $value
     *
     * @return int
     */
    public function rPushx($key, $value)
    {
        return $this->redis->rPushx($key, $value);
    }

    /**
     * @description  移除并获取列表的第一个元素。如果列表没有元素则会阻塞列表直到等待超时或发现可弹出元素为止。参数：key，超时时间（单位：秒）返回值：[0=>key,1=>value]，超时返回[]
     *
     * @param $key
     * @param $time
     *
     * @return array
     */
    public function blPop($key, $time)
    {
        return $this->redis->blPop($key, $time);
    }

    /**
     * @description  移除并获取列表的最后一个元素。如果列表没有元素则会阻塞列表直到等待超时或发现可弹出元素为止。参数：key，超时时间（单位：秒）返回值：[0=>key,1=>value]，超时返回[]
     *
     * @param $key
     * @param $time
     *
     * @return array
     */
    public function brPop($key, $time)
    {
        return $this->redis->brPop($key, $time);
    }

    /**
     * @description 移除列表中最后一个元素，将其插入另一个列表头部，并返回这个元素。若源列表没有元素则返回false
     *
     * @param $key1
     * @param $key2
     *
     * @return string
     */
    public function rpoplpush($key1, $key2)
    {
        return $this->redis->rpoplpush($key1, $key2);
    }

    /**
     * @description 移除列表中最后一个元素，将其插入另一个列表头部，并返回这个元素。如果列表没有元素则会阻塞列表直到等待超时或发现可弹出元素为止。参数：源列表，目标列表，超时时间（单位：秒）超时返回false
     *
     * @param $key1
     * @param $key2
     * @param $time
     *
     * @return string
     */
    public function brpoplpush($key1, $key2, $time)
    {
        return $this->redis->brpoplpush($key1, $key2, $time);
    }

    /**
     * @description 返回列表长度
     *
     * @param $key
     *
     * @return int
     */
    public function lLen($key)
    {
        return $this->redis->lLen($key);
    }

    /**
     * @description 通过索引获取列表中的元素。若索引超出列表范围则返回false
     *
     * @param $key
     * @param $index
     *
     * @return String
     */
    public function lindex($key, $index)
    {
        return $this->redis->lindex($key, $index);
    }

    /**
     * @description    在列表中指定元素前或后面插入元素。若指定元素不在列表中，或列表不存在时，不执行任何操作。参数：列表key，Redis::AFTER或Redis::BEFORE，基准元素，插入元素返回值：插入成功返回插入后列表元素个数，若基准元素不存在返回-1，若key不存在返回0，若key不是列表返回false
     *
     * @param $key
     * @param $position
     * @param $pivot
     * @param $value
     *
     * @return int
     */
    public function lInsert($key, $position, $pivot, $value)
    {
        return $this->redis->lInsert($key, $position, $pivot, $value);
    }

    /**
     * @description 返回实际删除元素个数
     *
     * @param $key
     * @param $value
     * @param $count
     *
     * @return int
     */
    public function lrem($key, $value, $count)
    {
        return $this->redis->lrem($key, $value, $count);
    }

    /**
     * @description 对一个列表进行修剪，只保留指定区间的元素，其他元素都删除。成功返回true
     *
     * @param $key
     * @param $start
     * @param $end
     *
     * @return array
     */
    public function ltrim($key, $start, $end)
    {
        return $this->redis->ltrim($key, $start, $end);
    }

    /**
     * @description 返回的列表的长度。如果列表不存在或为空，该命令返回0。如果该键不是列表，该命令返回FALSE。
     *
     * @param $key
     */
    public function lsize($key)
    {
        return $this->redis->lSize($key);
    }

    /**
     * @description 返回指定键存储在列表中指定的元素。 0第一个元素，1第二个… -1最后一个元素，-2的倒数第二…错误的索引或键不指向列表则返回FALSE
     *
     * @param string $key   key值
     * @param int    $index 索引值
     */
    public function lget($key, $index)
    {
        return $this->redis->lget($key, $index);
    }

    /**
     * @description 为列表指定的索引赋新的值,若不存在该索引返回false
     *
     * @param string $key
     * @param int    $index 索引
     * @param string $value
     *
     * @return bool
     */
    public function lset($key, $index, $value)
    {
        return $this->redis->lset($key, $index, $value);
    }

    /**
     * @description 返回在该区域中的指定键列表中开始到结束存储的指定元素，lGetRange(key, start, end)。0第一个元素，1第二个元素… -1最后一个元素，-2的倒数第二…
     *
     * @param $key
     * @param $starIndex
     * @param $endIndex
     *
     * @return array
     */
    public function lgetrange($key, $starIndex, $endIndex)
    {
        return $this->redis->lgetrange($key, $starIndex, $endIndex);
    }


    /**
     * @description 从列表中从头部开始移除count个匹配的值。如果count为零，所有匹配的元素都被删除。如果count是负数，内容从尾部开始删除
     *
     * @param $key
     * @param $value
     * @param $count
     */
    public function lremove($key, $value, $count)
    {
        return $this->redis->lremove($key, $value, $count);
    }

    /**
     * @description 取得所有指定键的值。如果一个或多个键不存在，该数组中该键的值为假
     *
     * @param array $key
     *
     * @return array
     */
    public function getMultiple(array $key)
    {
        return $this->redis->getMultiple($key);
    }


    // +----------------------------------------------------------------------
    // | Set操作
    // +----------------------------------------------------------------------
    /**
     * @description 判断指定元素是否是指定集合的成员，是返回true，否则返回false
     *
     * @param $key
     * @param $value
     *
     * @return bool
     */
    public function sismember($key, $value)
    {
        return $this->redis->sismember($key, $value);
    }

    /**
     * @description 返回集合中元素的数量
     *
     * @param $key
     *
     * @return int
     */
    public function scard($key)
    {
        return $this->redis->scard($key);
    }

    /**
     * @description      返回集合中的一个或多个随机成员元素，返回元素的数量和情况由函数的第二个参数count决定：如果count为正数，且小于集合基数，那么命令返回一个包含count个元素的数组，数组中的元素各不相同。如果count大于等于集合基数，那么返回整个集合。如果count为负数，那么命令返回一个数组，数组中的元素可能会重复出现多次，而数组的长度为count的绝对值。
     *
     * @param $key
     * @param $count
     *
     * @return array|string
     */
    public function sRandMember($key, $count)
    {
        return $this->redis->sRandMember($key, $count);
    }

    /**
     * @description 移除集合中指定的一个元素，忽略不存在的元素。删除成功返回1，否则返回0
     *
     * @param $key
     * @param $value
     *
     * @return int
     */
    public function srem($key, $value)
    {
        return $this->redis->srem($key, $value);
    }

    /**
     * @description 迭代集合中的元素。参数：key，迭代器变量，匹配模式，每次返回元素数量（默认为10个）
     *
     * @param        $key
     * @param        $iterator
     * @param string $pattern
     * @param int    $count
     *
     * @return array|bool
     */
    public function sscan($key, $iterator, $pattern = '', $count = 0)
    {
        return $this->redis->sscan($key, $iterator, $pattern = '', $count = 0);
    }

    /**
     * @description 将所有给定集合的并集存储在指定的目的集合中。若目的集合已存在则覆盖它。返回并集元素个数。参数：第一个参数为目标集合，存储并集
     *
     * @param      $dstKey
     * @param      $key1
     * @param      $key2
     * @param null $keyN
     *
     * @return int
     */
    public function sUnionStore($dstKey, $key1, $key2, $keyN = NULL)
    {
        return $this->redis->sUnionStore($dstKey, $key1, $key2, $keyN = NULL);
    }

    /**
     * @description 为一个Key添加一个值。如果这个值已经在这个Key中，则返回FALSE(若key存在，返回false)
     *
     * @param $key
     * @param $value
     *
     * @return int
     */
    public function sadd($key, $value)
    {
        return $this->redis->sadd($key, $value);
    }

    /**
     * @description 排序
     *
     * @param $key
     *
     * @return array
     */
    public function sort($key)
    {
        return $this->redis->sort($key);
    }

    /**
     * @description 删除Key中指定的value值
     *
     * @param $key
     * @param $value
     */
    public function sremove($key, $value)
    {
        return $this->redis->sremove($key, $value);
    }

    /**
     * @description 将Key1中的value移动到Key2中 (sadd添加，否则为false)
     *
     * @param $key1
     * @param $key2
     * @param $value
     *
     * @return bool
     */
    public function smove($key1, $key2, $value)
    {
        return $this->redis->smove($key1, $key2, $value);
    }

    /**
     * @description 检查集合中是否存在指定的值
     *
     * @param $key
     * @param $value
     */
    public function scontains($key, $value)
    {
        return $this->redis->scontains($key, $value);
    }

    /**
     * @description 返回集合中存储值的数量
     *
     * @param $key
     *
     * @return mixed
     */
    public function ssize($key)
    {
        return $this->redis->ssize($key);
    }

    /**
     * @description 随机移除并返回key中的一个值
     *
     * @param $key
     *
     * @return string
     */
    public function spop($key)
    {
        return $this->redis->spop($key);
    }

    /**
     * @description 返回一个所有指定键的交集。如果只指定一个键，那么这个命令生成这个集合的成员。如果不存在某个键，则返回FALSE
     *
     * @param $key1
     * @param $key2
     *
     * @return array
     */
    public function sinter($key1, $key2)
    {
        return $this->redis->sinter($key1, $key2);
    }

    /**
     * @description 执行sInter命令并把结果储存到新建的变量中
     *
     * @param $newKey
     * @param $key1
     * @param $key2
     *
     * @return array|int
     */
    public function sinterstore($newKey, $key1, $key2)
    {
        return $this->redis->sinterstore($newKey, $key1, $key2);

        //return $this->redis->smembers($newKey);
    }

    /**
     * @description 返回一个所有指定键的并集
     *
     * @param $key1
     * @param $key2
     *
     * @return array
     */
    public function sunion($key1, $key2)
    {
        return $this->redis->sunion($key1, $key2);
    }

    /**
     * @description 返回第一个集合中存在并在其他所有集合中不存在的结果
     *
     * @param $key1
     * @param $key2
     *
     * @return array
     */
    public function sdiff($key1, $key2)
    {
        return $this->redis->sdiff($key1, $key2);
    }

    /**
     * @description 执行sdiff命令并把结果储存到新建的变量中
     *
     * @param $newKey
     * @param $key1
     * @param $key2
     *
     * @return array
     */
    public function sdiffstore($newKey, $key1, $key2)
    {
        return $this->redis->sdiffstore($newKey, $key1, $key2);
    }

    /**
     * @description 返回集合的内容
     *
     * @param $key
     *
     * @return array
     */
    public function smembers($key)
    {
        return $this->redis->smembers($key);
    }

    // +----------------------------------------------------------------------
    // | Zset操作
    // +----------------------------------------------------------------------
    /**
     * @description     将一个或多个成员元素及其分数值加入到有序集当中。如果某个成员已经是有序集的成员，则更新这个成员的分数值，并通过重新插入这个成员元素，来保证该成员在正确的位置上。分数值可以是整数值或双精度浮点数。
     * @author          [zetaiota]
     * @since           2018/7/20
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
    public function zAdd($key, $score1, $value1, $score2 = NULL, $value2 = NULL, $scoreN = NULL, $valueN = NULL)
    {
        return $this->redis->zAdd($key, $score1, $value1, $score2 = NULL, $value2 = NULL, $scoreN = NULL, $valueN = NULL);
    }

    /**
     * @description  返回有序集中指定区间内的成员。成员按分数值递增排序，分数值相同的则按字典序来排序。参数：第四个参数表示是否返回各个元素的分数值，默认为false。
     *
     * @param      $key
     * @param      $start
     * @param      $end
     * @param null $withscores
     *
     * @return array
     */
    public function zRange($key, $start, $end, $withscores = NULL)
    {
        return $this->redis->zRange($key, $start, $end, $withscores = NULL);
    }

    /**
     * @description 返回有序集中指定区间内的成员。成员按分数值递减排序，分数值相同的则按字典序的逆序来排序
     * @return mixed
     */
    public function zReverseRange()
    {
        return $this->redis->zReverseRange('scores', 0, -1, TRUE);
    }

    /**
     * @description 返回有序集中指定分数区间的成员列表，按分数值递增排序，分数值相同的则按字典序来排序。默认使用闭区间
     * @return array
     */
    public function zRangeByScore()
    {
        return $this->redis->zRangeByScore('scores', 90, 100, ['withscores' => TRUE]);
    }

    /**
     * @description 返回有序集中指定分数区间的成员列表，按分数值递减排序，分数值相同的则按字典序的逆序来排序。注意，区间表示的时候大值在前，小值在后，默认使用闭区间
     *
     * @param       $key
     * @param       $start
     * @param       $end
     * @param array $options
     *
     * @return array
     */
    public function zRevRangeByScore($key, $start, $end, array $options = [])
    {
        return $this->redis->zRevRangeByScore($key, $start, $end);
    }

    /**
     * @description  迭代有序集合中的元素。返回值：[元素名=>分数值,,..]
     *
     * @param        $key
     * @param        $iterator
     * @param string $pattern
     * @param int    $count
     *
     * @return array|bool
     */
    public function zscan($key, $iterator, $pattern = '', $count = 0)
    {
        return $this->redis->zscan($key, $iterator, $pattern = '', $count = 0);
    }

    /**
     * @description 返回指定有序集的元素数量
     *
     * @param $key
     *
     * @return int
     */
    public function zCard($key)
    {
        return $this->redis->zCard($key);
    }

    /**
     * @description 返回有序集中指定分数区间的成员数量
     *
     * @param $key
     * @param $start
     * @param $end
     *
     * @return int
     */
    public function zCount($key, $start, $end)
    {
        return $this->redis->zCount($key, $start, $end);
    }

    /**
     * @description 返回有序集中指定成员的分数值。若成员不存在则返回false
     *
     * @param $key
     * @param $member
     *
     * @return float
     */
    public function zScore($key, $member)
    {
        return $this->redis->zScore($key, $member);
    }

    /**
     * @description 返回有序集中指定成员的排名，按分数值递增排序。分数值最小者排名为0
     *
     * @param $key
     * @param $member
     *
     * @return int
     */
    public function zRank($key, $member)
    {
        return $this->redis->zRank($key, $member);
    }

    /**
     * @description 返回有序集中指定成员的排名，按分数值递减排序。分数值最大者排名为0
     *
     * @param $key
     * @param $member
     *
     * @return int
     */
    public function zRevRank($key, $member)
    {
        return $this->redis->zRevRank($key, $member);
    }

    /**
     * @description  移除有序集中的一个或多个成员，忽略不存在的成员。返回删除的元素个数
     *
     * @param      $key
     * @param      $member1
     * @param null $member2
     * @param null $memberN
     *
     * @return int
     */
    public function zRem($key, $member1, $member2 = NULL, $memberN = NULL)
    {
        return $this->redis->zRem($key, $member1, $member2 = NULL, $memberN = NULL);
    }

    /**
     * @description 移除有序集中指定排名区间的所有成员
     *
     * @param $key
     * @param $start
     * @param $end
     *
     * @return int
     */
    public function zRemRangeByRank($key, $start, $end)
    {
        return $this->redis->zRemRangeByRank($key, $start, $end);
    }

    /**
     * @description 移除有序集中指定分数值区间的所有成员
     *
     * @param $key
     * @param $start
     * @param $end
     *
     * @return int
     */
    public function zRemRangeByScore($key, $start, $end)
    {
        return $this->redis->zRemRangeByScore($key, $start, $end);
    }

    /**
     * @description 对有序集中指定成员的分数值增加指定增量值。若为负数则做减法，若有序集不存在则先创建，若有序集中没有对应成员则先添加，最后再操作
     *
     * @param $key
     * @param $value
     * @param $member
     *
     * @return float
     */
    public function zIncrBy($key, $value, $member)
    {
        return $this->redis->zIncrBy($key, $value, $member);
    }

    /**
     * @description 计算给定一个或多个有序集的交集，并将其存储到一个目的有序集中。结果集中某个成员的分数值是所有给定集下该成员分数值之和
     *
     * @param $key1
     * @param $key2
     * @param $key3
     *
     * @return mixed
     */
    public function zinterstore($key1, $key2, $key3)
    {
        return $this->redis->zinterstore($key1, $key2, $key3);
    }

    /**
     * @description 计算给定一个或多个有序集的并集，并将其存储到一个目的有序集中。结果集中某个成员的分数值是所有给定集下该成员分数值之和
     *
     * @param $key1
     * @param $key2
     * @param $key3
     *
     * @return mixed
     */
    public function zunionstore($key1, $key2, $key3)
    {
        return $this->redis->zunionstore($key1, $key2, $key3);
    }
}
<?php

/**
 * BloomFilterRedis
 */

namespace src\Util;

abstract class BloomFilterRedis
{
    /**
     * 需要使用一个方法来定义bucket的名字
     */
    protected $bucket;

    protected $hashFunction;

    public function __construct()
    {
        if (!$this->bucket || !$this->hashFunction) {
            throw new \Exception("需要定义bucket和hashFunction", 1);
        }
        $this->Hash  = new BloomFilterHash;
        $this->Redis = self::getRedis(); //假设这里你已经连接好了
    }

    public static function getRedis()
    {
        $redis = new \Redis();
        $redis->connect('127.0.0.1', 6379);
        //        $redis->auth('13sai666.');
        //        var_dump($redis->info('SERVER'));die;
        $redis->select(7);

        return $redis;
    }

    /**
     * 添加到集合中
     */
    public function add($string)
    {
        foreach ($this->hashFunction as $function) {
            $hash = $this->Hash->$function($string);
            $this->Redis->setBit($this->bucket, $hash, 1);
        }

        return true;
    }

    /**
     * 查询是否存在, 存在的一定会存在, 不存在有一定几率会误判
     */
    public function exists($string)
    {
        $pipe = $this->Redis->multi();
        $len  = strlen($string);
        foreach ($this->hashFunction as $function) {
            $hash = $this->Hash->$function($string, $len);
            $pipe = $pipe->getBit($this->bucket, $hash);
        }

        $res = $pipe->exec();
        //        var_dump($res);
        foreach ($res as $bit) {
            if ($bit == 0) {
                return false;
            }
        }

        return true;
    }
}
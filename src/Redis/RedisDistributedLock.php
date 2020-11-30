<?php
/**
 * 分布式锁
 * 基于redis
 */

namespace src\Redis;

class RedisDistributedLock
{
    private $redisConfig; //Redis配置
    private $lockKey; //锁的键名
    private $acquireTimeout; //超时时间
    private $redis; //$reids实例
    private $isNegtive = true; //是否是悲观锁
    private $identify = ""; //锁的唯一标识，防止锁被别的进程误删

    public function __construct($redisConfig, $lockKey, $acquireTimeout = 5, $isNegtive = true)
    {
        if (!$redisConfig || !is_array($redisConfig)) {
            throw new \Exception("redis配置错误");
        }
        if (!$lockKey) {
            throw new \Exception("lockKey不能为空");
        }

        try {
            $this->redisConfig = $redisConfig;
            $this->lockKey = $lockKey;
            $this->isNegtive = $isNegtive;
            $this->acquireTimeout = $acquireTimeout;
            $this->redis = new \Redis();
            $this->redis->connect($redisConfig["host"], $redisConfig["port"]);
        } catch (\RedisException $e) {
            throw $e;
        }
    }

    /**
     * 获取锁
     */
    public function lock()
    {
        $v = uniqid();
        if ($this->isNegtive) { //悲观锁
            $endtime = microtime(true) * 1000 + $this->acquireTimeout * 1000;
            while (microtime(true) * 1000 < $endtime) { //每隔一段时间尝试获取一次锁
                $acquired = $this->redis->set($this->lockKey, $v, ["NX", "EX" => $this->acquireTimeout]);
                if ($acquired) { //获取锁成功，返回true
                    $this->identify = $v;
                    return true;
                }
                usleep(100);
            }
            return false; //获取锁超时，返回false
        } else { //乐观锁
            /**
             * 乐观锁只尝试一次，成功返回true,失败返回false
             */
            $acquired = $this->redis->set($this->lockKey, $v, ["NX", "EX" => $this->acquireTimeout]);
            if ($acquired) {
                $this->identify = $v;
                return true;
            }
            return false;
        }
    }

    /**
     * 释放锁
     */
    public function unlock()
    {
        if (!$this->identify) { //没有成功获得锁，直接返回false
            return false;
        }
        /**
         * 由于判断是否相等和删除是两步操作，因此使用 lua 脚本来保证原子性
         */
        $script = "if redis.call('get', KEYS[1]) == ARGV[1] then return redis.call('del', KEYS[1]) else return 0 end";
        $result = $this->redis->eval($script, [$this->lockKey, $this->identify], 1);
        if ($result) {
            return true;
        }
        return false;
    }
}
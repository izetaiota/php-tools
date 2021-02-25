<?php
/**
 * 时区转换
 */

namespace src\Util;


class TimeZone
{
    //返回的时间格式
    protected $time_format = '';

    public function __construct($time_format = 'Y-m-d H:i:s')
    {
        $this->time_format = $time_format;
    }


    /**
     * @Desc
     * @Author zetaiota<zhangli@eccang.com>
     * @Date 2021-02-25
     * @param $time
     * @param string $local_time_zone
     * @param string $goal_time_zone
     * @return array
     */
    public function convert($time, $local_time_zone = 'Asia/Shanghai', $goal_time_zone = 'Pacific/Chatham')
    {
        $result = ['code' => 0, 'msg' => 'error', 'data' => ''];
        if ($this->isTimestamp($time)) {//判断是否时间戳
            $date_time = date('Y-m-d H:i:s', $time);
        } else if ($this->isDate($time)) {
            $date_time = $time;
        } else {
            $result['msg'] = '时间格式有误';
            return $result;
        }

        $time_zone_list = $this->getZone();

        //判断本地时区是否合法
        if (!in_array($local_time_zone, $time_zone_list)) {
            $result['msg'] = '本地时区非法';
            return $result;
        }

        //判断目标时区是否合法
        if (!in_array($goal_time_zone, $time_zone_list)) {
            $result['msg'] = '目标时区非法';
            return $result;
        }

        //开始转换时区
        try {
            $date = new \DateTime($date_time, new \DateTimeZone($local_time_zone));
            $date->setTimezone(new \DateTimeZone($goal_time_zone));
            $result['data'] = $date->format($this->time_format);
            $result['code'] = 1;
            $result['msg'] = $goal_time_zone . ' is ok';

        } catch (\Exception $e) {
            $result['data'] = $e;
        }

        return $result;
    }


    /**
     * @Desc 获取支持的时区
     * @Author zetaiota<zhangli@eccang.com>
     * @Date 2021-02-25
     * @return array
     */
    public function getZone()
    {
        return \DateTimeZone::listIdentifiers();
    }


    /**
     * @Desc 判断时间是否是时间戳
     * @Author zetaiota<zhangli@eccang.com>
     * @Date 2021-02-25
     * @param $timestamp
     * @return bool
     */
    protected function isTimestamp($timestamp)
    {
        if (strtotime(date('Y-m-d H:i:s', $timestamp)) === $timestamp) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * @Desc  判断时间是否有效
     * @Author zetaiota<zhangli@eccang.com>
     * @Date 2021-02-25
     * @param $date
     * @return bool
     */
    protected function isDate($date)
    {
        if (strtotime($date)) {
            return true;
        } else {
            return false;
        }
    }
}
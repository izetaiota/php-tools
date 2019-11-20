<?php

namespace expand;

class Tree
{
    //存放无限极分类结果
    static public $treeList = [];

    public function __construct()
    {
        //为什么要重置为空数组，因为如果同一个文件，发生两次都调用树时，第二次调用会将第一次中的数据保存在数组($treeList) 中，因此每次清空数组($treeList)。
        self::$treeList = [];
    }

    /**
     * 创建树
     * @desc
     * @author    [Anly]
     * @since     2018/7/8
     * @modify
     *
     * @param        $data
     * @param int    $pid
     * @param int    $h_layer
     * @param string $parent_id
     *
     * @return array
     */
    public function create($data, $pid = 0, $h_layer = 0, $parent_id = 'pid')
    {
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $h_layer++;
                if ($value[$parent_id] == $pid) {
                    $value['h_layer'] = $h_layer;
                    self::$treeList[] = $value;
                    unset($data[$key]);
                    self::create($data, $value['id'], $h_layer);
                }
                $h_layer--;
            }
        }

        return self::$treeList;
    }


    /**
     * @description 将数据格式化成树形结构
     * @modify
     *
     * @param array $items
     *
     * @return array
     */
    public function genTree5($items)
    {
        foreach ($items as $item) {
            $items[$item['pid']]['son'][$item['id']] = &$items[$item['id']];
        }

        return isset($items[0]['son']) ? $items[0]['son'] : [];

        //$items = [
        //    1  => ['id' => 1, 'pid' => 0, 'name' => '江西省'],
        //    2  => ['id' => 2, 'pid' => 0, 'name' => '黑龙江省'],
        //    3  => ['id' => 3, 'pid' => 1, 'name' => '南昌市'],
        //    4  => ['id' => 4, 'pid' => 2, 'name' => '哈尔滨市'],
        //    5  => ['id' => 5, 'pid' => 2, 'name' => '鸡西市'],
        //    6  => ['id' => 6, 'pid' => 4, 'name' => '香坊区'],
        //    7  => ['id' => 7, 'pid' => 4, 'name' => '南岗区'],
        //    8  => ['id' => 8, 'pid' => 6, 'name' => '和兴路'],
        //    9  => ['id' => 9, 'pid' => 7, 'name' => '西大直街'],
        //    10 => ['id' => 10, 'pid' => 8, 'name' => '东北林业大学'],
        //    11 => ['id' => 11, 'pid' => 9, 'name' => '哈尔滨工业大学'],
        //    12 => ['id' => 12, 'pid' => 8, 'name' => '哈尔滨师范大学'],
        //    13 => ['id' => 13, 'pid' => 1, 'name' => '赣州市'],
        //    14 => ['id' => 14, 'pid' => 13, 'name' => '赣县'],
        //    15 => ['id' => 15, 'pid' => 13, 'name' => '于都县'],
        //    16 => ['id' => 16, 'pid' => 14, 'name' => '茅店镇'],
        //    17 => ['id' => 17, 'pid' => 14, 'name' => '大田乡'],
        //    18 => ['id' => 18, 'pid' => 16, 'name' => '义源村'],
        //    19 => ['id' => 19, 'pid' => 16, 'name' => '上坝村'],
        //];
    }

    /**
     * 将数据格式化成树形结构
     *
     * @param array $items
     *
     * @return array
     */
    public function genTree9($items)
    {
        $tree = []; //格式化好的树
        foreach ($items as $item) {
            if (isset($items[$item['pid']])) {
                $items[$item['pid']]['son'][] = &$items[$item['id']];
            } else {
                $tree[] = &$items[$item['id']];
            }
        }

        return $tree;
    }


}
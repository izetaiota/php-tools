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
        if (!empty($data))
        {
            foreach ($data as $key => $value)
            {
                $h_layer++;
                if ($value[ $parent_id ] == $pid)
                {
                    $value['h_layer'] = $h_layer;
                    self::$treeList[] = $value;
                    unset($data[ $key ]);
                    self::create($data, $value['id'], $h_layer);
                }
                $h_layer--;
            }
        }

        return self::$treeList;
    }
}
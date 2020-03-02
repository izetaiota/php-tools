<?php

/**
 * sql批量更新大量数据语句优化
 */

namespace src\Sql;

class SqlBatchUp
{
    /**
     * @description 批量更新sql组装优化语句 （参考资料：https://www.cnblogs.com/ldj3/p/9288187.html）
     * @modify
     *
     * @param  string $table    表
     * @param  array  $data     批量更新的数据，注意是二维数组
     * @param  string $field    跟新的条件字段
     * @param array   $whereAry 跟新的条件 数组
     *
     * @return bool|string
     */
    public function batchUpdate($table, $data, $field, $whereAry = [])
    {
        if (!is_array($data) || !$field || !is_array($whereAry)) {
            return false;
        }

        $updates = $this->parseUpdate($data, $field);
        $where   = $this->parseParams($whereAry);

        // 获取所有键名为$field列的值，值两边加上单引号，保存在$fields数组中
        $fields = array_column($data, $field);
        $fields = implode(',', array_map(function ($value) {
            return "'" . $value . "'";
        }, $fields));

        //组装好的sql语句
        return sprintf("UPDATE `%s` SET %s WHERE `%s` IN (%s) %s", $table, $updates, $field, $fields, $where);
    }

    /**
     * 将二维数组转换成CASE WHEN THEN的批量更新条件
     *
     * @param $data  array 二维数组
     * @param $field string 列名
     *
     * @return string sql语句
     */
    private function parseUpdate($data, $field)
    {
        $sql  = '';
        $keys = array_keys(current($data));
        foreach ($keys as $column) {

            $sql .= sprintf("`%s` = CASE `%s` \n", $column, $field);
            foreach ($data as $line) {
                $sql .= sprintf("WHEN '%s' THEN '%s' \n", $line[$field], $line[$column]);
            }
            $sql .= "END,";
        }

        return rtrim($sql, ',');
    }

    /**
     * 解析where条件
     *
     * @param $params
     *
     * @return array|string
     */
    private function parseParams($params)
    {
        $where = [];
        foreach ($params as $key => $value) {
            $where[] = sprintf("`%s` = '%s'", $key, $value);
        }

        return $where ? ' AND ' . implode(' AND ', $where) : '';
    }
}
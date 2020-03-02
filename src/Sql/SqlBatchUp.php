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
     * @param  string $table         表
     * @param  array  $data          批量更新的数据，注意是二维数组
     * @param  array  $whereAry      更新数据数组
     * @param  string $field         更新的条件字段
     * @param array   $queryWhereAry 更新的条件 数组
     *
     * @return bool|string
     */
    public function batchUpdate($table, $data, $whereAry, $field, $queryWhereAry = [])
    {
        if (!is_array($data) || !$field || !is_array($queryWhereAry) || !is_array($whereAry)) {
            return false;
        }

        $updates = $this->parseUpdate($data, $whereAry, $field);
        $where   = $this->parseParams($queryWhereAry);

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
     * @param  array  $data     array 二维数组
     * @param array   $whereAry 更新的条件
     * @param  string $field    列名
     *
     * @return string sql语句
     */
    private function parseUpdate($data, $whereAry, $field)
    {
        $sql = '';
        $sql .= sprintf("`%s` = CASE `%s` \n", array_keys($whereAry)[0], $field);

        foreach ($data as $line) {
            $sql .= sprintf("WHEN '%s' THEN '%s' \n", $line[$field], array_values($whereAry)[0]);
        }

        $sql .= "END,";

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
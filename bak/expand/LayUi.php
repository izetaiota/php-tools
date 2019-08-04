<?php
/**
 * @desc
 * @author    [Anly]
 * @since     2018/7/18
 * @copyright
 */

namespace expand;


class LayUi
{
    /**
     * layUi表格数据返回方式
     * @desc
     * @author    [Anly,]
     * @since     2018/05/
     * @modify
     *
     * @param        $code
     * @param        $count
     * @param        $data
     * @param string $msg
     *
     * @return string
     */
    public static function LayUiTable($code, $count, $data, $msg = "")
    {
        return json_encode(["code" => $code, "msg" => $msg, "count" => $count, "data" => $data],TRUE);
    }

    /**
     * 返回的数据
     * @desc
     * @author    [Anly,]
     * @since     2018/05/
     * @modify
     *
     * @param int    $code 状态码
     * @param string $msg  返回的信息
     * @param array  $data 返回的数据
     *
     * @return string
     */
    public static function resJson($code, $msg, $data = [])
    {
        return json_encode(['code' => $code, 'msg' => $msg, 'data' => $data],TRUE);
    }


}
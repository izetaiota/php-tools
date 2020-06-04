<?php
/**
 * layUi返回数据格式
 */

namespace src\Util;


class LayUi
{
    /**
     * layUi表格数据返回方式
     *
     * @param        $code
     * @param        $count
     * @param        $data
     * @param Str    $msg
     *
     * @return Str
     */
    public static function LayUiTable($code, $count, $data, $msg = "")
    {
        return json_encode(["code" => $code, "msg" => $msg, "count" => $count, "data" => $data], TRUE);
    }

    /**
     * 返回的数据
     *
     * @param int   $code 状态码
     * @param Str   $msg  返回的信息
     * @param array $data 返回的数据
     *
     * @return Str
     */
    public static function resJson($code, $msg, $data = [])
    {
        return json_encode(['code' => $code, 'msg' => $msg, 'data' => $data], TRUE);
    }


}
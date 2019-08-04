<?php

namespace src\Util;

/**
 * @description 验证器
 * @copyright
 */
class Validate
{
    /**
     * @description 密码强度校验(必须是包含大小写字母和数字的组合，不能使用特殊字符，长度在8-10之间)
     *
     * @param string $str 校验的密码
     *
     * @return bool
     */
    public static function safePwd($str)
    {
        //校验规则
        $reg = '/^(?=.*\\d)(?=.*[a-z])(?=.*[A-Z]).{8,10}$/';

        return preg_match($reg, $str, $match) ? TRUE : FALSE;
    }

    /**
     * 验证手机号是否正确
     * 仅支持中国大陆11位手机号
     * 移动：134、135、136、137、138、139、150、151、152、157、158、159、182、183、184、187、188、178(4G)、147(上网卡)；
     * 联通：130、131、132、155、156、185、186、176(4G)、145(上网卡)；
     * 电信：133、153、180、181、189 、177(4G)；
     * 卫星通信：1349
     * 虚拟运营商：170
     * @author lan
     *
     * @param string $mobile 手机号码
     *
     * @return bool
     */
    public static function isMobile($mobile)
    {
        //校验规则
        $reg = '#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#';

        return preg_match($reg, $mobile) ? TRUE : FALSE;
    }

    /**
     * 验证邮箱是否正确
     * @author lan
     *
     * @param string $email 邮箱地址
     *
     * @return bool
     */
    public static function isEmail($email)
    {
        //校验规则
        $reg = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";

        //$reg = "/^1(3[0-9]|4[57]|5[0-35-9]|7[0135678]|8[0-9])\\d{8}$/";

        return preg_match($reg, $email) ? TRUE : FALSE;
    }

    /**
     * 验证身份证号码格式是否正确
     * 仅支持二代身份证
     *
     * @param string $idCard 身份证号码
     *
     * @return boolean
     */
    public static function isIdCard($idCard)
    {
        // 只能是18位
        if (strlen($idCard) != 18)
        {
            return FALSE;
        }

        $vCity = [
            '11', '12', '13', '14', '15', '21', '22',
            '23', '31', '32', '33', '34', '35', '36',
            '37', '41', '42', '43', '44', '45', '46',
            '50', '51', '52', '53', '54', '61', '62',
            '63', '64', '65', '71', '81', '82', '91',
        ];

        if (!preg_match('/^([\d]{17}[xX\d]|[\d]{15})$/', $idCard)) return FALSE;

        if (!in_array(substr($idCard, 0, 2), $vCity)) return FALSE;

        // 取出本体码
        $id_card_base = substr($idCard, 0, 17);

        // 取出校验码
        $verify_code = substr($idCard, 17, 1);

        // 加权因子
        $factor = [7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2];

        // 校验码对应值
        $verify_code_list = ['1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2'];

        // 根据前17位计算校验码
        $total = 0;
        for ($i = 0; $i < 17; $i++)
        {
            $total += substr($id_card_base, $i, 1) * $factor[ $i ];
        }

        // 取模
        $mod = $total % 11;

        // 比较校验码
        return $verify_code == $verify_code_list[ $mod ] ? TRUE : FALSE;
    }

    /**
     * @description 校验腾讯QQ
     *
     * @param string $str
     *
     * @return bool
     */
    public static function isQQ($str)
    {
        //校验规则
        $reg = '/[1-9][0-9]{4,}/';

        return preg_match($reg, $str) ? TRUE : FALSE;
    }


    /**
     * @description 验证正确的url
     *
     * @param $str
     *
     * @return bool
     */
    public static function url($str)
    {
        //校验规则
        $reg = '_^(?:(?:https?|ftp)://)(?:\S+(?::\S*)?@)?(?:(?!10(?:\.\d{1,3}){3})(?!127(?:\.\d{1,3}){3})(?!169\.254(?:\.\d{1,3}){2})(?!192\.168(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\x{00a1}-\x{ffff}0-9]+-?)*[a-z\x{00a1}-\x{ffff}0-9]+)(?:\.(?:[a-z\x{00a1}-\x{ffff}0-9]+-?)*[a-z\x{00a1}-\x{ffff}0-9]+)*(?:\.(?:[a-z\x{00a1}-\x{ffff}]{2,})))(?::\d{2,5})?(?:/[^\s]*)?$_iuS';

        return preg_match($reg, $str) ? TRUE : FALSE;
    }


    /**
     * 是否日期
     *
     * @param $value
     *
     * @return bool
     */
    public static function isDate($value)
    {
        return FALSE !== strtotime($value);
    }

    /**
     * 是否纯字母
     *
     * @param $value
     *
     * @return bool
     */
    public static function isAlpha($value)
    {
        return self::regex($value, '/^[A-Za-z]+$/');
    }

    /**
     * 是否数字字母
     *
     * @param $value
     *
     * @return bool
     */
    public static function isAlphaNum($value)
    {
        return self::regex($value, '/^[A-Za-z0-9]+$/');
    }

    /**
     * 是否纯汉字
     *
     * @param $value
     *
     * @return bool
     */
    public static function isChs($value)
    {
        return self::regex($value, '/^[\x{4e00}-\x{9fa5}]+$/u');
    }

    /**
     * 是否字母汉字
     *
     * @param $value
     *
     * @return bool
     */
    public static function isChsAlpha($value)
    {
        return self::regex($value, '/^[\x{4e00}-\x{9fa5}a-zA-Z]+$/u');
    }

    /**
     * 是否数字字母汉字
     *
     * @param $value
     *
     * @return bool
     */
    public static function isChsAlphaNum($value)
    {
        return self::regex($value, '/^[\x{4e00}-\x{9fa5}a-zA-Z0-9]+$/u');
    }


    /**
     * 是否汉字、字母、数字和下划线_及破折号-
     *
     * @param $value
     *
     * @return bool
     */
    public static function isChsDash($value)
    {
        return self::regex($value, '/^[\x{4e00}-\x{9fa5}a-zA-Z0-9\_\-]+$/u');
    }

    /**
     * 是否邮箱
     *
     * @param $value
     *
     * @return bool
     */
    public static function is_email($value)
    {
        return self::filter($value, FILTER_VALIDATE_EMAIL);
    }

    /**
     * 是否url
     *
     * @param $value
     *
     * @return bool
     */
    public static function is_url($value)
    {
        return self::filter($value, FILTER_VALIDATE_URL);
    }

    /**
     * 是否ip
     *
     * @param $value
     *
     * @return bool
     */
    public static function isIp($value)
    {
        return self::filter($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6);
    }

    /**
     * 使用正则验证数据
     * @access protected
     *
     * @param mixed $value 字段值
     * @param mixed $rule  验证规则 正则规则或者预定义正则名
     *
     * @return mixed
     */
    protected static function regex($value, $rule)
    {
        if (0 !== strpos($rule, '/') && !preg_match('/\/[imsU]{0,4}$/', $rule))
        {
            // 不是正则表达式则两端补上/
            $rule = '/^' . $rule . '$/';
        }

        return 1 === preg_match($rule, (string)$value);
    }

    /**
     * 使用filter_var方式验证
     * @access protected
     *
     * @param mixed $value 字段值
     * @param mixed $rule  验证规则
     *
     * @return bool
     */
    protected static function filter($value, $rule)
    {
        if (is_string($rule) && strpos($rule, ','))
        {
            list($rule, $param) = explode(',', $rule);
        }
        elseif (is_array($rule))
        {
            $param = isset($rule[1]) ? $rule[1] : NULL;
        }
        else
        {
            $param = NULL;
        }

        return FALSE !== filter_var($value, is_int($rule) ? $rule : filter_id($rule), $param);
    }


}

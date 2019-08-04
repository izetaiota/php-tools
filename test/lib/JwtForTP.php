<?php

namespace lib;

use Firebase\JWT\JWT;


/**
 * 参考资料：
 * 1.https://github.com/firebase/php-jwt
 * 2.http://blog.daozys.com/goods_90.html
 * 3.https://blog.csdn.net/hjh15827475896/article/details/84948400
 */
class JwtForTP
{
    /**
     * @description 获取token
     * @author      [zetaiota]
     * @since       2019/4/27
     * @modify
     *
     * @param array $data 数据
     *
     * @return string
     */
    public static function getToken($data)
    {
        $key  = 'zetaiota'; //key 这里是自定义的一个随机字串，应该写在config文件中的，解密时也会用，相当于加密中常用的盐 salt
        $time = time(); //当前时间

        //公用信息
        $token = [
            'iss'  => "", //签发者 可以为空
            "aud"  => "", //面象的用户，可以为空
            'iat'  => $time, //签发时间
            // "nbf"  => time() + 10, //在什么时候jwt开始生效  （这里表示生成10秒后才生效）
            'data' => $data, //自定义信息，不要定义敏感信息
        ];

        $access_token           = $token; // access_token
        $access_token['scopes'] = 'role_access'; //token标识，请求接口的token
        $access_token['exp']    = $time + 7200; //access_token过期时间,这里设置2个小时

        $refresh_token           = $token; //refresh_token
        $refresh_token['scopes'] = 'role_refresh'; //token标识，刷新access_token
        $refresh_token['exp']    = $time + (86400 * 30); //refresh_token过期时间,这里设置30天

        $jsonList = [
            'access_token'  => JWT::encode($access_token, $key),
            'refresh_token' => JWT::encode($refresh_token, $key),
            'token_type'    => 'bearer' //token_type：表示令牌类型，该值大小写不敏感，这里用bearer
        ];
        Header("HTTP/1.1 201 Created");

        return json_encode($jsonList); //返回给客户端token信息

    }


    /**
     * @description 检测token
     * @author      [zetaiota]
     * @since       2019/4/27
     * @modify
     *
     * @param string $token token令牌
     *
     * @return \think\response\Json
     */
    public static function check($token)
    {
        $key = "zetaiota";  //$key 本应该配置在 config文件中的

        try
        {
            //JWT::$leeway = 60;//当前时间减去60，把时间留点余地
            $info = JWT::decode($token, $key, ["HS256"]); //解密jwt,HS256方式，这里要和签发的时候对应

            return json_decode(json_encode($info),TRUE);

        } catch (\Firebase\JWT\SignatureInvalidException $e)
        {  //签名不正确
            echo $e->getMessage();
        } catch (\Firebase\JWT\BeforeValidException $e)
        {  // 签名在某个时间点之后才能用
            echo $e->getMessage();
        } catch (\Firebase\JWT\ExpiredException $e)
        {  // token过期
            echo $e->getMessage();
        } catch (\Exception $e)
        {  //其他错误
            echo $e->getMessage();
        }
        //Firebase定义了多个 throw new，我们可以捕获多个catch来定义问题，catch加入自己的业务，比如token过期可以用当前Token刷新一个新Token
    }


}
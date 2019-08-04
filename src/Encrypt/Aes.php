<?php

namespace src\Encrypt;

/** OpensslAES类
 * @desc      加密、解密(php7.+ 加密方式)
 * @copyright
 */

class Aes
{
    public $method;      //密码学方式  openssl_get_cipher_methods() 共201种
    public $secret_key;  //秘钥
    public $iv;          //非 NULL 的初始化向量
    public $options;     //options 是以下标记的按位或： OPENSSL_RAW_DATA 、 OPENSSL_ZERO_PADDING

    public function __construct($method = 'AES-128-ECB', $iv = '', $aesKey = 'aes_key', $options = 0)
    {
        $this->secret_key = $aesKey;
        $this->method     = $method;
        $this->iv         = $iv;
        $this->options    = $options;
    }

    /**
     * 加密
     * @param string $data 加密的数据
     *
     * @return string
     */
    public function encrypt($data)
    {
        return openssl_encrypt($data, $this->method, $this->secret_key, $this->options, $this->iv);
    }

    /**
     * 解密
     * @param string $data 解密的数据
     *
     * @return string
     */
    public function decrypt($data)
    {
        return openssl_decrypt($data, $this->method, $this->secret_key, $this->options, $this->iv);
    }
}
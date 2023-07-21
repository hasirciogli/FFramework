<?php

namespace app\ffunctions;


class FCrypter
{
    private $cipher = "";
    private $passSalt = "";

    public function getEncrypt($data){

        return @openssl_encrypt($data, $this->cipher, $this->passSalt, $options=0, 123);
    }

    public function getDecrypt($data){

        return @openssl_decrypt($data, $this->cipher, $this->passSalt, $options=0, 123);
    }

    public static function get() {
        return new FCrypter();
    }
}
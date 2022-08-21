<?php

namespace FCrypter;


class FCrypter
{
    private $cipher = "ENCRYPT-CHIPER-METHO-EXAMPLE('aes128')";
    private $passSalt = "PASSWORD-SALT";

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
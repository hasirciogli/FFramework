<?php

namespace app\ffunctions;


class FFCrypter
{
    private string $cipher = "";
    private string $passSalt = "";

    /**
     * @param string $ciper=""      | ciper text for encryption
     * @param string $passSalt=""   | salt text for encryption
     */
    public function OverrideCredentials($ciper, $passSalt) : FFCrypter {
        $this->cipher = $ciper;
        $this->passSalt = $passSalt;
        return $this;
    }


    /**
     * @param string $data="xxx" |
     * @return string
     */
    public function Encrypt($data): string {
        return @openssl_encrypt($data, $this->cipher, $this->passSalt, 0, 123);
    }

    /**
     * @param string $data="xxx"
     * @return string
     */
    public function Decrypt($data): string {
        return @openssl_decrypt($data, $this->cipher, $this->passSalt, 0, 123);
    }


    /**
     * @return FFCrypter
     */
    public static function cfun() {
        return new FFCrypter();
    }
}
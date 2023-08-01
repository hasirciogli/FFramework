<?php 

namespace app\ffunctions;

class MasterToken {
    private string $secretKey = "your_secret_key";

    /**
     * @param bool $secretKey
     * @return void
     */
    public function __construct($secretKey = false) {
        if($secretKey)
            $this->secretKey = $secretKey;
    }


    /**
     * @return string
     */
    public function generateToken(): string {
        $currentTime = time();
        $interval = 240; // 4 dakika (4 dakika x 60 saniye = 240 saniye)
        $tokenValue = floor($currentTime / $interval); // Her 15 dakikada bir değişen değeri hesapla
        return hash_hmac('sha256', $tokenValue, $this->secretKey); // Değeri hash olarak tut
    }


    /**
     * @param string $token
     * @return bool
     */
    public function validateToken($token): bool {
        return $token == $this->generateToken();
    }


    /**
     * @param bool $dieOnFailed = false
     * @return bool returns -> Validation status
     */
    public function autoValidateToken($dieOnFailed = false) {
        $tvRes = $this->validateToken($_POST["master_token"] ?? "");
        if(!$tvRes && $dieOnFailed)
            die("mValidationFailed");
            
        return $tvRes;
    }

    /**
     * @return MasterToken
     */
    public static function cfun() { return new MasterToken(); }
}
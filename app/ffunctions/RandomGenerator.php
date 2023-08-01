<?php

namespace app\ffunctions;

class RandomGenerator
{

    public function __construct(...$params)
    {
        // ...
    }

    /**
     * @param int $lenght=24 | Max lenght for uniqueId
     * @return string|null
     */
    function generateUniqueId($lenght = 24): string|null
    {
        // uniqid gives 13 chars, but you could adjust it to your needs.
        if (function_exists("random_bytes")) {
            $bytes = random_bytes(ceil($lenght / 2));
        } elseif (function_exists("openssl_random_pseudo_bytes")) {
            $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
        } else {
            return null;
        }
        return substr(bin2hex($bytes), 0, $lenght);
    }

    /**
     * @param string $countryCode ['tr', 'us', 'de', 'uk'], if you want random country, set $countryCode to '-1'
     * @param int $gender [0: male, 1: female], if you want random gender name, set $gender to -1
     * @param bool $includeSurname Include surname if true, exclude surname if false. Default = false.
     * @param int $count How many names to generate? Default = 1
     * @return string|array If count is 1, returns a single name string, otherwise returns an array of generated names
     */
    function generateName(string|int $countryCode, int $gender, $includeSurname = false, $count = 1): string|array
    {
        $userdata = json_decode(file_get_contents(configs_site_rootfolder . "/app/includes/data/user/userdata.json"), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        $names = [];

        if ($countryCode == -1) {
            $countryCodes = ['tr', 'us', 'de', 'uk'];
            $countryCode = $countryCodes[array_rand($countryCodes)];
        }

        if ($gender == -1) {
            $genders = [0, 1];
            $gender = $genders[array_rand($genders)];
        }

        $countryData = $userdata[$countryCode];

        $nameKey = ($gender === 0) ? "boy_name" : "girl_name";
        $surnameKey = "surnames";

        for ($i = 0; $i < $count; $i++) {
            $randomName = '';
            if (isset($countryData[$nameKey])) {
                $randomName = $countryData[$nameKey][array_rand($countryData[$nameKey])];
            }

            $randomSurname = '';
            if ($includeSurname && isset($countryData[$surnameKey])) {
                $randomSurname = $countryData[$surnameKey][array_rand($countryData[$surnameKey])];
            }

            $fullName = $randomName;
            if ($includeSurname) {
                $fullName .= ' ' . $randomSurname;
            }

            if ($count === 1) {
                return $fullName;
            } else {
                $names[] = $fullName;
            }
        }

        return $names;
    }

    /**
     * @param string $countryCode ['tr', 'us', 'de', 'uk'], if you want random country, set $countryCode to '-1'
     * @param int $count How many surnames to generate? Default = 1
     * @return string|array If count is 1, returns a single surname string, otherwise returns an array of generated surnames
     */
    function generateSurname(string|int $countryCode, int $count = 1)
    {
        $userdata = json_decode(file_get_contents(configs_site_rootfolder . "/app/includes/data/user/userdata.json"), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        $surnames = [];

        if ($countryCode == -1) {
            $countryCodes = ['tr', 'us', 'de', 'uk'];
            $countryCode = $countryCodes[array_rand($countryCodes)];
        }

        $countryData = $userdata[$countryCode];
        $surnameKey = "surnames";

        for ($i = 0; $i < $count; $i++) {
            $randomSurname = '';
            if (isset($countryData[$surnameKey])) {
                $randomSurname = $countryData[$surnameKey][array_rand($countryData[$surnameKey])];
            }

            if ($count === 1) {
                return $randomSurname;
            } else {
                $surnames[] = $randomSurname;
            }
        }

        return $surnames;
    }

    /**
     * @param string $firstName First name of the user
     * @param string $lastName Last name of the user
     * @param int $count How many usernames to generate? Default = 1
     * @return string|array If count is 1, returns a single username string, otherwise returns an array of generated usernames
     */
    function generateUsername($firstName, $lastName, $count = 1): string|array
    {
        $firstName = removeTurkishCharacters($firstName);
        $lastName = removeTurkishCharacters($lastName);

        $username = strtolower(substr($firstName, 0, 1) . $lastName);
        $usernames = [];

        if ($count === 1) {
            return $username;
        } else {
            $usernames[] = $username;
        }

        $alphabet = 'abcdefghijklmnopqrstuvwxyz';
        $index = 1;

        while (count($usernames) < $count) {
            $newUsername = strtolower(substr($firstName, 0, 1) . $lastName . $alphabet[$index]);
            if (!in_array($newUsername, $usernames)) {
                $usernames[] = $newUsername;
            }
            $index++;

            if ($index >= strlen($alphabet)) {
                $index = 0;
            }
        }

        return $usernames;
    }

    /**
     * @param string $text Text to remove Turkish characters from
     * @return string Text with Turkish characters removed
     */
    function removeTurkishCharacters($text): string
    {
        $turkishCharacters = array('ç', 'Ç', 'ğ', 'Ğ', 'ı', 'İ', 'ö', 'Ö', 'ş', 'Ş', 'ü', 'Ü');
        $englishCharacters = array('c', 'C', 'g', 'G', 'i', 'I', 'o', 'O', 's', 'S', 'u', 'U');
        return str_replace($turkishCharacters, $englishCharacters, $text);
    }

    public static function cfun(...$cParams): RandomGenerator
    {
        return new RandomGenerator(...$cParams);
    }
}


?>
# FFramework [PHP-Framework]

PHP ile yapılan fir framework. Yeni başlayanlar için kullanışlı!

Kendine has mysql pdo class ile veritabanı işlemlerinizi çok basit bir şekilde halledebilirsiniz örnek:

```PHP
$result = FFDatabase::cfun()->select("users")->where("email", $email)->where("password", $password)->run()->get();
```

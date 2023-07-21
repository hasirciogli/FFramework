<?php

namespace app\database;

use mysql_xdevapi\Exception;
use PDO;
class DB
{
    private $db_host = configs_db_host;
    private $db_name = configs_db_name;
    private $db_username = configs_db_username;
    private $db_password = configs_db_password;

    private PDO|null $connection = null;

    private string $tempSql = "";
    private string $buildedSql = "";

    private function checkDB()
    {
        if($this->connection)
            return $this;

        try {
            $this->connection = new PDO("mysql:host=" . $this->db_host . ";charset=utf8", $this->db_username, $this->db_password);
            return $this;
        } catch (\Exception $e) {
            die("Veritabanı bağlantı hatası");
        }

    }

    private function closeConnection(): void
    {
        if(!$this->connection)
            return;

        $this->connection = null;
    }


    public function use(string $dbName): DB{

        $v = $this->connection->prepare("USE ". $dbName);
        $v->execute([]);
        return $this;
    }
    public function select(string $tableName): DB{

        $this->tempSql = "SELECT * FROM " . $tableName;

        return $this;
    }

    public function where(string $key, string $value): DB{

        if(str_contains($this->tempSql, "WHERE"))
            $this->tempSql = "";
        else
            $this->tempSql = " WHERE";

        return $this;
    }


    public static function cfun()
    {
        return new DB();
    }
}
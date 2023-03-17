<?php

namespace DATABASE;

use mysql_xdevapi\Exception;
use PDO;

class FFDatabase
{
    public $instance = FFDatabase::class;

    private $db_host = configs_db_host;
    private $db_name = configs_db_name;
    private $db_username = configs_db_username;
    private $db_password = configs_db_password;

    public $buildedSQL = "";

    public $where = [];
    public $connection = null;

    public $v = null;
    public $x = null;
    public $result = null;

    public function init()
    {
        try {
            $this->connection = new PDO("mysql:host=" . $this->db_host . ";dbname=" . $this->db_name . ";charset=utf8", $this->db_username, $this->db_password);
        } catch (Exception $e) {
            die("Veritabanı bağlantı hatası");
        }
    }

    public function BuildSQL()
    {
        if ($this->where && count($this->where) > 0) {
            $this->buildedSQL .= " WHERE ";
            $tbl = false;
            foreach ($this->where as $key) {
                if ($tbl) {
                    $this->buildedSQL .= " AND " . $key["key"] . "='" . $key["value"] . "'";
                } else {
                    $this->buildedSQL .= $key["key"] . "='" . $key["value"] . "'";
                }
                $tbl = true;
            }
        }
        return $this;
    }

    // basic sql codes "SELECT * FROM users WHERE id=?";

    public function select($table)
    {
        $this->buildedSQL .= "SELECT * FROM " . $table;

        return $this;
    }

    public function limit($limit)
    {
        $this->buildedSQL .= " LIMIT " . $limit;

        return $this;
    }

    public function orderby($by)
    {
        $this->buildedSQL .= " ORDER BY " . $by;

        return $this;
    }

    public function ASC()
    {
        $this->buildedSQL .= " ASC";

        return $this;
    }

    public function DESC()
    {
        $this->buildedSQL .= " DESC";

        return $this;
    }

    public function insert($table, array $dataset)
    {
        $fup = true;
        $this->buildedSQL .= "INSERT INTO " . $table . " (";

        foreach ($dataset as $item) {
            if ($fup) {
                $this->buildedSQL .= $item[0];
                $fup = false;
            } else {
                $this->buildedSQL .= ", " . $item[0];
            }
        }

        $this->buildedSQL .= ") VALUES (";

        $fup = true;

        foreach ($dataset as $item) {
            if ($fup) {
                $this->buildedSQL .= "'" . $item[1] . "'";
                $fup = false;
            } else {
                $this->buildedSQL .= ", '" . $item[1] . "'";
            }
        }

        $this->buildedSQL .= ")";

        return $this;
    }

    public function update($table, array $dataset)
    {
        $fup = true;
        foreach ($dataset as $item) {
            if ($fup) {
                $this->buildedSQL .= "UPDATE " . $table . " SET " . $item[0] . "='" . $item[1] . "'";
            } else {
                $this->buildedSQL .= ", " . $item[0] . "='" . $item[1] . "'";
            }
            $fup = false;
        }

        return $this;
    }

    public function where($key, $value)
    {
        $this->where[] = [
            "key" => $key,
            "value" => $value
        ];

        return $this;
    }

    public function get(): null|string|array
    {
        if ($this->x) {
            $this->result = $this->v->fetch(PDO::FETCH_ASSOC);
            if ($this->v->rowCount() > 0) {
                return $this->result;
            } else {
                return "no-record";
            }
        } else {
            return false;
        }
    }

    public function getAll(): null|string|array
    {
        if ($this->x) {
            $this->result = $this->v->fetchAll(PDO::FETCH_ASSOC);
            if ($this->v->rowCount() > 0) {
                return $this->result;
            } else {
                return "no-record";
            }
        } else {
            return false;
        }
    }

    public function run()
    {
        $this->BuildSQL();

        $this->v = $this->connection->prepare($this->buildedSQL);
        $this->x = $this->v->execute();

        $this->buildedSQL = "";

        return $this;
    }


    public static function cfun()
    {
        $intent = new FFDatabase();
        $intent->init();
        return $intent;
    }
}


class FFDatabaseInternal
{
    private $db_host = configs_db_host;
    private $db_name = configs_db_name;
    private $db_username = configs_db_username;
    private $db_password = configs_db_password;

    public $connection = null;

    public function init()
    {
        try {
            $this->connection = new PDO("mysql:host=" . $this->db_host . ";dbname=" . $this->db_name . ";charset=utf8", $this->db_username, $this->db_password);
            return $this;
        } catch (Exception $e) {
            die("Veritabanı bağlantı hatası");
        }

    }

    public static function cfun()
    {
        return new FFDatabaseInternal();
    }
}
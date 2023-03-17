<?php

/*
Revised code by Dominick Lee
Original code derived from "Essential PHP Security" by Chriss Shiflett
Last Modified 2/27/2017


CREATE TABLE sessions
(
    id varchar(32) NOT NULL,
    access int(10) unsigned,
    data text,
    PRIMARY KEY (id)
);

+--------+------------------+------+-----+---------+-------+
| Field  | Type             | Null | Key | Default | Extra |
+--------+------------------+------+-----+---------+-------+
| id     | varchar(32)      |      | PRI |         |       |
| access | int(10) unsigned | YES  |     | NULL    |       |
| data   | text             | YES  |     | NULL    |       |
+--------+------------------+------+-----+---------+-------+

*/


/*
Revised code by Dominick Lee
Original code derived from "Run your own PDO PHP class" by Philip Brown
Last Modified 2/27/2017
*/


class SdsenDatabase
{
    private $host = configs_db_host;
    private $user = configs_db_username;
    private $pass = configs_db_password;
    private $dbname = configs_db_name;
    private $dbh;
    private $error;
    private $stmt;

    public function __construct()
    {
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        // Set options
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        // Create a new PDO instanace

        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (Exception $e) {
            die("Veritabanı bağlantı hatası");
        }
    }

    public function query($query)
    {
        $this->stmt = $this->dbh->prepare($query);
    }

    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute()
    {
        return $this->stmt->execute();
    }

    public function resultset()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function rowCount()
    {
        return $this->stmt->rowCount();
    }

    public function lastInsertId()
    {
        return $this->dbh->lastInsertId();
    }

    public function beginTransaction()
    {
        return $this->dbh->beginTransaction();
    }

    public function endTransaction()
    {
        return $this->dbh->commit();
    }

    public function cancelTransaction()
    {
        return $this->dbh->rollBack();
    }

    public function debugDumpParams()
    {
        return $this->stmt->debugDumpParams();
    }

    public function close()
    {
        $this->dbh = null;
    }
}


class SessionsFromMysql
{
    private $db;

    public function __construct()
    {
        // Instantiate new Database object
        $this->db = new SdsenDatabase();

        // Set handler to overide SESSION
        session_set_save_handler(
            array($this, "_open"),
            array($this, "_close"),
            array($this, "_read"),
            array($this, "_write"),
            array($this, "_destroy"),
            array($this, "_gc")
        );

        // Start the session
        session_start();
    }

    public function _open()
    {
        // If successful
        if ($this->db) {
            // Return True
            return true;
        }
        // Return False
        return false;
    }

    public function _close()
    {
        // Close the database connection
        // If successful
        if ($this->db->close()) {
            // Return True
            return true;
        }
        // Return False
        return false;
    }

    public function _read($id)
    {
        // Set query
        $this->db->query('SELECT data FROM sessions WHERE id = :id');
        // Bind the Id
        $this->db->bind(':id', $id);
        // Attempt execution
        // If successful
        if ($this->db->execute()) {
            if ($this->db->rowCount() > 0) {
                // Save returned row
                $row = $this->db->single();
                // Return the data
                return $row['data'];
            }
        }
        // Return an empty string
        return '';
    }

    public function _write($id, $data)
    {
        // Create time stamp
        $access = time();
        // Set query
        $this->db->query('REPLACE INTO sessions VALUES (:id, :access, :data)');
        // Bind data
        $this->db->bind(':id', $id);
        $this->db->bind(':access', $access);
        $this->db->bind(':data', $data);
        // Attempt Execution
        // If successful
        if ($this->db->execute()) {
            // Return True
            return true;
        }
        // Return False
        return false;
    }

    public function _destroy($id)
    {
        // Set query
        $this->db->query('DELETE FROM sessions WHERE id = :id');
        // Bind data
        $this->db->bind(':id', $id);
        // Attempt execution
        // If successful
        if ($this->db->execute()) {
            // Return True
            return true;
        }
        // Return False
        return false;
    }

    public function _gc($max)
    {
        // Calculate what is to be deemed old
        $old = time() - $max;
        // Set query
        $this->db->query('DELETE FROM sessions WHERE access < :old');
        // Bind data
        $this->db->bind(':old', $old);
        // Attempt execution
        if ($this->db->execute()) {
            // Return True
            return true;
        }
        // Return False
        return false;
    }
}

?>
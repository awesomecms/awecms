<?php
/**
 * Project: awecms.
 * User: jens
 * Date: 01.07.17
 * Time: 00:15
 */

namespace modules\mysqlengine;

use PDO;
use PDOException;

class Database
{
    private $host;
    private $user;
    private $pass;
    private $dbname;

    private $dbh;
    private $error;
    /**
     * @var \PDOStatement
     */
    private $stmt;

    public function __construct($config)
    {
        $this->host = $config["host"];
        $this->user = $config["user"];
        $this->pass = $config["password"];
        $this->dbname = $config["database"];
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
        } // Catch any errors
        catch (PDOException $e) {
            $this->error = $e->getMessage();
            var_dump($this->error);
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

    public function getAll()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function execute()
    {
        return $this->stmt->execute();
    }

    public function getOne()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function count()
    {
        return $this->stmt->rowCount();
    }

    public function getID()
    {
        return $this->dbh->lastInsertId();
    }
}

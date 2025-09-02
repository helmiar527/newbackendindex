<?php

namespace App\Systems;


class Database
{
  // Definisikan konstanta
  private $host = DB_HOST;
  private $user = DB_USER;
  private $pass = DB_PASS;
  private $db_name = DB_NAME;
  private $dbh;
  private $stmt;

  // Testing connect
  public function __construct()
  {
    $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name;
    $option = [
      \PDO::ATTR_PERSISTENT => true,
      \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
    ];
    try {
      $this->dbh = new \PDO($dsn, $this->user, $this->pass, $option);
    } catch (\PDOException $e) {
      die($e->getMessage());
    }
  }

  // Process query
  public function query($query)
  {
    $this->stmt = $this->dbh->prepare($query);
  }

  // Process bind value
  public function bind($param, $value, $type = null)
  {
    if (is_null($type)) {
      switch (true) {
        case is_int($value):
          $type = \PDO::PARAM_INT;
          break;
        case is_bool($value):
          $type = \PDO::PARAM_BOOL;
          break;
        case is_null($value):
          $type = \PDO::PARAM_NULL;
          break;
        default:
          $type = \PDO::PARAM_STR;
      }
    }
    $this->stmt->bindValue($param, $value, $type);
  }

  // Process execute
  public function execute()
  {
    $this->stmt->execute();
  }

  // Process result set to all
  public function resultSet()
  {
    $this->execute();
    return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
  }

  // Process result set to single
  public function single()
  {
    $this->execute();
    return $this->stmt->fetch(\PDO::FETCH_ASSOC);
  }

  // Process result to row count
  public function rowCount()
  {
    return $this->stmt->rowCount();
  }
}

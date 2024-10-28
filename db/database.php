<?php
class Database
{
  public $servername = "localhost";
  public $username = "root";
  public $password = "";
  public $dbname = "sportstore";
  public $connection;

  public function __construct()
  {
    $this->connectDB();
  }
  public function connectDB()
  {
    $this->connection = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
    $this->connection->set_charset("utf8");
    if ($this->connection->connect_error) {
      die("Connection failed: " . $this->connection->connect_error);
    }
  }
  // insert, update, delete
  public function execute($sql)
  {
    $this->connection->query($sql);
  }

  // select
  public function executeResult($sql, $isSingle = false)
  {
    $data = null;
    $resultSet = $this->connection->query($sql);
    if ($isSingle) { // lay 1 ban ghi
      $data = $resultSet->fetch_assoc();
    } else { // lay danh sach
      $data = [];
      while ($row = $resultSet->fetch_assoc()) {
        $data[] = $row;
      }
    }
    return $data;
  }
  public function executeSingleResult($sql) {
    $result = $this->connection->query($sql);

    if ($result === false) {
        die("SQL Error: " . $this->connection->error);
    }

    $row = $result->fetch_assoc();

    $result->free_result();

    return $row;
}
public function getTotalPages($sqlCount, $itemsPerPage) {
  $totalItems = $this->executeSingleResult($sqlCount)['total'];
  return ceil($totalItems / $itemsPerPage);
}
}


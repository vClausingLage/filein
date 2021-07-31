<?php

class DbConn
{
  private $servername;
  private $username;
  private $password;
  private $dbname;
  private $charset;

  public function connect()
  {
    $this->servername = 'localhost';
    $this->username = 'root';
    $this->password = 'pwd';
    $this->dbname = 'newdb';
    $this->charset = 'utf8mb4';

    try {
      $dsn = 'mysql:host=' . $this->servername . ';dbname=' . $this->dbname . ';charset=' . $this->charset;
      $pdo = new PDO($dsn, $this->username, $this->password);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      //echo 'conn established';
      return $pdo;
    } catch (PDOException $e) {
      echo 'Conn failed: ' . $e->getMessage();
    }
  }
}

class Posts extends DbConn
{
  public function getPosts()
  {
    $sql = 'SELECT * FROM test';
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute(); // [] if Array
    $results = $stmt->fetchAll();
    echo '<p>';
    foreach ($results as $result) {
      echo $result['id'] . ' ' . $result['name'] . '<br>';
    }
    echo '</p>';
  }
}

?>
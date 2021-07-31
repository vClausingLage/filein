<?php

// https://www.tutsmake.com/php-code-insert-data-into-mysql-database-from-form/

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
    $this->username = 'username';
    $this->password = 'pwd';
    $this->dbname = 'dbname';
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
  public function getPostsPrepared()
  {
    $sql = 'SELECT * FROM test';
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute(); // [] if Array
    $results = $stmt->fetchAll();
    echo '<p>';
    foreach ($results as $result) {
      echo $result['time'] . ' ' . $result['id'] . '<br>';
    }
    echo '</p>';
  }
}
?>
<?php

define('SERVER', 'localhost');
define('DBNAME', 'delivery');
define('USER', 'deliveryadmin');
define('PWORD', 'abc123');

class Connection
{
  protected $con_string =
    'mysql:host=' . SERVER . ';dbname=' . DBNAME . ';charset=utf8mb4';
  protected $options = [
    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
    \PDO::ATTR_EMULATE_PREPARES => false,
  ];
  
  public function connect()
  {
    return new \PDO($this->con_string, USER, PWORD, $this->options);
  }
}

?>

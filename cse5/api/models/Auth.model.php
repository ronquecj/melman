<?php
class Auth
{
  protected $gm, $pdo;

  public function __construct(\PDO $pdo, $gm)
  {
    $this->pdo = $pdo;
    $this->gm = $gm;
  }
}

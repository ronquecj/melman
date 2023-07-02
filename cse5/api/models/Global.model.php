<?php
class GlobalMethods
{
  protected $gm, $pdo;

  public function __construct(\PDO $pdo)
  {
    $this->pdo = $pdo;
  }

  public function getAll($sql)
  {
    $stmt = $this->pdo->prepare($sql);

    try {
      $stmt->execute();
      if ($stmt->rowCount() > 0) {
        if ($res = $stmt->fetchAll()) {
          $msg = 'SUccess';
          $code = 200;
          $remarks = 'sucs';
          $data = $res;
        }
      }
    } catch (\PDOException $e) {
    }
    return ['payload' => $data];
  }

  public function getData($sql, $id = null)
  {
    if ($id == null) {
      $stmt = $this->pdo->prepare($sql);

      try {
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
          if ($res = $stmt->fetchAll()) {
            $msg = 'SUccess';
            $code = 200;
            $remarks = 'sucs';
            $data = $res;
          }
        }
      } catch (\PDOException $e) {
        return $e->getMessage();
      }
      return ['payload' => $data];
    } else {
      $stmt = $this->pdo->prepare($sql);

      try {
        $stmt->execute([$id]);
        if ($stmt->rowCount() > 0) {
          if ($res = $stmt->fetch()) {
            $msg = 'SUccess';
            $code = 200;
            $remarks = 'sucs';
            $data = $res;
          }
        }
      } catch (\PDOException $e) {
        return $e->getMessage();
      }
      return ['payload' => $data];
    }
  }

  function callNoData($proc)
  {
    $data = null;
    $msg = 'Unable to retrieve records';
    $code = 400;
    $remarks = 'failed';

    $sql = 'CALL ' . $proc . '()';

    $stmt = $this->pdo->prepare($sql);

    try {
      $stmt->execute();
      if ($stmt->rowCount() > 0) {
        if ($res = $stmt->fetchAll()) {
          $msg = 'SUccess';
          $code = 200;
          $remarks = 'sucs';
          $data = $res;
        }
      }
    } catch (\PDOException $e) {
      return $e->getMessage();
    }
    return ['payload' => $data];
  }

  function callWithData($proc, $d)
  {
    $data = null;
    $msg = 'Unable to retrieve records';
    $code = 400;
    $remarks = 'failed';
    $dt = $d->payload;
    $values = [];

    foreach ($dt as $key => $value) {
      array_push($values, $value);
    }

    $sql =
      'CALL ' .
      $proc .
      '(' .
      str_repeat('?, ', count($values) - 1) .
      ' ?)';
    $stmt = $this->pdo->prepare($sql);

    try {
      $stmt->execute($values);
      if ($stmt->rowCount() > 0) {
        if ($res = $stmt->fetchAll()) {
          $msg = 'SUccess';
          $code = 200;
          $remarks = 'sucs';
          $data = $res;
        }
      }
    } catch (\PDOException $e) {
      return $e->getMessage();
    }
    return ['payload' => $data];
  }
}

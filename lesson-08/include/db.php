<?php

  function _dbConnect() {
    static $connect;
    if (!isset($connect)) {
      $connect = mysqli_connect(_DB_HOST_, _DB_USER_, _DB_PASS_, _DB_NAME_) or die('DB connect error');
    }
    return $connect;
  }

  function dbP($data) {
    foreach ($data as $k => $v) {
      $data[$k] = '`'.$k.'` = \''.dbEsc($v).'\'';
    }
    return $data;
  }

  function dbEsc($value) {
    return mysqli_escape_string(_dbConnect(), $value);
  }

  function dbQ($sql) {
    $result = mysqli_query(_dbConnect(), $sql);
    if (!$result) {
      if (_DEBUG_) {
        echo mysqli_error(_dbConnect());
        exit();
      }
      trigger_error('DB: '.mysqli_error(_dbConnect()));
    }
    return $result;
  }

  function dbInsert($table, $data) {
    $sql = 'INSERT INTO `'.dbEsc($table).'`
      SET '.implode(', ', dbP($data));
    if (dbQ($sql)) {
      return mysqli_insert_id(_dbConnect());
    }
    return false;
  }

  function dbUpdate($table, $id, $data) {
    $sql = 'UPDATE `'.dbEsc($table).'`
      SET '.implode(', ', dbP($data)).'
      WHERE id = '.(int)$id;
    if (dbQ($sql)) {
      return mysqli_affected_rows(_dbConnect()) > 0 ? true : null;
    }
    return false;
  }

  function dbRows($sql, $key = null) {
    $data = [];
    if ($res = dbQ($sql)) {
      while ($r = mysqli_fetch_assoc($res)) {
        if ($key !== null && array_key_exists($key, $r)) {
          $data[$r[$key]] = $r;
        } else {
          $data[] = $r;
        }
      }
    }
    return $data;
  }

  function dbRow($sql) {
    if ($res = dbQ($sql)) {
      if ($r = mysqli_fetch_assoc($res)) {
        return $r;
      }
    }
    return [];
  }

  function dbValues($sql, $key = null) {
    $data = [];
    if ($res = dbQ($sql)) {
      while ($r = mysqli_fetch_assoc($res)) {
        if ($key !== null && array_key_exists($key, $r)) {
          $data[$r[$key]] = array_shift($r);
        } else {
          $data[] = array_shift($r);
        }
      }
    }
    return $data;
  }

?>
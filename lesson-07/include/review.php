<?php

  function reviewSave($id, $data, &$errors = []) {
    $id = intval($id);
    $data = (array)$data;
    $errors = [];

    $item = _reviewValidate($id, $data, $errors);

    if (!$errors) {
      if ($id) {
        if (dbUpdate('review', $id, $item)) {
          return true;
        }
      } else {
        if ($_id = dbInsert('review', $item)) {
          return $_id;
        }
      }
    }

    if (!$errors) {
      $errors[] = 'Сбой сервера';
    }
    return false;
  }

  function _reviewValidate($id, $data, &$errors = []) {
    $item = [];
    $item['user_name'] = trim(strip_tags($data['user_name'] ?? ''));
    if ($item['user_name'] === '') {
      $errors[] = 'Укажите Ваше имя';
    }
    $item['text'] = trim(strip_tags($data['text'] ?? ''));
    if ($item['text'] === '') {
      $errors[] = 'Не задат текст отзыва';
    }
    return $item;
  }

  function reviewGetList() {
    return dbRows('SELECT * FROM review');
  }

  function reviewGet($id) {
    return dbRow('SELECT *
      FROM review WHERE id = '.(int)$id.'
      LIMIT 1');
  }

  function reviewDelete($id) {
    $sql = 'DELETE FROM review WHERE id = '.(int)$id;
    return dbQ($sql);
  }

?>
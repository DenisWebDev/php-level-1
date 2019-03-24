<?php

  function userRegister($data, &$errors = []) {
    $data = (array)$data;
    $errors = [];

    $item = _userValidateRegistration($data, $errors);

    if (!$errors) {
      $item['password'] = password_hash($item['password'], PASSWORD_DEFAULT);
      if ($_id = dbInsert('user', $item)) {
        sessionSet('id_user', $_id);
        sessionSet('password', $item['password']);
        mergeCart();
        return $_id;
      }
    }

    if (!$errors) {
      $errors[] = 'Сбой сервера';
    }
    return false;
  }

  function _userValidateRegistration($data, &$errors = []) {
    $item = [];
    $item['name'] = trim(strip_tags($data['name'] ?? ''));
    if ($item['name'] === '') {
      $errors[] = 'Укажите Ваше имя';
    }
    $item['email'] = trim(strip_tags($data['email'] ?? ''));
    if ($item['email'] === '') {
      $errors[] = 'Укажите Ваш email';
    } elseif (!filter_var($item['email'], FILTER_VALIDATE_EMAIL)) {
      $errors[] = 'Укажите правильный email';
    } else {
      $sql = 'SELECT 1 FROM user
        WHERE email = \''.dbEsc($item['email']).'\'
        LIMIT 1';
      if (dbRow($sql)) {
        $errors[] = 'Данный email уже используется';
      }
    }

    $item['password'] = $data['password'] ?? '';
    if ($item['password'] === '') {
      $errors[] = 'Укажите Ваш пароль';
    }

    return $item;
  }

  function userGet($id) {
    return dbRow('SELECT *
      FROM user WHERE id = '.(int)$id.'
      LIMIT 1');
  }

  function currentUser() {
    if ($_id = sessionGet('id_user')) {
      return userGet($_id);
    }
    return false;
  }

  function userId() {
    return (int)sessionGet('id_user');
  }

  function userIsLogin() {
    if ($user = currentUser()) {
      if (sessionGet('password') == $user['password']) {
        return true;
      }
      userLogout();
    }
    return false;
  }

  function isAdmin($user = null) {
    if ($user === null) {
      $user = currentUser();
    }
    return ($user && $user['role'] == _USER_ROLE_ADMIN_);
  }

  function userLogin($data, &$errors = []) {
    $data = (array)$data;
    $errors = [];

    $email = trim(strip_tags($data['email'] ?? ''));
    if ($email === '') {
      $errors[] = 'Укажите Ваш email';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors[] = 'Укажите правильный email';
    }
    $password = $data['password'] ?? '';
    if ($password === '') {
      $errors[] = 'Укажите Ваш пароль';
    }

    if (!$errors) {
      $sql = 'SELECT
          id,
          password
        FROM user
        WHERE email = \''.dbEsc($email).'\'
        LIMIT 1';
      if ($user = dbRow($sql)) {
        if (password_verify($password, $user['password'])) {
          sessionSet('id_user', $user['id']);
          sessionSet('password', $user['password']);
          mergeCart();
          return true;
        }
      }
      $errors[] = 'Неправильный email или пароль';
    }

    return false;
  }

  function userLogout() {
    sessionUnset('id_user');
    sessionUnset('password');
  }


?>
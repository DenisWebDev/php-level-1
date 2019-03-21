<?php

  function _esc($v) {
    return htmlentities($v, ENT_COMPAT, 'utf-8');
  }

  function _d($var) {
    echo '<pre>';
    if (is_bool($var) or is_null($var)) {
      var_dump($var);
    } else {
      print_r($var);
    }
    echo '</pre>';
  }

  function message($messages, $type) {
    $session = sessionGet('messages', [
      'error' => [],
      'success' => [],
    ]);
    if (!is_array($messages)) {
      $messages = [$messages];
    }
    foreach ($messages as $message) {
      $session[$type][] = $message;
    }
    sessionSet('messages', $session);
  }

  function getMessagesToPrint() {
    $messages = sessionGet('messages');
    if ($messages) {
      sessionUnset('messages');
      return array_filter($messages);
    }
    return [];
  }

  function redirect($url = null) {
    if ($url === null) {
      $url = $_SERVER['REQUEST_URI'];
    }
    header('Location: '.$url);
    exit();
  }

  function isReqPost($key) {
    return array_key_exists($key, $_POST);
  }

  function reqPost($key, $default = false) {
    return $_POST[$key] ?? $default;
  }

  function reqGet($key, $default = false) {
    return $_GET[$key] ?? $default;
  }

  function sessionGet($key, $default = false) {
    if (!session_id()) {
      session_start();
    }
    return $_SESSION[$key] ?? $default;
  }

  function sessionSet($key, $value) {
    if (!session_id()) {
      session_start();
    }
    $_SESSION[$key] = $value;
  }

  function sessionUnset($key) {
    unset($_SESSION[$key]);
  }

  function restrictedAccess() {
    message('У Вас нет доступа к данной странице', 'error');
    redirect(userIsLogin()  ? '/profile.php' : '/login.php');
  }

?>
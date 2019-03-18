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
    if (!isset($_SESSION['messages'])) {
      $_SESSION['messages'] = [
        'error' => [],
        'success' => [],
      ];
    }
    if (!is_array($messages)) {
      $messages = [$messages];
    }
    foreach ($messages as $message) {
      $_SESSION['messages'][$type][] = $message;
    }
  }

  function getMessagesToPrint() {
    if (isset($_SESSION['messages'])) {
      $messages = $_SESSION['messages'];
      unset($_SESSION['messages']);
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

?>
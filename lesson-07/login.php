<?php
  require_once '_init.php';

  if (userIsLogin()) {
    redirect('/profile.php');
  }

  if (isReqPost('login')) {
   if (userLogin($_POST, $errors)) {
      redirect('/profile.php');
    }
    message($errors, 'error');
  }

  tplSet('controller', 'login');
  tplSet('meta_title', 'Вход');

  render('login');

?>
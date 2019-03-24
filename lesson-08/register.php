<?php
  require_once '_init.php';

  if (userIsLogin()) {
    redirect('/profile.php');
  }

  if (isReqPost('register')) {
   if (userRegister($_POST, $errors)) {
      redirect('/profile.php');
    }
    message($errors, 'error');
  }

  tplSet('controller', 'register');
  tplSet('meta_title', 'Регистрация');

  render('register');

?>
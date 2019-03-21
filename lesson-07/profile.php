<?php
  require_once '_init.php';

  if (!userIsLogin()) {
    restrictedAccess();
  }

  if (reqGet('action') == 'logout') {
    userLogout();
    redirect('/');
  }

  tplSet('controller', 'profile');
  tplSet('meta_title', 'Личный кабинет');

  tplSet('user', currentUser()); 

  render('profile');

?>
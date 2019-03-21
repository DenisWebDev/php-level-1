<?php
  require_once '_init.php';

  tplSet('controller', 'index');
  tplSet('meta_title', 'Главная');

  tplSet('products', productGetList());

  render('index');
?>
<?php
  require_once '_init.php';

  tplSet('controller', 'index');
  tplSet('meta_title', 'Главная');

  $products = productGetList();
  productLoadDiscounts($products);

  tplSet('products', $products);

  render('index');
?>
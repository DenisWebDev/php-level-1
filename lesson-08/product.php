<?php
  require_once '_init.php';

  $product = productGet((int)reqGet('id'));

  if (!$product) {
    notfound();
  }

  tplSet('controller', 'product');
  tplSet('meta_title', $product['name']);

  tplSet('product', $product);

  render('product');

?>
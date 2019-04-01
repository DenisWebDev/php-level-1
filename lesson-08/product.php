<?php
  require_once '_init.php';

  $product = productGet((int)reqGet('id'));

  if (!$product) {
    notfound();
  }

  tplSet('controller', 'product');
  tplSet('meta_title', $product['name']);

  $temp = [$product];
  productLoadDiscounts($temp);
  $product = reset($temp);

  tplSet('product', $product);

  render('product');

?>
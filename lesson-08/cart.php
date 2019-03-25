<?php
  require_once '_init.php';

  if (reqGet('action') == 'add') {
    if (cartAddProduct(reqPost('id_product'), reqPost('quantity'))) {
      $res = ['result' => 1];
    } else {
      $res = ['result' => 0, 'errorMessage' => 'Сбой сервера'];
    }
    renderJson($res);
  }

  if (reqGet('action') == 'delete') {
    if (cartDeleteProduct(reqPost('id_product'))) {
      tplSet('products', cartGetProducts());
      $res = ['result' => 1, 'html' => module('cart_module')];
    } else {
      $res = ['result' => 0, 'errorMessage' => 'Сбой сервера'];
    }
    renderJson($res);
  }

  tplSet('controller', 'cart');
  tplSet('meta_title', 'Корзина покупок');

  tplSet('products', cartGetProducts());

  render('cart');

?>
<?php

  function cartAddProduct($id_product, $quantity) {
    $id_product = (int)$id_product;
    $quantity = (int)$quantity;
    if ($id_product > 0 && $quantity > 0) {
      if (userIsLogin()) {
        $sql = 'INSERT INTO cart
          SET
            id_user = '.(int)userId().',
            id_product = '.(int)$id_product.',
            quantity = '.(int)$quantity.'
          ON DUPLICATE KEY UPDATE
            quantity = quantity + '.(int)$quantity;
        dbQ($sql);
      } else {
        $cart = getCartFromCookies();
        if (array_key_exists($id_product, $cart)) {
          $cart[$id_product] += $quantity;
        } else {
          $cart[$id_product] = $quantity;
        }
        saveCartInCookie($cart);
      }
      return true;
    }
    return false;
  }

  function getCartFromCookies() {
    if (!empty($_COOKIE['cart'])) {
      if ($cart = json_decode($_COOKIE['cart'], true)) {
        return $cart;
      }
    }
    return [];
  }

  function saveCartInCookie($cart) {
    $cart = $cart ? json_encode($cart) : '';
    setcookie('cart', $cart, time() + 60*60*24*365);
  }

  function mergeCart() {
    foreach (getCartFromCookies() as $id_product => $quantity) {
      cartAddProduct($id_product, $quantity);
    }
    saveCartInCookie([]);
  }

?>
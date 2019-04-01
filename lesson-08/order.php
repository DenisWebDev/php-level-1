<?php
  require_once '_init.php';

  $solt = 'hRCLfzXBRe9r2dopuJsmCa28wh1jZX';

  tplSet('controller', 'order');

  if (isReqGet('id')) {
    $id_order = (int)reqGet('id');
    if (md5($solt.$id_order) == reqGet('hash')) {
      $order = orderGet($id_order, true);
      if ($order) {
        tplSet('order', $order);
        tplSet('meta_title', 'Заказ #'.$id_order);
        render('order_details');
      }
    }
    message('Заказ не найден', 'error');
    redirect('/');
  } else {
    $products = cartGetProducts();
    if (!$products) {
      redirect('/cart.php');
    }

    if (userIsLogin()) {
      dbQ('START TRANSACTION');
      $order = [
        'id_user' => userId(),
        'product_sum' => 0
      ];
      $id_order = dbInsert('order', $order);
      foreach ($products as $v) {
        $order_product = [
          'id_order' => $id_order,
          'id_product' => $v['id'],
          'price' => $v['price'],
          'quantity' => $v['quantity'],
        ];
        dbInsert('order_product', $order_product);
        cartDeleteProduct($order_product['id_product']);
        $order['product_sum'] += ($v['price'] * $v['quantity']);
      }
      dbUpdate('order', $id_order, ['product_sum' => $order['product_sum']]);
      dbQ('COMMIT');
      redirect('/order.php?id='.$id_order.'&hash='.md5($solt.$id_order));
    }

    if (isReqPost('order')) {
      $order = [];
      $errors = [];

      $order['user_name'] = trim(strip_tags(reqPost('user_name')));
      if ($order['user_name'] === '') {
        $errors[] = 'Укажите Ваше имя';
      }
      $order['user_email'] = trim(strip_tags(reqPost('user_email')));
      if ($order['user_email'] === '') {
        $errors[] = 'Укажите Ваш email';
      } elseif (!filter_var($order['user_email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Укажите правильный email';
      }

      if (!$errors) {
        $order['product_sum'] = 0;
        $id_order = dbInsert('order', $order);
        foreach ($products as $v) {
          $order_product = [
            'id_order' => $id_order,
            'id_product' => $v['id'],
            'price' => $v['price'],
            'quantity' => $v['quantity'],
          ];
          dbInsert('order_product', $order_product);
          cartDeleteProduct($order_product['id_product']);
          $order['product_sum'] += ($v['price'] * $v['quantity']);
        }
        dbUpdate('order', $id_order, ['product_sum' => $order['product_sum']]);
        dbQ('COMMIT');
        redirect('/order.php?id='.$id_order.'&hash='.md5($solt.$id_order));
      }

      message($errors, 'error');

    }

    tplSet('meta_title', 'Оформление заказа');
    render('order');
  }

?>
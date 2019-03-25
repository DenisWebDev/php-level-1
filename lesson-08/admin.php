<?php
  require_once '_init.php';

  if (!userIsLogin() or !isAdmin()) {
    restrictedAccess();
  }

  $action = trim(reqGet('action', 'index'));
  $f = 'action'.implode(array_map('ucfirst', explode('-', $action)));

  if (function_exists($f)) {
    call_user_func($f);
  } else {
    notfound();
  }

  tplSet('controller', 'admin');

  function actionIndex() {
    tplSet('meta_title', 'Каталог товаров');

    $products = productGetList();
    productLoadDiscounts($products);

    tplSet('products', $products);

    render('admin_index');
  }

  function actionOrdersList() {
    tplSet('meta_title', 'Заказы');

    $orders = orderGetList();

    tplSet('orders', $orders);

    render('admin_orders');
  }

  function actionOrderDetails() {
    $id = (int)reqGet('id');

    if (isReqPost('status')) {
      $sql = 'UPDATE `order`
        SET status = '.(int)reqPost('status').'
        WHERE id = '.(int)$id;
      dbQ($sql);
      message('Статус изменен', 'success');
      redirect('/admin.php?action=order-details&id='.$id);
    }

    $order = orderGet($id, true);
    if (!$order) {
      notfound();
    }
    tplSet('order', $order);

    tplSet('meta_title', 'Заказ #'.$id);

    render('admin_order_details');
  }

  function actionProductForm() {
    $id = (int)reqGet('id');

    if (isReqPost('save')) {
      if ($res = productSave($id, $_POST, $errors)) {
        message('Данные товара сохранены', 'success');
        redirect('/admin.php');
      }
      message($errors, 'error');
    }

    tplSet('id', $id);

    if ($id) {
      $data = productGet($id);
      if (!$data) {
        notfound();
      }
      tplSet('data', $data);
    }

    if ($id) {
      tplSet('meta_title', 'Редактирование товара ID '.$id);
    } else {
      tplSet('meta_title', 'Новый товар');
    }

    render('admin_product_form');
  }

  function actionProductDelete() {
    productDelete((int)reqGet('id'));
    message('Товар удален', 'green');
    redirect('/admin.php');
  }

?>
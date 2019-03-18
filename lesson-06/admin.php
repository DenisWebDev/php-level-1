<?php
  require_once '_init.php';

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

    tplSet('products', productGetList());

    render('admin_index');
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
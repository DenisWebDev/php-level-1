<?php

  function productSave($id, $data, &$errors = []) {
    $id = intval($id);
    $data = (array)$data;
    $errors = [];

    $item = _productValidate($id, $data, $errors);

    if (!empty($_FILES['image']['name'])) {
      if (!$errors) {
        $item['image'] = imageLoad($_FILES['image']);
        if (!$item['image']) {
          $errors[] = 'Ошибка загрузки картинки';
        }
      }
    } elseif (!$id) {
      $errors[] = 'Не задана картинка';
    }

    if (!$errors) {
      if ($id) {
        if (dbUpdate('product', $id, $item)) {
          return true;
        }
      } else {
        if ($_id = dbInsert('product', $item)) {
          return $_id;
        }
      }
    }

    if (!$errors) {
      $errors[] = 'Сбой сервера';
    }
    return false;
  }

  function _productValidate($id, $data, &$errors = []) {
    $item = [];
    $item['name'] = trim(strip_tags($data['name'] ?? ''));
    if ($item['name'] === '') {
      $errors[] = 'Не задано название товара';
    }
    $item['description'] = trim(strip_tags($data['description'] ?? ''));
    if ($item['description'] === '') {
      $errors[] = 'Не задано описание товара';
    }
    $item['price'] = intval($data['price'] ?? 0);
    if ($item['price'] <= 0) {
      $errors[] = 'Не задана цена товара';
    }
    return $item;
  }

  function productGetList() {
    return dbRows('SELECT * FROM product');
  }

  function productGet($id) {
    return dbRow('SELECT *
      FROM product WHERE id = '.(int)$id.'
      LIMIT 1');
  }

  function productDelete($id) {
    $sql = 'DELETE FROM product WHERE id = '.(int)$id;
    return dbQ($sql);
  }

  function productLoadDiscounts(&$products) {
    $ids = [];
    foreach ($products as $v) {
      $ids[] = $v['id'];
    }

    $dics = [];
    if ($ids) {
      $sql = 'SELECT discount, id_product FROM product_discount
        WHERE id_product IN ('.implode(', ', array_map('trim', $ids)).')
        AND date_from <= \''.date('Y-m-d H:i:s').'\'
        AND date_to >= \''.date('Y-m-d H:i:s').'\'';
      $dics = dbValues($sql, 'id_product');
    }

    foreach ($products as &$product) {
      $product['discount'] = array_key_exists($product['id'], $dics)
        ? $dics[$product['id']] : 0;
      if ($product['discount'] > 0) {
        $product['old_price'] = $product['price'];
        $product['price'] = round($product['price']*(1 - $product['discount']/100));
      }
    }

  }

?>
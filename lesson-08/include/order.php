<?php

  function orderGet($id, $load_products = false) {
    $order = dbRow('SELECT o.*,
        IFNULL(o.user_name, u.name) AS user_name,
        IFNULL(o.user_email, u.email) AS user_email
      FROM `order` AS o
      LEFT JOIN user AS u ON u.id = o.id_user
      WHERE o.id = '.(int)$id);
    if ($order && $load_products) {
      $sql = 'SELECT
          op.*,
          p.name,
          p.image,
          p.description
        FROM order_product AS op
        LEFT JOIN product AS p ON p.id = op.id_product
        WHERE op.id_order = '.(int)$id;
      $order['products'] = dbRows($sql);
    }
    return $order;
  }

  function orderGetList() {
    return dbRows('SELECT
        o.*,
        IFNULL(o.user_name, u.name) AS user_name,
        IFNULL(o.user_email, u.email) AS user_email
      FROM `order` AS o
      LEFT JOIN user AS u ON u.id = o.id_user
    ');
  }

  function orderGetStatusList() {
    return [
      0 => 'Новый',
      1 => 'В работе',
      2 => 'Завершен',
      3 => 'Отменен'
    ];
  }

  function orderGetStatus($id) {
    $data = orderGetStatusList();
    return array_key_exists($id, $data) ? $data[$id] : false;
  }

?>
<?php
  require_once '_init.php';

  tplSet('controller', 'index');
  tplSet('meta_title', '�������');

  tplSet('products', productGetList());

  render('index');

?>
<?php
  require_once '_init.php';

  if ($operation = reqPost('operation')) {
    $num1 = (float)reqPost('num1');
    $num2 = (float)reqPost('num2');
    switch ($operation) {
      case '+':
        message($num1.' + '.$num2.' = '.($num1 + $num2), 'success');
        break;
      case '-':
        message($num1.' - '.$num2.' = '.($num1 - $num2), 'success');
        break;
      case '*':
        message($num1.' * '.$num2.' = '.($num1 * $num2), 'success');
        break;
      case '/':
        message($num1.' / '.$num2.' = '.($num2 != 0 ? $num1 / $num2 : 0), 'success');
        break;
      default:
        message('Операция не поддерживается', 'error');
    }
    redirect();
  }

  tplSet('controller', 'calculator');
  tplSet('meta_title', 'Калькулятор');

  render('calculator');

?>
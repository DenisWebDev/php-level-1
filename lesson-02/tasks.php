<?php
  /*
    1. Объявить две целочисленные переменные $a и $b и задать им произвольные
    начальные значения. Затем написать скрипт, который работает по следующему
    принципу:
    если $a и $b положительные, вывести их разность;
    если $а и $b отрицательные, вывести их произведение;
    если $а и $b разных знаков, вывести их сумму;
    ноль можно считать положительным числом.
  */

  echo '<h1>1</h1>';

  $a = rand(0, 100) - 50;
  $b = rand(0, 100) - 50;

  echo '$a: '.$a.'<br>';
  echo '$b: '.$b.'<br>';

  if ($a >= 0 && $b >= 0) {
    echo '$a - $b = ';
    echo $a - $b;
  } elseif ($a < 0 && $b < 0) {
    echo '$a * $b = ';
    echo $a * $b;
  } else {
    echo '$a + $b = ';
    echo $a + $b;
  }

  /*
    2. Присвоить переменной $а значение в промежутке [0..15].
    С помощью оператора switch организовать вывод чисел от $a до 15.
  */
  echo '<h1>2</h1>';

  $a = rand(0, 15);
  echo '$a: '.$a.'<br>';

  switch ($a) {
    case 0:
      echo '0, ';
    case 1:
      echo '1, ';
    case 2:
      echo '2, ';
    case 3:
      echo '3, ';
    case 4:
      echo '4, ';
    case 5:
      echo '5, ';
    case 6:
      echo '6, ';
    case 7:
      echo '7, ';
    case 8:
      echo '8, ';
    case 9:
      echo '9, ';
    case 10:
      echo '10, ';
    case 11:
      echo '11, ';
    case 12:
      echo '12, ';
    case 13:
      echo '13, ';
    case 14:
      echo '14, ';
    case 15:
      echo '15';
  }

  /*
    3. Реализовать основные 4 арифметические операции в виде функций с двумя параметрами.
    Обязательно использовать оператор return.
  */

  echo '<h1>3</h1>';

  function _summ($a, $b) {
    return $a + $b;
  }

  function _subt($a, $b) {
    return $a - $b;
  }

  function _mult($a, $b) {
    return $a * $b;
  }

  function _divd($a, $b) {
    return $b != 0 ? $a / $b : false;
  }

  $a = rand(0, 100) - 50;
  $b = rand(0, 100) - 50;
  echo '$a: '.$a.'<br>';
  echo '$b: '.$b.'<br>';
  echo '_summ($a, $b) = '._summ($a, $b).'<br>';
  echo '_subt($a, $b) = '._subt($a, $b).'<br>';
  echo '_mult($a, $b) = '._mult($a, $b).'<br>';
  echo '_divd($a, $b) = '._divd($a, $b).'<br>';

  /*
    4. Реализовать функцию с тремя параметрами:
    function mathOperation($arg1, $arg2, $operation),
    где $arg1, $arg2 – значения аргументов, $operation – строка с названием операции.
    В зависимости от переданного значения операции выполнить одну
    из арифметических операций (использовать функции из пункта 3) и
    вернуть полученное значение (использовать switch).
  */
  echo '<h1>4</h1>';

  function mathOperation($arg1, $arg2, $operation) {
    switch ($operation) {
      case '+':
        $result = _summ($arg1, $arg2);
        break;
      case '-':
        $result = _subt($arg1, $arg2);
        break;
      case '*':
        $result = _mult($arg1, $arg2);
        break;
      case '/':
        $result = _divd($arg1, $arg2);
        break;
      default:
        $result = false;

    }
    return $result;
  }

  $a = rand(0, 100) - 50;
  $b = rand(0, 100) - 50;
  echo '$a: '.$a.'<br>';
  echo '$b: '.$b.'<br>';
  echo 'mathOperation($a, $b, \'+\') = '.mathOperation($a, $b, '+').'<br>';
  echo 'mathOperation($a, $b, \'-\') = '.mathOperation($a, $b, '-').'<br>';
  echo 'mathOperation($a, $b, \'*\') = '.mathOperation($a, $b, '*').'<br>';
  echo 'mathOperation($a, $b, \'/\') = '.mathOperation($a, $b, '/').'<br>';
  echo 'mathOperation($a, $b, \'unknown\') = '.var_export(mathOperation($a, $b, 'unknown'), true).'<br>';

  /*
    6. *С помощью рекурсии организовать функцию возведения числа в степень.
    Формат: function power($val, $pow), где $val – заданное число, $pow – степень.
  */

  echo '<h1>5</h1>';

  function power($val, $pow) {
    // Работаем только с положительными значениями
    if ($pow <= 0) {
      return false;
    }
    if ($pow == 1) {
      return $val;
    }
    return $val * power($val, ($pow - 1));
  }

  $val = rand(2, 5);
  $pow = rand(2, 5);
  echo '$val: '.$val.'<br>';
  echo '$pow: '.$pow.'<br>';
  echo 'power($val, $pow) = '.power($val, $pow);

  /*
    7. *Написать функцию, которая вычисляет текущее время и возвращает его в
    формате с правильными склонениями, например:
    22 часа 15 минут
    21 час 43 минуты
  */

  echo '<h1>6</h1>';

  function _correctDeclination($num, $s1, $s2, $s3) {
    $num = (int)$num;

    $n0 = (int)substr($num, -1);
    $n1 = strlen($num) > 1 ? (int)substr($num, -2, 1) : 0;

    if ($n1 != 1) {
      if ($n0 == 1) {
        return $s1;
      } elseif ($n0 > 1 && $n0 < 5) {
        return $s2;
      }
    }
    return $s3;
  }

  $_h = date('n');
  $_m = date('G');
  echo $_h.' '._correctDeclination($_h, 'час', 'часа', 'часов');
  echo ' ';
  echo $_m.' '._correctDeclination($_m, 'минута', 'минуты', 'минут');
  echo '<br>';

?>
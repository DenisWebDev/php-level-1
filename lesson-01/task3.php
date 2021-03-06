<?php
  // Объяснить, как работает данный код:
  $a = 5;
  $b = '05';

  /*
    Из документации
    Если строка не содержит какой-либо из символов '.', 'e', или 'E', изначение
    числа помещается в пределы целых чисел (определенных PHP_INT_MAX), строка
    будет распознана как целое число (integer).
    Значение определяется по начальной части строки. Если строканачинается с
    верного числового значения, будет использовано этозначение. Иначе значением будет
    0 (ноль). Верное числовое значение - это одна или более цифр (могущих содержать десятичную точку),
    по желанию предваренных знаком, с последующим необязательнымпоказателем степени.
    Показатель степени - это 'e' или 'E' споследующими одной или более цифрами.
  */

  var_dump($a == $b);         // Почему true?
  // Cтрока $b будет преобразована в число 5 ((int)5 == (int)5)

  var_dump((int)'012345');     // Почему 12345?
  // Строка содержит верные числовые значения, ноль будет отброшен, остальные символы дадут число


  var_dump((float)123.0 === (int)123.0); // Почему false?
  // Тут срогое сравнение - типы разные, поэтому false


  var_dump((int)0 === (int)'hello, world'); // Почему true?
  // Строка справа даст число 0 ((int)0 == (int)0)
?>
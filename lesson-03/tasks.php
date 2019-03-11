<?php
  /*
    1. С помощью цикла while вывести все числа в промежутке от 0 до 100,
    которые делятся на 3 без остатка.
  */

  echo '<h1>1</h1>';

  $i = 0;
  while ($i <= 100) {
    if ($i%3 == 0) {
      echo $i.'<br>';
    }
    $i++;
  }

  /*
    2. С помощью цикла do…while написать функцию для вывода чисел от 0 до 10,
    чтобы результат выглядел так:
    0 – это ноль.
    1 – нечетное число.
    2 – четное число.
    3 – нечетное число.
    …
    10 – четное число.
  */

  echo '<h1>2</h1>';

  $i = 0;
  do {
    echo $i.' - ';
    if ($i == 0) {
      echo 'это ноль.';
    } else {
      echo $i%2 == 0 ? 'четное число.' : 'нечетное число.';
    }
    echo '<br>';
    $i++;
  } while ($i <= 10);

  /*
    3. Объявить массив, в котором в качестве ключей будут использоваться
    названия областей, а в качестве значений – массивы с названиями городов из
    соответствующей области. Вывести в цикле значения массива, чтобы результат был таким:
    Московская область:
    Москва, Зеленоград, Клин
    Ленинградская область:
    Санкт-Петербург, Всеволожск, Павловск, Кронштадт
    Рязанская область … (названия городов можно найти на maps.yandex.ru)
  */

  echo '<h1>3</h1>';

  function loadCities() {
    static $result;
    if (!isset($result)) {
      $result = array();
      if (($handle = fopen('cities.csv', 'r')) !== false) {
        while (($data = fgetcsv($handle)) !== false) {
          if ($data[0] == 'Индекс') {
            continue;
          }
          if (!$data[6]) {
            continue;
          }
          $result[$data[2].' '.$data[1]][] = $data[6];
        }
        fclose($handle);
      }
    }
    return $result;
  }

  foreach (loadCities() as $region => $cities) {
    echo $region.':<br>';
    echo implode(', ', $cities).'<br><br>';
  }

  /*
    4. Объявить массив, индексами которого являются буквы русского языка,
    а значениями – соответствующие латинские буквосочетания
    (‘а’=> ’a’, ‘б’ => ‘b’, ‘в’ => ‘v’, ‘г’ => ‘g’, …, ‘э’ => ‘e’, ‘ю’ => ‘yu’, ‘я’ => ‘ya’).
    Написать функцию транслитерации строк.
  */

  echo '<h1>4</h1>';

  function translit($str) {
    static $letters;
    if (!isset($letters)) {
      $letters = [
        'а' => 'a',
        'б' => 'b',
        'в' => 'v',
        'г' => 'g',
        'д' => 'd',
        'е' => 'e',
        'ё' => 'e',
        'ж' => 'zh',
        'з' => 'z',
        'и' => 'i',
        'й' => 'j',
        'к' => 'k',
        'л' => 'l',
        'м' => 'm',
        'н' => 'n',
        'о' => 'o',
        'п' => 'p',
        'р' => 'r',
        'с' => 's',
        'т' => 't',
        'у' => 'u',
        'ф' => 'f',
        'х' => 'h',
        'ц' => 'ts',
        'ч' => 'ch',
        'ш' => 'sh',
        'щ' => 'sch',
        'ъ' => '',
        'ы' => 'y',
        'ь' => '',
        'э' => 'e',
        'ю' => 'ju',
        'я' => 'ja'
      ];
      $letters = array_merge(
        $letters,
        array_combine(array_map(function($v) {
          return mb_strtoupper($v, 'utf-8');
        }, array_keys($letters)), array_map(function($v) {
          return strtoupper(substr($v, 0, 1)).substr($v, 1);
        }, $letters))
      );
    }
    $str = str_replace(array_keys($letters), $letters, $str);
    return $str;
  }

  echo translit('Объявить массив, индексами которого являются буквы русского языка');

  /*
    5. Написать функцию, которая заменяет в строке пробелы на подчеркивания и
    возвращает видоизмененную строчку.
  */

  echo '<h1>5</h1>';

  function replaceSpaces($str, $to = '_') {
    return preg_replace('~\s+~', $to, $str);
  }

  echo replaceSpaces('Строка с   пробелами');

  /*
    7. *Вывести с помощью цикла for числа от 0 до 9, НЕ используя тело цикла.
    То есть выглядеть должно так:
    for (…){ // здесь пусто}
  */

  echo '<h1>7</h1>';

  for ($i = 0; $i <= 9; print($i++)){}

  /*
    8. *Повторить третье задание, но вывести на экран только города,
    начинающиеся с буквы «К».
  */

  echo '<h1>8</h1>';

  $cities = array();
  foreach (loadCities() as $_region => $_cities) {
    foreach ($_cities as $_city) {
      if (strpos($_city, 'К') !== false) {
        $cities[$_region][] = $_city;
      }
    }
  }
  foreach ($cities as $_region => $_cities) {
    echo $_region.':<br>';
    echo implode(', ', $_cities).'<br><br>';
  }


  /*
    9. *Объединить две ранее написанные функции в одну, которая получает
    строку на русском языке, производит транслитерацию и замену пробелов на
    подчеркивания (аналогичная задача решается при конструировании url-адресов
    на основе названия статьи в блогах).
  */

  echo '<h1>9</h1>';

  function strToSef($str) {
    $str = translit($str);
    $str = strtolower($str);
    $str = preg_replace('~[^a-z\s]~', '', $str);
    $str = trim($str);
    $str = replaceSpaces($str);
    return $str;
  }

  echo strToSef('*Объединить две ранее написанные функции в одну, которая получает');

?>
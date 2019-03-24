<?php
  require_once '_init.php';

  if (isReqPost('save')) {
    if (sessionGet('answer') == reqPost('answer')) {
      if (reviewSave(0, $_POST, $errors)) {
        message('Ваш отзыв сохранен', 'success');
        redirect();
      }
      message($errors, 'error');
    } else {
      message('Неправильно решен пример', 'error');
    }

  }

  tplSet('controller', 'reviews');
  tplSet('meta_title', 'Отзывы');

  $num1 = rand(1, 9);
  $num2 = rand(1, 9);
  sessionSet('answer',  $num1 + $num2);

  tplSet('num1', $num1);
  tplSet('num2', $num2);

  tplSet('reviews', reviewGetList());

  render('reviews');

?>
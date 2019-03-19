<?php
  require_once '_init.php';

  if (isReqPost('save')) {
    if (reviewSave(0, $_POST, $errors)) {
      message('Ваш отзыв сохранен', 'success');
      redirect();
    }
    message($errors, 'error');
  }

  tplSet('controller', 'reviews');
  tplSet('meta_title', 'Отзывы');

  tplSet('reviews', reviewGetList());

  render('reviews');

?>
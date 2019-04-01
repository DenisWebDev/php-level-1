<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <title><?php echo _esc(tplGet('meta_title')); ?></title>
  </head>
  <body>
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item<?php
              echo tplGet('controller') == 'index' ? ' active' : '';
            ?>">
              <a class="nav-link" href="/">Главная</a>
            </li>
            <li class="nav-item<?php
              echo tplGet('controller') == 'reviews' ? ' active' : '';
            ?>">
              <a class="nav-link" href="/reviews.php">Отзывы</a>
            </li>
            <li class="nav-item<?php
              echo tplGet('controller') == 'cart' ? ' active' : '';
            ?>">
              <a class="nav-link" href="/cart.php">Корзина</a>
            </li>
            <?php if (userIsLogin()): ?>
              <li class="nav-item<?php
                echo tplGet('controller') == 'profile' ? ' active' : '';
              ?>">
                <a class="nav-link" href="/profile.php">Личный кабинет</a>
              </li>
              <?php if (isAdmin()): ?>
                <li class="nav-item dropdown<?php
                  echo tplGet('controller') == 'admin' ? ' active' : '';
                ?>">
                  <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    Администрирование
                  </a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="/admin.php">Каталог товаров</a>
                    <a class="dropdown-item" href="/admin.php?action=product-form">Добавить товар</a>
                    <a class="dropdown-item" href="/admin.php?action=orders-list">Заказы</a>
                  </div>
                </li>
              <?php endif; ?>
              <li class="nav-item">
                <a class="nav-link" href="/profile.php?action=logout">Выход</a>
              </li>
            <?php else: ?>
              <li class="nav-item<?php
                echo tplGet('controller') == 'login' ? ' active' : '';
              ?>">
                <a class="nav-link" href="/login.php">Вход</a>
              </li>
              <li class="nav-item<?php
                echo tplGet('controller') == 'register' ? ' active' : '';
              ?>">
                <a class="nav-link" href="/register.php">Регистрация</a>
              </li>
            <?php endif; ?>

          </ul>

        </div>
      </nav>

      <div class="container">
        <?php foreach (getMessagesToPrint() as $type => $messages): ?>
          <div class="alert alert-<?php
            if ($type == 'error') {
              echo 'danger';
            } elseif ($type == 'success') {
              echo 'success';
            } else {
              echo 'primary';
            }
          ?> my-2" role="alert">
            <?php echo implode('<br>', $messages); ?>
          </div>
        <?php endforeach; ?>
      </div>

    </div>

    <?php echo $content; ?>

    <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="/js/main.js?v=2"></script>
  </body>
</html>
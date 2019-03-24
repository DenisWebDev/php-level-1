<?php
  $menu = [
    'index' => 'Главная',
    'reviews' => 'Отзывы',
  ];
  if (userIsLogin()) {
    $menu['profile'] = 'Личный кабинет';
    if (isAdmin()) {
      $menu['admin'] = 'Администрирование';
    }
    $menu['logout'] = ['Выход', '/profile.php?action=logout'];
  } else {
    $menu['login'] = 'Вход';
    $menu['register'] = 'Регистрация';
  }
?><!doctype html>
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
            <?php foreach ($menu as $c => $m): ?>
              <li class="nav-item<?php
                echo tplGet('controller') == $c ? ' active' : '';
              ?>">
                <a class="nav-link" href="<?php
                  if (is_array($m)) {
                    echo $m[1];
                  } else {
                    echo '/'.($c != 'index' ? $c.'.php' : '');
                  }
                ?>"><?php echo _esc(is_array($m) ? $m[0] : $m); ?></a>
              </li>
            <?php endforeach; ?>
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
    <script src="/js/main.js"></script>
  </body>
</html>
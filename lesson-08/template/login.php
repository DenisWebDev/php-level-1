<div class="container">
  <div class="text-center">
    <h1 class="my-3">
      Вход
    </h1>
  </div>

  <div class="row justify-content-center my-3">
    <div class="col-md-6">
      <p>Тестовые пользователи:</p>
      <p>admin@site.loc / admin</p>
      <p>demo@site.loc / demo</p>
      <form action="" method="post">
        <div class="form-group">
          <label>Ваш email</label>
          <input type="email" required="required" name="email" class="form-control" value="<?php
            echo _esc(reqPost('email'));
          ?>">
        </div>
        <div class="form-group">
          <label>Ваш пароль</label>
          <input type="password" required="required" name="password" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary" name="login">Войти</button>
      </form>
    </div>
  </div>

</div>
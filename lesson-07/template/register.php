<div class="container">
  <div class="text-center">
    <h1 class="my-3">
      Регистрация
    </h1>
  </div>

  <div class="row justify-content-center my-3">
    <div class="col-md-6">
      <form action="" method="post">
        <div class="form-group">
          <label>Ваше имя</label>
          <input type="text" required="required" name="name" class="form-control" value="<?php
            echo _esc(reqPost('name'));
          ?>">
        </div>
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
        <button type="submit" class="btn btn-primary" name="register">Регистрация</button>
      </form>
    </div>
  </div>

</div>
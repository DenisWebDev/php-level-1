<div class="container">
  <div class="text-center">
    <h1 class="my-3">
      Оформление заказа
    </h1>
  </div>

  <div class="row justify-content-center my-3">
    <div class="col-md-6">
      <form action="" method="post">
        <div class="form-group">
          <label>Ваше имя</label>
          <input type="text" required="required" name="user_name" class="form-control" value="<?php
            echo _esc(reqPost('user_name'));
          ?>">
        </div>
        <div class="form-group">
          <label>Ваш email</label>
          <input type="email" required="required" name="user_email" class="form-control" value="<?php
            echo _esc(reqPost('user_email'));
          ?>">
        </div>
        <p class="text-center">
          <button type="submit" class="btn btn-primary" name="order">Оформить заказ</button>
        </p>
      </form>
    </div>
  </div>

</div>
<div class="container">
  <div class="text-center">
    <h1 class="my-3">
      Добавить отзыв
    </h1>
  </div>

  <div class="row justify-content-center my-3">
    <div class="col-md-6">
      <form action="" method="post">
        <div class="form-group">
          <label>Ваше имя</label>
          <input type="text" name="user_name" class="form-control" value="<?php
            echo _esc(reqPost('user_name'));
          ?>">
        </div>
        <div class="form-group">
          <label>Отзыв</label>
          <textarea class="form-control" name="text" rows="5"><?php
            echo _esc(reqPost('text'));
          ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary" name="save">Сохранить</button>
      </form>
    </div>
  </div>

  <?php if ($reviews): ?>
    <div class="text-center">
      <h1 class="my-3">
        Отзывы
      </h1>
    </div>

    <?php foreach ($reviews as $item): ?>
      <div class="my-3">
        <p class="h4">
          <?php echo _esc($item['user_name']); ?>
        </p>
        <p class="small"><?php echo _esc($item['date_add']); ?></p>
        <p><?php echo nl2br(_esc($item['text'])); ?></p>
      </div>
    <?php endforeach; ?>

  <?php endif; ?>

</div>
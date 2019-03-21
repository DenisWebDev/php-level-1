<div class="container">
  <div class="text-center">
    <h1 class="my-3">
      <?php if ($id): ?>
        Редактирование товара ID <?php echo $id; ?>
      <?php else: ?>
        Новый товар
      <?php endif; ?>
    </h1>
  </div>

  <div class="row justify-content-center my-3">
    <div class="col-md-6">
      <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label>Название</label>
          <input type="text" name="name" class="form-control" value="<?php
            echo _esc(reqPost('name', $id ? $data['name'] : ''));
          ?>">
        </div>
        <div class="form-group">
          <label>Описание</label>
          <textarea class="form-control" name="description" rows="5"><?php
            echo _esc(reqPost('description', $id ? $data['description'] : ''));
          ?></textarea>
        </div>
        <div class="form-group row">
          <div class="col-md-4">
            <label>Цена</label>
            <input type="number" name="price" size="7" class="form-control" value="<?php
            $_val = intval(reqPost('price', $id ? $data['price'] : 0));
            echo $_val != 0 ? $_val : '';
          ?>">
          </div>
        </div>
        <div class="form-group">
          <label>Картинка</label>
          <?php if ($id && $data['image']): ?>
            <div class="my-1">
              <img src="/images/small/<?php
                echo $data['image'];
              ?>" class="img-thumbnail">
            </div>
          <?php endif; ?>
          <input type="file" name="image" class="form-control-file">
        </div>
        <button type="submit" class="btn btn-primary" name="save">Сохранить</button>
        <a href="/admin.php" class="btn btn-secondary ml-3">Отмена</a>
      </form>
    </div>
  </div>

</div>
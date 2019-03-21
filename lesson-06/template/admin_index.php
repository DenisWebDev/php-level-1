<div class="container">
  <div class="text-center">
    <h1 class="my-3">Каталог товаров</h1>
  </div>
  <p>
    <a href="/admin.php?action=product-form" class="btn btn-success">
      Добавить товар
    </a>
  </p>

  <div class="table-responsive">
    <table class="table table-bordered">
      <tr>
        <th>ID</th>
        <th>Картинка</th>
        <th>Название / описание</th>
        <th>Цена</th>
        <th></th>
      </tr>
      <?php foreach ($products as $item): ?>
        <tr>
          <td><?php echo $item['id']; ?></td>
          <td><img src="/images/small/<?php
            echo $item['image'];
          ?>" style="max-width: 100px;"></td>
          <td>
            <?php echo _esc($item['name']); ?>
            <br>
            <?php echo mb_strimwidth($item['description'], 0, 200, '...'); ?>
          </td>
          <td><?php echo $item['price']; ?></td>
          <td>
            <a href="/product.php?id=<?php echo $item['id']; ?>" class="btn btn-success mx-2 mb-2">
              <i class="fas fa-eye"></i>
            </a>
            <a href="/admin.php?action=product-form&id=<?php echo $item['id']; ?>" class="btn btn-warning mx-2 mb-2">
              <i class="fas fa-edit"></i>
            </a>
            <a href="admin.php?action=product-delete&id=<?php echo $item['id']; ?>" class="btn btn-danger mx-2 mb-2" onclick="return confirm('Уверены?');">
              <i class="fas fa-trash"></i>
            </a>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>

</div>
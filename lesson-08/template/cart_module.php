<?php if (!$products): ?>
  <p class="my-3 text-center cart-no-items">
    Корзина пуста
    <br><br>
    <a href="/" class="btn btn-primary">
      Перейти в каталог
    </a>
  </p>
<?php else: ?>
  <div class="cart-items">
    <div class="table-responsive">
      <table class="table table-bordered">
        <tr>
          <th colspan="2">Товар</th>
          <th>Цена</th>
          <th>Количество</th>
          <th>Сумма</th>
          <th></th>
        </tr>
        <?php $all = 0; ?>
        <?php foreach ($products as $item): ?>
          <tr id="cart-item-<?php echo $item['id']; ?>" class=>
            <td><img src="/images/small/<?php
              echo $item['image'];
            ?>" style="max-width: 100px;"></td>
            <td>
              <?php echo _esc($item['name']); ?>
              <br>
              <?php echo mb_strimwidth($item['description'], 0, 200, '...'); ?>
            </td>
            <td><?php echo $item['price']; ?></td>
            <td><?php echo $item['quantity']; ?></td>
            <td><?php
              $_v = $item['price']*$item['quantity'];
              $all += $_v;
              echo $_v;
            ?></td>
            <td>
              <a href="#" class="btn btn-danger mx-2 mb-2 delete-product-from-cart" data-id="<?php
                echo $item['id'];
              ?>">
                <i class="fas fa-trash"></i>
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
    <p class="text-right">
      <b>Итого: <?php echo $all; ?> руб.</b>
    </p>
    <p class="text-center">
      <a href="/order.php" class="btn btn-success">Оформить заказ</a>
    </p>
  </div>
<?php endif; ?>
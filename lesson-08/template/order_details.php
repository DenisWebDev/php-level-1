<div class="container">
  <div class="text-center">
    <h1 class="my-3">Ваш заказ #<?= $order['id'] ?> успешно оформлен!</h1>
    <h1 class="my-3">В ближайшее время с Вами свяжется наш менеджер.</h1>
  </div>

  <div class="text-center">
    <h3 class="my-3">Информация о заказе</h3>
  </div>
  <div class="cart-items">
    <div class="table-responsive">
      <table class="table table-bordered">
        <tr>
          <th colspan="2">Товар</th>
          <th>Цена</th>
          <th>Количество</th>
          <th>Сумма</th>
        </tr>
        <?php $all = 0; ?>
        <?php foreach ($order['products'] as $item): ?>
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
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
    <p class="text-right">
      <b>Итого: <?php echo $all; ?> руб.</b>
    </p>
  </div>
</div>
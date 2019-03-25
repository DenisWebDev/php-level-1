<div class="container">
  <div class="text-center">
    <h1 class="my-3">Заказ #<?= $order['id'] ?></h1>
  </div>

  <div class="text-center">
    <h3 class="my-3">Общая информация</h3>
  </div>

  <div class="table-responsive">
    <table class="table table-bordered">
      <tr>
        <th>Дата</th>
        <td><?php echo _esc($order['date_add']); ?></td>
      </tr>
      <tr>
        <th>Имя</th>
        <td><?php echo _esc($order['user_name']); ?></td>
      </tr>
      <tr>
        <th>Email</th>
        <td><?php echo _esc($order['user_email']); ?></td>
      </tr>
    </table>
  </div>

  <div class="text-center">
    <h3 class="my-3">Товары</h3>
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

  <div class="row justify-content-center my-3">
    <div class="col-md-6">
      <form action="" method="post">
        <div class="form-group">
          <label>Статус</label>
          <select class="form-control" name="status">
            <?php foreach (orderGetStatusList() as $k => $v): ?>
              <option value="<?php echo _esc($k); ?>"<?php
                echo $k == reqPost('status', $order['status']) ? ' selected="selected"' : '';
              ?>><?php echo _esc($v); ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Изменить статус</button>
      </form>
    </div>
  </div>

</div>
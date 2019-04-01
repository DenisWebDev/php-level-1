<div class="container">
  <div class="text-center">
    <h1 class="my-3">Заказы</h1>
  </div>

  <div class="table-responsive">
    <table class="table table-bordered">
      <tr>
        <th>ID</th>
        <th>Дата</th>
        <th>Имя</th>
        <th>Email</th>
        <th>Сумма</th>
        <th>Статус</th>
        <th></th>
      </tr>
      <?php foreach ($orders as $item): ?>
        <tr>
          <td><?php echo $item['id']; ?></td>
          <td><?php echo _esc($item['date_add']); ?></td>
          <td><?php echo _esc($item['user_name']); ?></td>
          <td><?php echo _esc($item['user_email']); ?></td>
          <td><?php echo _esc($item['product_sum']); ?></td>
          <td><?php echo _esc(orderGetStatus($item['status'])); ?></td>
          <td>
            <a href="/admin.php?action=order-details&id=<?php echo $item['id']; ?>" class="btn btn-success mx-2 mb-2">
              <i class="fas fa-eye"></i>
            </a>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>

</div>
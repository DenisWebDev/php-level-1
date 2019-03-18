<div class="container">
  <div class="text-center">
    <h1 class="my-3">Каталог товаров</h1>
  </div>

</div>

<div class="py-5">
  <div class="container">

    <div class="row">
      <?php foreach ($products as $item): ?>
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <img src="/images/small/<?php
              echo $item['image'];
            ?>" class="bd-placeholder-img card-img-top">
            <div class="card-body">
              <p class="h6"><?php echo _esc($item['name']); ?></p>
              <p><strong><?php echo $item['price']; ?> руб.</strong></p>
              <p class="card-text">
                <?php echo mb_strimwidth($item['description'], 0, 200, '...'); ?>
              </p>
              <div class="d-flex justify-content-between align-items-center">
                <a href="/product.php?id=<?php echo $item['id']; ?>" class="btn btn-info">Подробнее</a>
                <a href="#" class="btn btn-success">В корзину</a>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
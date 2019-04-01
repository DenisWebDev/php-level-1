<div class="container">
  <div class="text-center">
    <h1 class="my-3"><?php echo _esc($product['name']); ?></h1>
  </div>

  <div class="row">
    <div class="col-md-6">
      <img src="/images/medium/<?php
        echo $product['image'];
      ?>" class="img-thumbnail">
    </div>
    <div class="col-md-6">
      <?php if ($product['discount']): ?>
        <p class="h1" style="color: grey; text-decoration: line-through;">
          <?php echo $product['old_price']; ?> руб.
        </p>
      <?php endif; ?>
      <p class="h1"><?php echo $product['price']; ?> руб.</p>
      <p>
        <a href="#" class="btn btn-success add-product-in-cart" data-id="<?php
          echo (int)$product['id'];
        ?>" data-q="1">В корзину</a>
      </p>
      <p>
        <?php echo nl2br($product['description']); ?>
      </p>
    </div>
  </div>

</div>


<div class="container">
  <h1 class="my-3 text-center">Калькулятор</h1>
  <h2 class="my-3 text-center">Вариант 1</h2>
  <div class="row justify-content-center my-3">
    <div class="col-md-8">
      <form action="" method="post">
        <div class="row justify-content-center">
          <div class="col-4">
            <input type="text" class="form-control" name="num1" />
          </div>
          <div class="col-2">
            <select class="form-control" name="operation">
              <?php foreach (['+', '-', '*', '/'] as $op): ?>
                <option value="<?php echo $op; ?>"><?php
                  echo $op;
                ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-4">
            <input type="text" class="form-control" name="num2" />
          </div>
          <div class="col-2">
            <input type="submit" class="btn btn-primary" value="=" />
          </div>
        </div>
      </form>
    </div>
  </div>
  <h2 class="my-3 text-center">Вариант 1</h2>
  <div class="row justify-content-center my-3">
    <div class="col-md-8">
      <form action="" method="post">
        <div class="row justify-content-center">
          <div class="col-4">
            <input type="text" class="form-control" name="num1" />
          </div>
          <div class="col-4">
            <input type="text" class="form-control" name="num2" />
          </div>
          <div class="col-4">
            <?php foreach (['+', '-', '*', '/'] as $op): ?>
              <input type="submit" class="btn btn-primary" name="operation" value="<?php
                echo $op;
              ?>" />
            <?php endforeach; ?>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
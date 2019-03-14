<?php

  require_once 'config.php';

  if ($_FILES) {
    $folder = dirname(__FILE__).'/images';
    foreach ($_FILES['images']['name'] as $i => $v) {
      if (!$_FILES['images']['error'][$i]) {
        if ($filename = genImageName($_FILES['images']['type'][$i], $folder.'/big')) {
          if (move_uploaded_file($_FILES['images']['tmp_name'][$i], $folder.'/big/'.$filename)) {
            resizeImg($folder.'/big/'.$filename, $folder.'/small/'.$filename);
            $sql = 'INSERT INTO images
              SET
                name = \''.mysqli_escape_string($db, $filename).'\',
                size = '.intval($_FILES['images']['size'][$i]);
            mysqli_query($db, $sql);
          }
        }
      }
    }
    header('Location: '.$_SERVER['REQUEST_URI']);
    exit();
  }

  include '_header.php';

  if (isset($_GET['id'])) {

    $sql = 'SELECT * FROM images
      WHERE id = '.intval($_GET['id']).'
      LIMIT 1';
    if ($res = mysqli_query($db, $sql)) {
      if (!($img = mysqli_fetch_assoc($res))) {
        header('Location: /');
        exit();
      }
    }
    $sql = 'UPDATE images
      SET views = views + 1
      WHERE id = '.intval($_GET['id']);
    mysqli_query($db, $sql);
    $img['views']++;

    ?>
      <section id="gallery">
        <img src="/images/big/<?php echo $img['name']; ?>" style="max-width: 100%;" />
        <p>Просмотров: <?php echo $img['views']; ?></p>
        <p><a href="/">&larr; к списку картинок</a></p>
      </section>
    <?php
  } else {
    $images = [];
    $sql = 'SELECT * FROM images
      ORDER BY views DESC';
    if ($res = mysqli_query($db, $sql)) {
      while ($r = mysqli_fetch_assoc($res)) {
        $images[] = $r;
      }
    }
    ?>
      <section id="gallery">
        <?php foreach ($images as $img): ?>
          <a href="?id=<?php echo $img['id']; ?>">
            <img src="/images/small/<?php echo $img['name']; ?>" />
          </a>
        <?php endforeach; ?>
      </section>

      <section id="image-upload">
        <form action="" method="post" enctype="multipart/form-data">
          <p>
            <input type="file" name="images[]" multiple="multiple" accept="image/jpeg,image/gif,image/png" />
          </p>
          <input type="submit" />
        </form>
      </section>
    <?php
  }

  include '_footer.php';

  function genImageName($type, $folder) {
    switch ($type) {
      case 'image/jpeg':
        $ext = 'jpg';
        break;
      case 'image/gif':
        $ext = 'gif';
        break;
      case 'image/png':
        $ext = 'png';
        break;
      default:
        return false;
    }
    $filename = date('Y-m-d-H-i-s').'-'.rand(1000, 9999).'.'.$ext;
    while (is_file($folder.'/'.$filename)) {
      $filename = date('Y-m-d-H-i-s').'-'.rand(1000, 9999).'.'.$ext;
    }
    return $filename;
  }

  function resizeImg($path, $to) {
    if (is_readable($path)) {
      $type = mime_content_type($path);
      switch ($type) {
        case 'image/jpeg':
          $img = imagecreatefromjpeg($path);
          break;
        case 'image/gif':
          $img = imagecreatefromgif($path);
          break;
        case 'image/png':
          $img = imagecreatefrompng($path);
          break;
        default:
          return false;
      }

      $w = $h = 100;
      $width = imagesx($img);
      $height = imagesy($img);
      if ($w > $width) {
        $w = $width;
      }
      if ($h > $height) {
        $h = $height;
      }
      $dx = $dy = 0;
      if ($width/$w > $height/$h) {
        $dx = round(($width - ($w/$h * $height)) / 2);
        $width -= $dx*2;
      } elseif ($width/$w < $height/$h) {
        $dy = round(($height - ($h/$w * $width)) / 2);
        $height -= $dy*2;
      }
      $image_resized = imagecreatetruecolor($w, $h);
      if ($type == 'image/png') {
        imagealphablending($image_resized, false);
        imagesavealpha($image_resized, true);
      }
      if (imagecopyresampled($image_resized, $img, 0, 0, (int)$dx, (int)$dy, (int)$w, (int)$h, (int)$width, (int)$height)) {
        $img = $image_resized;
        switch ($type) {
          case 'image/jpeg':
            return imagejpeg($img, $to, 100);
          case 'image/gif':
            return imagegif($img, $to);
          case 'image/png':
            return imagepng($img, $to, 0);
        }
      }
    }
    return false;
  }
?>
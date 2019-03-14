<?php
  if ($_FILES) {
    $folder = dirname(__FILE__).'/images';
    foreach ($_FILES['images']['name'] as $i => $v) {
      if ($filename = genImageName($_FILES['images']['type'][$i], $folder.'/big')) {
        if (move_uploaded_file($_FILES['images']['tmp_name'][$i], $folder.'/big/'.$filename)) {
          resizeImg($folder.'/big/'.$filename, $folder.'/small/'.$filename);
        }
      }
    }
    header('Location: '.$_SERVER['REQUEST_URI']);
    exit();
  }

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
?><!DOCTYPE html>

<html>

<head>
  <title>Gallery</title>
  <meta charset="utf-8">

  <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.css" />
  <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.js"></script>

  <style>
    section {
      margin: 30px auto;
      width: 600px;
      text-align: center;
    }
    #gallery a {
      display: inline-block;
      padding: 5px;
      text-decoration: none;
    }
  </style>
</head>

<body>

  <section id="gallery">
    <?php foreach (scandir('images/small') as $img): ?>
      <?php if (!preg_match('~\.(jpg|gif|png)$~', $img)) continue; ?>
      <a data-fancybox="gallery" href="/images/big/<?php echo $img; ?>">
        <img src="/images/small/<?php echo $img; ?>" />
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


</body>
</html>
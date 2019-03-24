<?php

  function imageLoad($file) {
    $folder = _ROOT_DIR_.'/images';
    if (!$file['error']) {
      if ($filename = imageGenName($file['type'], $folder.'/big')) {
        if (move_uploaded_file($file['tmp_name'], $folder.'/big/'.$filename)) {
          imageThumb($folder.'/big/'.$filename, $folder.'/small/'.$filename, 350);
          imageThumb($folder.'/big/'.$filename, $folder.'/medium/'.$filename, 600);
          return $filename;
        }
      }
    }
    return false;
  }

  function imageGenName($type, $folder) {
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

  function imageThumb($path, $to, $size) {
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

      $w = $h = $size;
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
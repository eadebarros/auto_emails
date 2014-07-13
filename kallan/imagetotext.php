<?php
// Set the content-type
header('Content-Type: image/jpeg');

// Create the image
$im = imagecreatefromjpeg("images/1.jpg");

// Create some colors
$white = imagecolorallocate($im, 255, 255, 255);
$yellow = imagecolorallocate($im, 2555,255,0);
$grey = imagecolorallocate($im, 128, 128, 128);
$black = imagecolorallocate($im, 0, 0, 0);
$blue = imagecolorallocate($im, 11,97,151);

imagefilledrectangle($im, 40, 0, 160, 30, $blue);

// The text to draw
$text = $_GET['nome'];
// Replace path by your own font path
$font = 'arialbd.ttf';

// Add some shadow to the text
//imagettftext($im, 16, 0, 5, 21, $grey, $font, $text);

// Add the text
imagettftext($im, 11, 0, 48, 22, $white, $font, $text);

// Using imagepng() results in clearer text compared with imagejpeg()
imagepng($im);
imagedestroy($im);

?>
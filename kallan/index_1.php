<?php
error_reporting(E_ALL);
/**
* generates a image with chars instead of pixels
*
* @param string $url Filepath or url
* @param string $chars The chars which should replace the pixels
* @param int $shrpns Sharpness (2 = every second pixel, 1 = every pixel ... )
* @param int $size 
* @param int $weight font-weight/size
* @return sesource
* @author Nicolas 'KeksNicoh' Heimann <www.salamipla.net>
* @date 02nov08
*/
function pixelfuck($url, $chars='ewk34543§G§$§$Tg34g4g', $shrpns=2, $size=2,$weight=2)
{
    list($w, $h, $type) = getimagesize($url);
    $resource = imagecreatefromstring(file_get_contents($url));
    $img = imagecreatetruecolor($w*$size,$h*$size);

    $cc = strlen($chars);
    for($y=0;$y <$h;$y+=$shrpns) 
        for($x=0;$x <$w;$x+=$shrpns)
            imagestring($img,$weight,$x*$size,$y*$size, $chars{@++$p%$cc}, imagecolorat($resource, $x, $y));
    return $img;
}

$url = 'http://ocodex.com.br/blog/wp-content/uploads/2013/08/Diablo-3-Reaper-of-Souls.jpg';
$text = 'blizzard';

Header('Content-Type: image/png');
imagepng(pixelfuck($url, $text, 1, 7));

?>

<form action="" method="post">
<table width="0" border="0" align="left">
    <td>utm_term</td>
    <td><input type="text" name="utm_term" class="links" /></td>
    </tr>
<tr>
    <td>utm_campaign</td>
    <td><input type="text" name="utm_campaign" class="links" /></td>
    </tr>

<tr>
    <td>&nbsp;</td>
    <td><textarea name="links" class="links" style="height:800px;"></textarea></td>
    </tr>
<tr>

    <td>&nbsp;</td>
    <td align="right"><input name="input" type="submit" value="Fazer a magica" /></td>
</tr>
</table>
</form>
</body>
</html>

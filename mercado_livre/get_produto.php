<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta name="ROBOTS" content="NONE"/>
      <meta property="og:title" content="" />
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title></title>
    </head>
<body>

<?php

error_reporting('E_WARNING | E_PARSE | E_ERROR');
//set_time_limit(3000);
require('include/WideImage.php');
 
  $link = str_replace("-","",$_GET['link']);
  $api = "https://api.mercadolibre.com/items/".$link;
  $utms = "?utm_source=iloveecommerce&utm_medium=newsletterag&utm_campaign=20140723_mercado_livre";

  $curl = curl_init();
  curl_setopt( $curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1" );
  curl_setopt ($curl, CURLOPT_URL, $api);
  curl_setopt ($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt ($curl, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt ($curl, CURLOPT_CONNECTTIMEOUT, 20);
  $data = curl_exec($curl);
  curl_close($curl);

  $json = json_decode($data);


  
  $produto = $json->title;
  $preco = str_replace(".",",",$json->price);
  $original_price = str_replace(".", ",", $json->original_price);
  $permalink = $json->permalink;
  $estoque = $json->available_quantity;
  $img = $json->pictures[0]->url;
  //$img_name = strtolower(str_replace(" ", "_", $produto));
  //$img_name = preg_replace( '/[`^~\'"]/', null, iconv( 'UTF-8', 'ASCII//TRANSLIT', $img_name ) );
  $img_name = "ml_". date("Ymdhis", time());

  copy($img, 'images/'.$img_name.'.jpg');

  WideImage::load('images/'.$img_name.'.jpg')->resize(160, 160)->saveToFile('images/'.$img_name.'.jpg');

  echo  '
  <textarea style="width:800px;" rows="20">
    <span style="display: inline-block; width: 190px; vertical-align: middle;" class="product" id="ipad">

        <div style="width: 100%; overflow: hidden; padding-top: 15px; padding-bottom: 10px; text-align: center;">
            <a href="'.$permalink.$utms.'" title="'.$produto.'" style="font-size: 17px; font-family: Verdana, sans-serif; color: #010101;">
            <img src="images/'.$img_name.'.jpg" alt="'.$produto.'" border="0" style="margin: 0; padding: 0;" /></a>
        </div>
        
        <div style="width: 100%; overflow: hidden; font-family: Verdana, sans-serif;text-transform:Capitalize; font-weight: bold; font-size: 12px; text-align: center; color: #834A5B; padding-bottom: 0px; line-height: 18px;">
        '.$produto.'
        </div>
        
        <div style="width: auto; overflow: hidden; font-family: Verdana, sans-serif; font-size: 11px; color: #474646; text-align: center; line-height: 15px;">
        	'.$de = ($original_price != "" ? 'de R$ <del>'.$original_price .'</del>' : '&nbsp;').'
        </div>
        <div style="width: auto; overflow: hidden; font-family: Verdana, sans-serif; font-size: 11px; color: #474646; text-align: center; line-height: 15px;">
         por <span style="color:#000000;"><strong> R$ '.$preco.'</strong></span>
        </div>
        
        <div style="width: 100%; overflow: hidden; font-family: Verdana, sans-serif; font-weight: bold;font-size: 12px; color: #834A5B; text-align: center; padding-bottom: 2px;">
        	12x <span style="color:#606060">de</span> R$ '. $p = str_replace(".",",",$preco/10) .'
        </div>
        <div style="width: auto; overflow: hidden; font-family: Verdana, sans-serif; font-size: 11px; color: #474646; text-align: center; line-height: 15px;">
         <center><span style="padding-bottom: 5px;"><a href="'.$permalink.$utms.'" style="color: #834A5B; text-transform: uppercase; text-decoration: none; font-size: 12px; font-family: Verdana, sans-serif; display: block; padding: 3px; width: 50%; font-weight: bold; background-color: #F5F0DD; border-radius: 3px;">CONFIRA ►</a></span></center>
        </div>

  </span>
</textarea>';


?>
</body>
</html>

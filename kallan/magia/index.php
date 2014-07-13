<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ultra PHP</title>
<style>
body{font-family:Arial, Helvetica, sans-serif; font-size:12px; margin:0px; padding:0px;}
.links{width:800px;}
.resposta{font-family:Arial, Helvetica, sans-serif; font-size:10px; border:1px solid #000; padding:5px; margin:5px;}
</style>
</head>

<body>
<?php
set_time_limit(3000);
require('include/WideImage.php');

function retira_acentos($texto) { 
$array1 = array( "á", "à", "â", "ã", "ä", "é", "è", "ê", "ë", "í", "ì", "î", "ï", "ó", "ò", "ô", "õ", "ö", "ú", "ù", "û", "ü", "ç" 
, "Á", "À", "Â", "Ã", "Ä", "É", "È", "Ê", "Ë", "Í", "Ì", "Î", "Ï", "Ó", "Ò", "Ô", "Õ", "Ö", "Ú", "Ù", "Û", "Ü", "Ç" ); 
$array2 = array( "a", "a", "a", "a", "a", "e", "e", "e", "e", "i", "i", "i", "i", "o", "o", "o", "o", "o", "u", "u", "u", "u", "c" 
, "a", "a", "a", "a", "a", "e", "e", "e", "e", "i", "i", "i", "i", "o", "o", "o", "o", "o", "u", "u", "u", "u", "c" ); 
$texto =  str_replace( $array1, $array2, $texto); 
$texto = str_replace(" ","",$texto);

$texto = ltrim($texto);
return $texto;
} 


function linksprodutos($link,$utm_source,$utm_medium,$utm_term,$utm_campaign,$num){



$pagina = html_entity_decode(file_get_contents($link));
$produto = explode('<h1 class="name fn">',$pagina);
$produto = explode('</h1>',$produto[1]);


$depor = explode('<del>',$pagina);
$depor = explode('</del>',$depor[1]);

$preco = explode('<span id="lblPrecoPor" class="price sale">',$pagina);
$preco = explode('</span>',$preco[1]);
$preco[0] = str_replace("por"," ",$preco[0]);

$d = explode('<span id="lblParcelamento" class="parcel">',$pagina);
$d = explode('<span id="lblOutroParc" class="interest"></span>',$d[1]);

$d = strip_tags($d[0]);

$img = explode('<a id="Zoom1" class="MagicZoom" rel="zoom-width:383px;zoom-height:392px;zoom-position:right;" href="',$pagina);
$img = explode('"',$img[1]);	

copy($img[0], 'C:/wamp/www/kallan/images/'.$num.'.jpg');

WideImage::load('C:/wamp/www/kallan/images/'.$num.'.jpg')->resize(200, 200)->saveToFile('C:/wamp/www/kallan/images/'.$num.'.jpg');
return '
<table width="200" border="0" cellpadding="0" cellspacing="0" align="center">
	<tr>
		<td>
			<a href="'.$link.'" style="color:#6c6c6c; text-decoration:none"><img src="images/'.$num.'.jpg" width="200" height="197" alt="'.trim($produto[0]).'" title="'.trim($produto[0]).'" style="display:block;border: none;" /></a>
</td>
	</tr>
	<tr>
		<td width="200" height="48" align="center" style="font-size:12px; font-family:Verdana, Geneva, sans-serif; font-weight:bold" >
		<a href="'.$link.'" style="color:#6c6c6c; text-decoration:none">'.$produto[0].'</a>
		</td>
	</tr>
	<tr>
		<td>
			<img src="images/pdt_03.jpg" width="200" height="4" alt="imagem" style="display:block;border: none;" />
</td>
	</tr>
	<tr>
		<td width="200" height="50" align="center" valign="top" style="font-size:12px; font-family:Verdana, Geneva, sans-serif; ">
		<a href="'.$link.'" style="color:#6c6c6c; text-decoration:none; ">De <del>'.$depor[0].'</del></a><br />
        <a href="'.$link.'" style="color:#6c6c6c; text-decoration:none; ">POR '.$preco[0].'</a><br />
        <a href="'.$link.'" style="color:#000; text-decoration:none; font-size:12px;"><strong>'.str_replace("sem juros","",$d).'<br /><span style="font-size:9px; color:#6c6c6c;">sem juros</span></strong><br />
		<p><img src="images/c.jpg"  alt="imagem" style="display:block;border: none;" /></p></a>
</td>
	</tr>
</table>
';










}
if($_SERVER['REQUEST_METHOD'] == "POST") {

	$likns = $_POST['links'];


	$likns = explode('http://',$likns);


	for($i=1;$i<=(count($likns)-1); $i++){
		$l = trim($likns[$i]);
		$l = str_replace(" ","",$l);
		$l = "http://".$l;
		$l = ltrim($l);
		$l = str_replace(" ","",$l);
		$l = str_replace(";","",$l);

		$pro[] = linksprodutos($l,$_POST['utm_source'],$_POST['utm_medium'],$_POST['utm_term'],$_POST['utm_campaign'],$i);	

	}	
echo '<table width="0" border="0" cellspacing="0" cellpadding="0">
		  <tr>
		    <td>
            '.$pro[0].'          
            </td>
		    <td>
			'.$pro[1].'
			</td>
		    <td>
			'.$pro[2].'
			</td>
	      </tr>
</table>';
echo '<table width="0" border="0" cellspacing="0" cellpadding="0">
		  <tr>
		    <td>
            '.$pro[3].'          
            </td>
		    <td>
			'.$pro[4].'
			</td>
		    <td>
			'.$pro[5].'
			</td>
	      </tr>
</table>';
echo '<table width="0" border="0" cellspacing="0" cellpadding="0">
		  <tr>
		    <td>
            '.$pro[6].'          
            </td>
		    <td>
			'.$pro[7].'
			</td>
		    <td>
			'.$pro[8].'
			</td>
	      </tr>
</table>';
echo '<table width="0" border="0" cellspacing="0" cellpadding="0">
		  <tr>
		    <td>
            '.$pro[9].'          
            </td>
		    <td>
			'.$pro[10].'
			</td>
		    <td>
			'.$pro[11].'
			</td>
	      </tr>
</table>';


}



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

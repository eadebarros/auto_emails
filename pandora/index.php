<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ultra PHP</title>
<style>
    body{
        font-family:Arial, Helvetica, sans-serif;
        font-size:12px;
        margin:0px;
        padding:0px;
    }
    .links{
        width:800px;
    }
    .resposta{
        font-family:Arial, Helvetica, sans-serif;
        font-size:10px;
        border:1px solid #000;
        padding:5px;
        margin:5px;
    }
</style>
</head>

<body>
<?php
error_reporting(E_WARNING | E_PARSE | E_ERROR);
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

function linksprodutos($link,$utms,$num){
$pagina = html_entity_decode(file_get_contents($link));
//die($pagina);
$produto = explode('<h1 itemprop="name">',$pagina);
$produto = explode('</h1>',$produto[1]);
$produto[0] = utf8_encode($produto[0]);

$img = explode('<img id="imgPrincipal" class="pointer" itemprop="image" src="',$pagina);
$img = explode('"',$img[1]);

#Preço do produto cheio
$preco = explode('<em id="ltlPreco">',$pagina);
$preco = explode('</em>',$preco[1]);


copy('http://www.pandorajoias.com.br'.$img[0], 'images/'.$num.'.jpg');
WideImage::load('images/'.$num.'.jpg')->resize(160, 160)->saveToFile('images/'.$num.'.jpg');
return '
<span style="display: inline-block; width: 190px; vertical-align: middle;" class="product" id="ipad">

      <div style="width: 100%; overflow: hidden; padding-top: 15px; padding-bottom: 10px; text-align: center;">
          <a href="'.$link.$utms.'" title="'.$produto[0].'" style="font-size: 17px; font-family: Verdana, sans-serif; color: #010101;">
          <img src="images/'.$num.'.jpg" alt="'.$produto[0].'" border="0" style="margin: 0; padding: 0;" /></a>
      </div>
      
      <div style="width: 100%; overflow: hidden; font-family: Verdana, sans-serif;text-transform:capitalize; font-weight: bold; font-size: 12px; text-align: center; color: #616161; padding-bottom: 0px; line-height: 18px;">
      '.$produto[0].'
      </div>
      
      <div style="width: auto; overflow: hidden; font-family: Verdana, sans-serif; font-size: 11px; color: #474646; text-align: center; line-height: 15px;">
      	&nbsp;
      </div>
      <div style="width: auto; overflow: hidden; font-family: Verdana, sans-serif; font-size: 11px; color: #474646; text-align: center; line-height: 15px;">
       por <span style="color:#000000;"><strong>'.$preco[0].'</strong></span>
      </div>
      <div style="width: auto; overflow: hidden; font-family: Verdana, sans-serif; font-size: 11px; color: #474646; text-align: center; line-height: 15px;">
       <center><span style="padding-bottom: 5px;"><a href="'.$link.$utms.'" style="color: #101010; text-transform: uppercase; text-decoration: none; font-size: 12px; font-family: Verdana, sans-serif; display: block; padding: 3px; width: 50%; font-weight: bold; background-color: #dddbdb; border-radius: 3px;">VEJA MAIS</a></span></center>
      </div>

</span>';
}
if($_SERVER['REQUEST_METHOD'] == "POST") {
	$likns = $_POST['links'];
        $utms = $_POST['utms']; 
	$likns = explode('http://',$likns);

	for($i=1;$i<=(count($likns)-1); $i++){
		$l = trim($likns[$i]);
		$l = str_replace(" ","",$l);
		$l = "http://".$l;
		$l = ltrim($l);
		$l = str_replace(" ","",$l);
		$l = str_replace(";","",$l);

		$pro[] = linksprodutos($l,$utms,$i);	
	}	
echo '
    <div style="width:1000px;margin:0 auto;"> 
        <h1>I love you Mother Fucker Technology</h1>
<textarea name="valor_retorno" style="width:900px;height:700px;">    
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta name="ROBOTS" content="NONE"/>
      <meta property="og:title" content="" />
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title></title>
      <!--[if gte mso 9]>
          <style type="text/css">
    		[class=outlook] {width: 100%; overflow: hidden; font-family: Verdana, sans-serif;text-transform:capitalize; font-weight: bold; font-size: 12px; text-align: center; color: #616161; padding-bottom: 0px; line-height: 18px;}	
          </style>
	  <![endif]-->
      <style>
         .ExternalClass * {line-height: 100%;}
         @media only screen and (max-width: 480px) {
         body {padding: 5px; padding-top: 0px;}
         [class=product] {min-width: 100% !important; padding-left: 0px !important; padding-right: 0px !important;}
         [class=section_title] {padding-top: 5px !important;}
         [class=categories_mail] {padding-left: 0px !important; padding-right: 0px !important;}
         [id=second] {border-top: 0px !important;}
         [id=last] {display: none !important;}
         }
         @media only screen and (min-device-width : 768px) and (max-device-width : 1024px) {
         [id=ipad]{width: 279px !important;} 
         }
      </style>
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
   </head>
   <body style="-webkit-text-size-adjust:none; margin-left: auto; margin-right: auto; margin-top: 0px; margin-bottom: 0px; padding-top: 0px;" bgcolor="#FFFFFF">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="max-width: 600px;" class="section_title">
         <tr>
            <td align="center" valign="top" height="10">
               <p style="text-align:center;color:#666666;font-size:10px;font-family:Arial, Helvetica, sans-serif">Se não conseguir visualizar corretamente esta mensagem, <a href="#" style="color: #000000; font-family: arial, helvetica, sans-serif; font-size: 11px;">acesse este link</a></p>
            </td>
         </tr>
      </table>
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="max-width: 600px;">
         <tr>
            <td valign="top" align="center">                  
               <img src="http://www.iloveecommerce.com.br/newsletter/news-headernovo/newhdr-logo.jpg" border="0" alt="Logo" style="max-width: 186px; width: auto; display: inline-block; padding: 0; margin: 0; margin-bottom: 15px; padding-left: 2px; padding-right: 2px;" />
            </td>
         </tr>
      </table>
      <center>
         <div style="max-width:600px;overflow:hidden;background-color:#FFFFFF;">
            <table style="max-width:600px;" align="center" border="0" bgcolor="#000000" cellpadding="0" cellspacing="0" width="auto">
               <tbody>
                  <tr>
                     <td align="right" bgcolor="#FFFFFF" style="padding-left:10px;padding-right:10px;border-right:1px solid #666666;padding-top:5px;padding-bottom:5px;" target="_blank"><a href="http://www.pandorajoias.com.br/Paraiso_Tropical_PANDORA-2163.html#1'.$utms.'" style="text-decoration: none;font-family:Arial, Helvetica, sans-serif;font-size:10px;color:#000000;">PARAÍSO TROPICAL</a></td>
                     <td bgcolor="#FFFFFF" style="padding-left:10px;padding-right:10px;padding-top:5px;border-right:1px solid #666666;padding-bottom:5px;" target="_blank"><a href="http://www.pandorajoias.com.br/braceletes-1843.html#1'.$utms.'" style="text-decoration: none;font-family:Arial, Helvetica, sans-serif;font-size:10px;color:#000000;">BRACELETES</a></td>
                     <td bgcolor="#FFFFFF" style="padding-left:10px;padding-right:10px;padding-top:5px;border-right:1px solid #666666;padding-bottom:5px;" target="_blank"><a href="http://www.pandorajoias.com.br/aneis-1841.html#1'.$utms.'" style="text-decoration: none;font-family:Arial, Helvetica, sans-serif;font-size:10px;color:#000000;">ANÉIS</a></td>
                     <td bgcolor="#FFFFFF" style="padding-left:10px;padding-right:10px;padding-top:5px;border-right:1px solid #666666;padding-bottom:5px;" target="_blank"><a href="http://www.pandorajoias.com.br/brincos-1837.html#1'.$utms.'" style="text-decoration: none;font-family:Arial, Helvetica, sans-serif;font-size:10px;color:#000000;">BRINCOS</a></td>
                     <td bgcolor="#FFFFFF" style="padding-left:10px;padding-right:10px;padding-top:5px;padding-bottom:5px;" target="_blank"><a href="http://www.pandorajoias.com.br/charms-1838.html#1'.$utms.'" style="text-decoration: none;font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#b62826;"><strong>CHARMS</strong></a></td>
                  </tr>
               </tbody>
            </table>
         </div>
      </center>
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="max-width: 600px;" class="section_title">
         <tr>
            <td align="center" style="font-family: Arial; color: #000000; font-size: 16px; text-transform: uppercase;" valign="middle" height="20"> </td>
         </tr>
      </table>
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="max-width: 600px;">
         <tr>
            <td valign="top" align="center"><a href="http://www.belacenter.com.br/'.$utms.'" style="font-family:Arial; color: #101010; font-size: 16px">
               <img src="images/index_06.jpg" border="0" alt="Banner" style="max-width: 100%; width: auto; display: inline-block; padding: 0; margin: 0; margin-bottom: 5px; padding-left: 2px; padding-right: 2px;" class="product" /></a>
            </td>
         </tr>
      </table>
      <center>
         <div style="max-width: 600px;">
            <table cellpadding="0" cellspacing="0" style="text-align:left;" width="100%" class="borde">
               <tr>
                  <td valign="top" width="100%" align="center">
                    <!--produto1-->
            		'.$pro[0].'
                    <!--produto2-->  
                    	'.$pro[1].'         
                    <!--produto3-->
                    	'.$pro[2].'
                  </td>
               </tr>
            </table>
         </div>
      </center>
      <table width="101%" border="0" align="center" cellpadding="0" cellspacing="0" style="max-width: 600px;" class="section_title">
         <tr>
            <td style="font-family: Arial, Helvetica, sans-serif; color: #666666;padding-top:5px; font-size: 8px; text-transform: uppercase;" valign="middle" height="20">
            </td>
         </tr>
      </table>
      <center>
         <div style="max-width: 600px;">
            <table cellpadding="0" cellspacing="0" style="text-align:left;" width="100%" class="borde">
               <tr>
                  <td valign="top" width="100%" align="center">
                    <!--produto4-->
                    	'.$pro[3].'
                    <!--produto5-->
                    	'.$pro[4].'
                    <!--produto6-->
                    	'.$pro[5].'
                  </td>
               </tr>
            </table>
         </div>
      </center>
      <table width="101%" border="0" align="center" cellpadding="0" cellspacing="0" style="max-width: 600px;" class="section_title">
         <tr>
            <td style="font-family: Arial, Helvetica, sans-serif; color: #666666;padding-top:5px; font-size: 8px; text-transform: uppercase;" valign="middle" height="20">
            </td>
         </tr>
      </table>
      <center>
         <div style="max-width: 600px;">
            <table cellpadding="0" cellspacing="0" style="text-align:left;" width="100%" class="borde">
               <tr>
                  <td valign="top" width="100%" align="right">
                    <!--produto7-->
                    	'.$pro[6].'
                    <!--produto8-->
			'.$pro[7].'
                    <!--produto9-->
                        '.$pro[8].'
                  </td>
               </tr>
            </table>
         </div>
      </center>
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="max-width: 600px;" class="section_title">
         <tr>
            <td style="font-family: Arial, Helvetica, sans-serif; color: #666666;padding-top:5px; font-size: 8px; text-transform: uppercase;" valign="middle" height="20">
            </td>
            <td align="right" valign="top">
            </td>
         </tr>
      </table>
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="max-width: 600px;">
         <tr>
            <td valign="top" align="center"><a href="http://www.belacenter.com.br/'.$utms.'" title="" style="font-family:Arial; color: #101010; font-size: 16px"> 
               <img src="images/banner_footer.jpg" border="0" alt="Banner" style="max-width: 100%; width: auto; display: inline-block; padding: 0; margin: 0; margin-bottom: 5px; padding-left: 2px; padding-right: 2px;" class="product" /></a>
            </td>
         </tr>
      </table>
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
         <td height="10" align="center">
            <table width="auto" border="0" cellspacing="0" cellpadding="0" style="max-width: 600px;">

                            <tr>
        <td><img alt="ilove" border="0" src="http://iloveecommerce.com.br/newsletter/news-02-04-14/logo.gif" style="display: block;padding-right:6px" /></td>
                                <td style="font-family: Arial; color: #9e9e9e; font-size: 10px; text-align: left;">



                                    <p style="margin: 1em 0;">O <a href="http://www.iloveecommerce.com.br" style="color: #fe8b00; text-decoration: none;" target="_blank">ILOVE</a> utiliza imagens criativas arrematadas em pesquisas diárias para a elaboração dos <a href="http://iloveecommerce.com.br/moods" style="color: #fe8b00; text-decoration: none;" target="_blank"><br />
                                    MOODs DO DIA </a>.Portanto, ressaltamos que a grande maioria desse arquivos não são de nossa autoria ou cedidos formalmente para utilização no site. Por favor entre em contato pelo nosso formulário caso seja o autor de alguma imagem utilizada e gostaria que a mesma fosse removida! Prometemos eliminá-la de nossa plataforma no mesmo instante! :-)</p>
                                    <p style="margin: 1em 0;"><span style="color: #555555; font-family: Arial, Arial, Helvetica, sans-serif; font-size: 11px; padding-top: 20px;">Para garantir que nossos comunicados cheguem em sua caixa de entrada, adicione o e-mail <a href="#" style="color: #555555; font-weight: bold; text-decoration: none;" target="_blank">ilove@news.iloveecommerce.com.br</a> ao seu catálogo de endereços. O iLove e-commerce respeita a sua privacidade e é contra o spam na rede.</span></p>
                                    <p style="margin: 1em 0;"><a href="#" style="style="color: #ec008c;text-decoration:none;" target="_blank"><span style="color: #ec008c;">Acesse esse link, se quiser parar de receber nossas novidades, as mais legais da internet!</span></a></p>
                                    <p> </p></td>

                            </tr>

                        </table>
         </td>
      </tr>
   </body>
</html>
</textarea>
</div>';
}
?>

<form action="" method="post">
<table width="0" border="0" align="left">
    <td>Tracking GA</td>
    <td><input type="text" name="utms" class="links" /></td>
    </tr>
    <td>&nbsp;</td>
    <td><textarea name="links" class="links" style="height:350px;"></textarea></td>
    </tr>
<tr>

    <td>&nbsp;</td>
    <td align="right">
        <input name="input" type="submit" value="Fazer a magica" />
    </td>
</tr>
</table>
</form>
</body>
</html>

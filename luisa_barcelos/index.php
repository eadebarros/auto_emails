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
        width:400px;
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


function linksprodutos($link,$utms,$num){
$opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
$context = stream_context_create($opts);

$pagina = html_entity_decode(file_get_contents($link,false,$context));
$produto = explode('<h1 class="name fn">',$pagina);
$produto = explode('</h1>',$produto[1]);

$depor = explode('<span id="lblPrecos" class="offers">',$pagina);
$depor = explode('</span>',$depor[1]);

$depor = array_filter($depor);

if(!empty($depor[0]) || $depor[0] = "") {
    $preco = explode('<span id="lblPrecoPor" class="price sale">por <strong>',$pagina);
    $preco = explode('</strong>',$preco[1]);
    //$preco[0] = str_replace("por"," ",$preco[0]);
}else{
    $preco = explode('<span id="lblPrecoPor" class="price sale">por <strong>',$pagina);
    $preco = explode('</strong>',$preco[1]);
    //$preco[0] = str_replace("por"," ",$preco[0]);
}


$d = explode('<span id="lblParcelamento1"><strong>',$pagina);
$d = explode('<span id="lblOutroParc" class="interest"></span>',$d[1]);

$d = strip_tags($d[0]);
$d = str_replace("de", "", $d);
$d = explode("R$", $d);

$parcel = explode('<span id="lblParcelamento2"> <strong>',$pagina);
$parcel = explode('</strong>', $parcel[1]);

$img = explode('<img id="ProdutoImagemAux" name="ProdutoImagemAux" src="',$pagina);
$img = explode('"',$img[1]);	

copy($img[0], 'images/'.$num.'.jpg');

WideImage::load('images/'.$num.'.jpg')->resize(160, 160)->saveToFile('images/'.$num.'.jpg');
return '
<span style="display: inline-block; width: 190px; vertical-align: middle;" class="product" id="ipad">

      <div style="width: 100%; overflow: hidden; padding-top: 15px; padding-bottom: 10px; text-align: center;">
          <a href="'.$link.$utms.'" title="'.$produto[0].'" style="font-size: 17px; font-family: Verdana, sans-serif; color: #010101;">
          <img src="images/'.$num.'.jpg" alt="'.$produto[0].'" border="0" style="margin: 0; padding: 0;" /></a>
      </div>
      
      <div style="width: 100%; overflow: hidden; font-family: Verdana, sans-serif;text-transform:Capitalize; font-weight: bold; font-size: 12px; text-align: center; color: #616161; padding-bottom: 0px; line-height: 18px;">
      '.$produto[0].'
      </div>
      
      <div style="width: auto; overflow: hidden; font-family: Verdana, sans-serif; font-size: 11px; color: #474646; text-align: center; line-height: 15px;">
      	'.$de = ($depor[0] != "" ? 'de <del>'.$depor[0] .'</del>' : '&nbsp;').'
      </div>
      <div style="width: auto; overflow: hidden; font-family: Verdana, sans-serif; font-size: 11px; color: #474646; text-align: center; line-height: 15px;">
       por <span style="color:#000000;"><strong>'.$preco[0].'</strong></span>
      </div>
      
      <div style="width: 100%; overflow: hidden; font-family: Verdana, sans-serif; font-weight: bold;font-size: 12px; color: #8b040b; text-align: center; padding-bottom: 2px;">
      	'.$d[0].'<span style="color:#606060">de</span> R$'.$d[1].'
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

  $linkHeader = $_POST['link_header'];
  $linkBanner = $_POST['link_banner'];
  $validade = $_POST['validade_propomo'];
  $linkBanner = trim($linkBanner);
  $linkHeader = trim($LinkHeader);
  
    if(!empty($linkBanner)) {
      $havePromo =  
       '<td valign="top" align="center"><a href="'.$linkBanner.preg_replace("/&/", "?", $utms,1).'" title="" style="font-family:Arial; color: #101010; font-size: 16px"> 
          <img src="images/banner_footer.jpg" border="0" alt="Banner" style="max-width: 100%; width: auto; display: inline-block; padding: 0; margin: 0; margin-bottom: 5px; padding-left: 2px; padding-right: 2px;" class="product" /></a>
        </td>';
    } else {
       $havePromo = 
        '<td valign="top" align="center">
           &nbsp;
        </td>';
    } 

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
      <custom name="opencounter" type="tracking">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="max-width: 600px;" class="section_title">
         <tr>
            <td align="center" valign="top" height="10">
               <p style="text-align:center;color:#666666;font-size:10px;font-family:Arial, Helvetica, sans-serif">Se não conseguir visualizar corretamente esta mensagem, <a href="%%view_email_url%%" style="color: #000000; font-family: arial, helvetica, sans-serif; font-size: 11px;">acesse este link</a></p>
            </td>
         </tr>
      </table>
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="max-width: 600px;">
         <tr>
            <td valign="top" align="center">                  
               <img src="images/index_03.jpg" border="0" alt="Logo" style="max-width: 186px; width: auto; display: inline-block; padding: 0; margin: 0; margin-bottom: 15px; padding-left: 2px; padding-right: 2px;" />
            </td>
         </tr>
      </table>
      <center>
         <div style="max-width:600px;overflow:hidden;background-color:#FFFFFF;">
            <table style="max-width:600px;" align="center" border="0" bgcolor="#000000" cellpadding="0" cellspacing="0" width="auto">
               <tbody>
                  <tr>
                     <td align="right" bgcolor="#FFFFFF" style="padding-left:10px;padding-right:10px;border-right:1px solid #666666;padding-top:5px;padding-bottom:5px;" target="_blank"><a href="http://loja.luizabarcelos.com.br/sandalias-3.aspx/u'.preg_replace("/&/", "?", $utms,1).'" style="text-decoration: none;font-family:Arial, Helvetica, sans-serif;font-size:10px;color:#000000;">SANDÁLIAS</a></td>
                     <td bgcolor="#FFFFFF" style="padding-left:10px;padding-right:10px;padding-top:5px;border-right:1px solid #666666;padding-bottom:5px;" target="_blank"><a href="http://loja.luizabarcelos.com.br/sapatos-2.aspx/u'.preg_replace("/&/", "?", $utms,1).'" style="text-decoration: none;font-family:Arial, Helvetica, sans-serif;font-size:10px;color:#000000;">SAPATOS</a></td>
                     <td bgcolor="#FFFFFF" style="padding-left:10px;padding-right:10px;padding-top:5px;border-right:1px solid #666666;padding-bottom:5px;" target="_blank"><a href="http://loja.luizabarcelos.com.br/bolsas-7.aspx/u'.preg_replace("/&/", "?", $utms,1).'" style="text-decoration: none;font-family:Arial, Helvetica, sans-serif;font-size:10px;color:#000000;">BOLSAS</a></td>
                     <td bgcolor="#FFFFFF" style="padding-left:10px;padding-right:10px;padding-top:5px;border-right:1px solid #666666;padding-bottom:5px;" target="_blank"><a href="http://loja.luizabarcelos.com.br/sapatilhas-4.aspx/u'.preg_replace("/&/", "?", $utms,1).'" style="text-decoration: none;font-family:Arial, Helvetica, sans-serif;font-size:10px;color:#000000;">SAPATILHAS</a></td>
                     <td bgcolor="#FFFFFF" style="padding-left:10px;padding-right:10px;padding-top:5px;padding-bottom:5px;" target="_blank"><a href="http://loja.luizabarcelos.com.br/sale-137.aspx/u'.preg_replace("/&/", "?", $utms,1).'" style="text-decoration: none;font-family:Arial, Helvetica, sans-serif;font-size:12px;color:#b62826;"><strong>SALE</strong></a></td>
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
            <td valign="top" align="center"><a href="'.$LinkHeader.preg_replace("/&/", "?", $utms,1).'" style="font-family:Arial; color: #101010; font-size: 16px">
               <img src="images/header.jpg" border="0" alt="Banner" style="max-width: 100%; width: auto; display: inline-block; padding: 0; margin: 0; margin-bottom: 5px; padding-left: 2px; padding-right: 2px;" class="product" /></a>
            </td>
         </tr>
      </table>
      <!--<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="max-width: 600px;" class="section_title">
         <tr>
            <td align="center" style="font-family: Arial; color: #000000; font-size: 16px; text-transform: uppercase;" valign="middle" height="20"><img src="images/fg_kallan.jpg" border="0" alt="Frete Info" style="max-width: 100%; width: auto; display: inline-block; padding: 0; margin: 0; margin-bottom: 5px; padding-left: 2px; padding-right: 2px;" class="product" /> </td>
         </tr>
         </table>-->
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
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="max-width: 600px;">
  <tbody><tr>
    <td valign="top" align="center">
      <a href="#" title="Luisa Barcelos" style="font-family:Arial; color: #101010; font-size: 16px"> 
        <img src="" border="0" alt="Banner" style="max-width: 100%; width: auto; display: inline-block; padding: 0; margin: 0; margin-bottom: 5px; padding-left: 2px; padding-right: 2px;" class="product">
      </a>
    </td>
  </tr>
</tbody></table>
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
         <tr>'
          . $havePromo . '
         </tr>
      </table>
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
         <td height="10" align="center">
            <table width="auto" border="0" cellspacing="0" cellpadding="0" style="max-width: 600px;">
               <tr>
                  <td>&nbsp;</td>
                  <td style="font-family:Verdana, Geneva, sans-serif; color:#6c6c6c; font-size:10px;">
                  <p><strong>Oferta válida até '. $validade . ' às 23h59 (horário de Brasília) e sujeitas à disponibilidade de estoque<br />
                     <p><strong><br />
                        Aten&ccedil;&atilde;o:</strong><br>
                        Para  garantir o recebimento de nossos informativos adicione o endere&ccedil;o <a href="mailto:atendimentoweb@kallan.com.br" style="text-decoration:none; color:#c73336">atendimentoweb@kallan.com.br</a><a href="mailto:noreply@kallan.com.br" style="text-decoration:none; color:#c73336"></a> a sua lista de contatos confi&aacute;veis ou marque este informativo como  confi&aacute;vel e continue aproveitando nossas ofertas.<br />
                     </p>
                     <p><strong>Regulamento: </strong>As promo&ccedil;&otilde;es deste  informativo s&atilde;o v&aacute;lidas apenas para as compras via internet, em caso de diferen&ccedil;a de pre&ccedil;os entre o informativo e o site, ser&aacute; praticada a condi&ccedil;&atilde;o oferecida no site. Para compras online, aceitamos cart&otilde;es Visa,  mastercard, Diners, American Express e ELO. Ou pague &agrave; vista com d&eacute;bito online  expresso Bradesco e Ita&uacute; ou no Boleto Banc&aacute;rio. O Kallan Card &eacute; aceito somente  em nossas lojas f&iacute;sicas, <a href="http://www.kallan.com.br/" style="text-decoration:none; color:#c73336">veja nossos endere&ccedil;os</a>.</p>
                     <p>(*) Frete zero apenas para as regiões Sul e Sudeste do Brasil nas compras acima de R$ 99,00. </p>
                     <p>Todas as  promo&ccedil;&otilde;es n&atilde;o s&atilde;o cumulativas, este &eacute; um informativo autom&aacute;tico, por favor n&atilde;o  o responda. Para esclarecer d&uacute;vidas ou enviar sugest&otilde;es acesse nossa <a href="http://www.kallan.com.br/" style="text-decoration:none; color:#c73336">Central de  Atendimento</a>. Confira o <a href="http://www.kallan.com.br/" style="text-decoration:none; color:#c73336">regulamento</a> de Frete Zero* em  nosso site. Todas as imagens dois produtos s&atilde;o de car&aacute;ter ilustrativo e n&atilde;o definem  o tamanho real do produto ou exata defini&ccedil;&atilde;o das suas cores. Itens decorativos  n&atilde;o acompanham os produtos.</p>
                     <p>Para deixar de receber nossos e-mails <a href="%%unsub_center_url%%">clique aqui</a><br />
                       <br />
                     </p>
                  </td>
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
<tr>
    <td>Tracking GA</td>
    <td><input type="text" name="utms" class="links" /></td>
</tr>
<tr>
    <td>Produtos</td>
    <td><textarea name="links" class="links" style="height:400px;"></textarea></td>
</tr>
    <tr>
      <td>Validade da Promoção:</td>      
      <td><input type="text" name="validade_propomo" class="links" id="" /></td>
    </tr>
    <tr>
      <td>Link header:</td>      
      <td><input type="text" name="link_header" class="links" id="" /></td>
    </tr>
    <tr>
      <td>Link Banner Footer:</td>      
      <td><input type="text" name="link_banner" class="links" id="" /></td>
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

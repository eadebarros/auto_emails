<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ultra PHP</title>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
</head>

<body>
<?php
error_reporting('E_WARNING');
set_time_limit(3000);
require('include/WideImage.php');

function linksprodutos($link,$num){

$pagina = html_entity_decode(file_get_contents($link));

$curso = explode('<small class="subtitle">',$pagina);
$curso = explode('</small>',$curso[1]);
$curso = str_replace('<small class="author">',"",$curso[1]);
$curso = explode('<br>',$curso);


$data = explode('<p class="save-the-date">',$pagina);
$data = explode('</p>',$data[1]);

$texto = explode('<div class="group group-info">',$pagina);
$texto = explode('</p>',$texto[2]);



$autor = explode('<small class="author">com',$pagina);
$autor = explode('</small>',$autor[1]);

$d = strip_tags($d[0]);

echo '
    <script>
        $(document).ready(function(){
            //$(".author").remove("a");
        });
    </script>
<table width="0" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="580" style="font-family: Arial; font-size:13px; color:#7c7c7c"><p><span style="color:#000000;font-size:16px;font-weight:bold;">Olá, %%first_name%%,</span><br>
                      <br />
		    Novidades nos <span style="color:#ff5400;font-weight:bold;">CURSOS AO VIVO</span> da eduK: <strong>'.$curso[1].' com '.strip_tags($autor[0]) .'</strong></p>
                      <p><a href="'.$link.'" target="_blank"><center><img src="http://jotacomdigital.com.br/clientes/eduk/2014/jun/27-06/01/images/video.jpg" width="288" height="196" alt="'.$curso[1].'" style="display:block;border: none;" /></center></a><br>
                        <span style="color:#ff5400;font-weight:bold;">'.$data[0].'</span> <br>
                        <br>
                        '.$texto[0].'<br>
                        Isso tudo por <strong><span style="color:#ff5400;font-weight:bold;">GRATUITAMENTE.</span></strong>                      
                      <p>Aprenda e deixe-se surpreender com as t&eacute;cnicas e a criatividade das pe&ccedil;as!<br>
                        <br />
                      </p>
                      <table width="0" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td width="83"><img src="http://jotacomdigital.com.br/clientes/eduk/2014/jun/27-06/01/images/pessoa.jpg" alt="" width="69" height="72" style="display:block;border: none;" /></td>
                          <td width="375"  style="font-family:Arial, Helvetica, sans-serif; font-size:10px; font-style:italic;">'.strip_tags($autor[0]).'<br>
                            Expert do curso '.$curso[1].'</td>
                        </tr>
        </table>
                      <p style="color:#000000;"><strong>E lembre-se: Sucesso &eacute; aprender sermpre</strong></p>
                      <p><a href="'.$link.'"><img src="http://jotacomdigital.com.br/clientes/eduk/2014/jun/27-06/01/images/apagina.jpg" width="226" height="43" alt="Reserve Agora seu lugar!" style="display:block;border: none;" /></a>
                      </p>
                      <table width="581" height="186" border="0" align="center" cellpadding="0" cellspacing="0" >
                        <tr>
		<td width="348" height="77" colspan="2" rowspan="2" bgcolor="#FFFFFF"><table width="0" border="0" align="center" cellpadding="0" cellspacing="0">
		  <tr>
		    <td width="340"  style="font-family:Arial, Helvetica, sans-serif; font-size:13px;"><strong>Veja o v&iacute;deo das aulas gratuitamente:</strong><br>
		      <a href="http://www.eduk.com.br/ao-vivo/" target="_blank" style="color:#ff5400">http://www.eduk.com.br/ao-vivo</a></td>
		    </tr>
		  </table></td>
		<td rowspan="2">
			<img src="http://jotacomdigital.com.br/clientes/eduk/2014/jun/27-06/01/images/fot_02.jpg" width="23" height="77" alt="imagem" style="display:block;border: none;" /></td>
		<td>
			<img src="http://jotacomdigital.com.br/clientes/eduk/2014/jun/27-06/01/images/fot_03.jpg" width="177" height="26" alt="imagem" style="display:block;border: none;" /></td>
		<td rowspan="2">
			<img src="http://jotacomdigital.com.br/clientes/eduk/2014/jun/27-06/01/images/fot_04.jpg" width="33" height="77" alt="imagem" style="display:block;border: none;" /></td>
  </tr>
	<tr>
		<td width="177" height="51" align="center" bgcolor="#0abd16" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#FFF;"><strong>DOMINE O SEU EXCEL.</strong></td>
  </tr>
	<tr>
		<td colspan="5">
			<img src="http://jotacomdigital.com.br/clientes/eduk/2014/jun/27-06/01/images/fot_06.jpg" width="581" height="16" alt="imagem" style="display:block;border: none;" /></td>
	</tr>
	<tr>
	  <td>
			<img src="http://jotacomdigital.com.br/clientes/eduk/2014/jun/27-06/01/images/fot_07.jpg" width="42" height="85" alt="imagem" style="display:block;border: none;" /></td>
		<td  width="506" height="85" colspan="3" bgcolor="#DBD7D6" ><table width="480" border="0" align="center" cellpadding="0" cellspacing="0">
		  <tr>
		    <td height="39"  style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#707071;"><p>N&uacute;meros, f&oacute;rmulas e gr&aacute;ficos s&atilde;o aliados poderosos para tomar as melhores decis&otilde;es para o seu neg&oacute;cio e s&atilde;o f&aacute;ceis de entender quando se tem dom&iacute;nio do Excel.</p>
		      </td>
		    </tr>
		  </table></td>
		<td>
			<img src="http://jotacomdigital.com.br/clientes/eduk/2014/jun/27-06/01/images/fot_09.jpg" width="33" height="85" alt="imagem" style="display:block;border: none;" /></td>
	</tr>
	<tr>
		<td colspan="5">
			<img src="http://jotacomdigital.com.br/clientes/eduk/2014/jun/27-06/01/images/fot_10.jpg" width="581" height="7" alt="imagem" style="display:block;border: none;" /></td>
	</tr>
	<tr>
		<td>
			<img src="http://jotacomdigital.com.br/clientes/eduk/2014/jun/27-06/01/images/spacer.gif" width="42" height="1" alt="imagem" style="display:block;border: none;" /></td>
		<td>
			<img src="http://jotacomdigital.com.br/clientes/eduk/2014/jun/27-06/01/images/spacer.gif" width="306" height="1" alt="imagem" style="display:block;border: none;" /></td>
		<td>
			<img src="http://jotacomdigital.com.br/clientes/eduk/2014/jun/27-06/01/images/spacer.gif" width="23" height="1" alt="imagem" style="display:block;border: none;" /></td>
		<td>
			<img src="http://jotacomdigital.com.br/clientes/eduk/2014/jun/27-06/01/images/spacer.gif" width="177" height="1" alt="imagem" style="display:block;border: none;" /></td>
		<td>
			<img src="http://jotacomdigital.com.br/clientes/eduk/2014/jun/27-06/01/images/spacer.gif" width="33" height="1" alt="imagem" style="display:block;border: none;" /></td>
	</tr>
    <tr>
    	<td>
        	
        </td>
    </tr>
</table>
                      
                      
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

		$pro[] = linksprodutos($l,$i);	

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
</table>




';

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

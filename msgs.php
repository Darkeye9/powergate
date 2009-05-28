<?php 
session_start();
include("mysqlcon.php");
if ($_POST['op']=="send")
{ 
$texto=$_POST['texto'];
$allowedTags='<strong><em><u><br><ul><ol><li>';
$texto=str_replace("<p>","",$texto);
$texto=str_replace("</p>","<br />",$texto);
$texto = strip_tags(stripslashes($texto),$allowedTags);
$para=$_POST['para'];
$de=$_SESSION['username'];
$asunto=$_POST['asunto'];
send_msg($de, $para, $asunto, $texto);
echo "msgok";
exit();
}
if ($_POST['op']=="delete")
{
delete_msg($_POST['mid'], $_SESSION['username']);
echo "msgdeleted";
exit();
}
if ($_GET['op']=="updatemsg")
{
echo new_msgs($_SESSION['username']);
exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="JSq/php.js"></script>
<script type="text/javascript" src="Jsq/jquery.js"></script>
<script type="text/javascript" src="JSq/JSui/jquery-ui.js"></script>
<script type="text/javascript" src="JSq/context/jquery.contextmenu.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
$(".redactar_area").hide();


  var menu4 = [ 
	{'Borrar':{ onclick:function(menuItem,menu) {
	var id = $(this).attr("id");
		id=substr(id, 4);  
	$.post("msgs.php", { op: "delete", mid: id },
		 function(data){
		 				if(data!="msgdeleted") {alert(data);}else{
						$(".header_"+id).hide("explode");
						$(".content_"+id).hide("explode");
						setTimeout(function(){$(".header_"+id).remove();$(".content_"+id).remove();},700); 
						}
						});
	}, icon:'icons/contx_abrir.png', disabled:false }},
	
	{'Responder':{ onclick:function(menuItem,menu) {
	var id = $(this).attr("id");
		id=substr(id, 4);  
	var remite = base64_decode($(".remite_"+id).attr("id"));
	var asunto = "RE: "+$(this).text();
	document.redactar.field_para.value = remite;
	document.redactar.field_asunto.value = asunto;
	if($(".redactar_area").is(":hidden")){setTimeout(function(){tinyMCE.execCommand('mceAddControl', false, 'field_texto');},1200);$(".redactar_area").show("blind", {}, 1000)};
	}, icon:'icons/contx_abrir.png', disabled:false }}

	];
  
   $(function() { $('.min').contextMenu(menu4); });
  
  
  $(".min").click(function () { 
  		var id = $(this).attr("id");
		id=substr(id, 4);
      $(".content_"+id).toggle("blind", {}, 1000);
    });
	
	 $(".redactar").click(function () { 
	 if($(".redactar_area").is(":visible")){tinyMCE.execCommand('mceRemoveControl', false, 'field_texto');};
  		if($(".redactar_area").is(":hidden")){setTimeout(function(){tinyMCE.execCommand('mceAddControl', false, 'field_texto');},1200);}
		$(".redactar_area").toggle("blind", {}, 1000);
	
    });
	
	 $(".borrartodos").click(function () { 
	
	
    });
	
	 $(".field_enviar").click(function () { 
	 tinyMCE.triggerSave();
		 $.post("msgs.php", { op: "send", para: document.redactar.field_para.value, asunto: document.redactar.field_asunto.value, texto: document.redactar.field_texto.value },
		 function(data){
		 				if(data=="msgok") {tinyMCE.execCommand('mceRemoveControl', false, 'field_texto');$(".redactar_area").toggle("blind", {}, 1000);}
						});
																		 

    });
 
   });
  </script>
  <script type="text/javascript" src="JSq/tiny_mce/tiny_mce_gzip.js"></script>
<script type="text/javascript">
tinyMCE_GZ.init({
mode : "none",
	theme : "simple"
});
</script>
<script type="text/javascript">
tinyMCE.init({
	mode : "none",
	theme : "simple"
});
</script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Mensajes</title>
<style type="text/css">
<!--
@import url("JSq/theme/azul/ui.all.css");
@import url("JSq/mbMenu/css/menu1.css");
@import url("JSq/context/jquery.contextmenu.css");
body {
	background-image:url(images/trans.png)
}
.netws {
	background-image: url(JSq/mbMenu/header_bgnd.jpg);
}
.min
{cursor:default

}
-->
</style></head>

<body>
<img src="icons/mensaje.png" width="50" height="48" />
<br />
<hr />
<table width="200" border="0">
  <tr>
    <td width="68"><label>
      <input class="redactar" type="submit" name="button" id="button" value="Redactar" />
    </label></td>
    <td width="122"><label>
      <input class="borrartodos" type="submit" name="button2" id="button2" value="Borrar Todos" />
    </label></td>
  </tr>
</table>
<div class="redactar_area"> <form name="redactar">
  <table width="200" border="0">
   
    <tr>
      <td><label>Para: </label></td>
      <td><input type="text" name="field_para" id="field_para" /></td>
    </tr>
    <tr>
      <td><label>Asunto: </label></td>
      <td><input type="text" name="field_asunto" id="field_asunto" /></td>
    </tr>
  </table>
  <p>
    <label>
    <textarea name="field_texto" id="field_texto" cols="45" rows="5"></textarea>
    </label>
  </p>
  <p>
    <label>
    <input class="field_enviar" type="button" name="field_enviar" id="field_enviar" value="Enviar" />
    </label>
    
  </p></form>
</div>
<p>
  <?php
$result = get_user_msgs($_SESSION['username']);
while ($msg=mysql_fetch_array($result))
{
$emisor_info=get_user_info($msg['emisor']);
echo '<div class="ui-widget ui-corner-all">';
if ($msg['leido']==0)
{
echo '<div id="header_'. $msg['id'] .'" class="header_'. $msg['id'] .' ui-widget-header ui-corner-all"><u><i><span class="min" id="min_'. $msg['id'] .'">'. $msg['titulo'] .'</span></u></i>&nbsp;&nbsp;&nbsp;&nbsp;<span class="remite_'. $msg['id'] .'" id="'. base64_encode($emisor_info['username']) .'">De: '. $emisor_info['username'] .'</span></div>';
marcar_msg_leido($_SESSION['username'],$msg['id']);
}else
{
echo '<div class="header_'. $msg['id'] .' ui-widget-header ui-corner-all"><i><span class="min" id="min_'. $msg['id'] .'">'. $msg['titulo'] .'</span></i>&nbsp;&nbsp;&nbsp;&nbsp;<span class="remite_'. $msg['id'] .'" id="'. base64_encode($emisor_info['username']) .'">De: '. $emisor_info['username'] .'</span></div>';
}
echo '<div class="content_'. $msg['id'] .' ui-corner-all">';
echo $msg['texto'];
echo '</div>';
echo '</div>';
}
?>
</p>
</body>
</html>

<?php 
include("mysqlcon.php");
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="JSq/php.js"></script>
<script src="Jsq/jquery.js"></script>
<script src="JSq/winlike/winman/winxtra.js"></script>
<script src="JSq/JSui/jquery-ui.js"></script>
<script type="text/javascript" src="JSq/context/jquery.contextmenu.js"></script>
<script>
 $(document).ready(function(){
				var menu4 = [ 
	{'Abrir':{ onclick:function(menuItem,menu) { $(this).dblclick(); }, icon:'icons/contx_abrir.png', disabled:false } },
	
	
	{'Borrar':{ onclick:function(menuItem,menu) {
	 if(confirm('Esta seguro?\r\nEsta acción no tiene marcha atrás'))
	 { 
	var softn = $(this).attr("class");
	softn=substr(softn,11);   
	$.get("adminsoft.php", {op: "borrar", soft: softn  },  function(data){if(strpos(data, "Error")==false){
																												$(".soft_"+softn).hide("explode");
																												setTimeout(function(){$(".soft_"+softn).remove();},700);
																												}else
																												{
																												alert(data);
																												}});}
	}, icon:'icons/contx_abrir.png', disabled:false }},
	
	
	
	
	
	
	
	
	{'Vender':{ onclick:function(menuItem,menu) { $(this).dblclick(); }, icon:'icons/contx_abrir.png', disabled:false } }
	];
	
	
	
	
	
	 $(function() { $('.icono').contextMenu(menu4); });

	
	place=recognizeWinLIKE_(top);
	$(".header_defensa").click(function () { 
      $(".defensa").toggle("blind", {}, 1000);
    });
	$(".header_juegos").click(function () { 
      $(".juegos").toggle("blind", {}, 1000);
    });
	$("#boton_barra").click(function () { 
      $("#barra").toggle("drop", {}, 1000);
    });
 <?php 
 $result = get_user_softs($_SESSION['username']);
 while ($softs=mysql_fetch_array($result))
{
$info = get_soft_info($softs['sid']);
  echo "$('.soft_". $info['id'] ."').dblclick(function () { place.WinLIKE.openaddress('". $info['url'] ."',null,'soft_". $info['id'] ."'); });";
 }
 
 ?>
  });

</script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Programas</title>
<style type="text/css">
<!--
@import url("JSq/mbMenu/css/menu1.css");
@import url("JSq/theme/azul/ui.all.css");
@import url("JSq/context/jquery.contextmenu.css");
body {
	background-image:url(images/trans.png)
}
.defensa {
	background-image: url(JSq/mbMenu/header_bgnd.jpg);
}
.juegos {
	background-image: url(JSq/mbMenu/header_bgnd.jpg);

}
-->
</style>

</head>

<body>
 <h2><strong><img src="icons/programas.png" width="48" height="48" /></strong>
   <br />
<hr>
</h2>
<div class="ui-widget ui-corner-all">
<div class="header_defensa ui-widget-header ui-corner-all">Defensa</div>
<div class="defensa ui-corner-all">
<?php 
$result = get_user_softs($_SESSION['username']);


 echo '<table border="0">';
 echo '<tr>';
while ($softs=mysql_fetch_array($result))
{
$info = get_soft_info($softs['sid']);
if ($info['tipo'] == "defensa")
{
  echo '<td><p align="center"><div align="center" class="icono soft_'. $info['id'] .'"><img src="icons/'. $info['icono'] .'" width="64" height="64"/><br />'. $info['nsoft'] .'<br />v'. $info['ver'] .'</div></p></td>';
} 
}
   echo '</tr>';
   echo '</table>';
   
   ?>
</div>
</div>
<p></p>
<div class="ui-widget ui-corner-all">
<div class="header_juegos ui-widget-header ui-corner-all">Juegos</div>
<div class="juegos ui-corner-all">
<?php
 echo '<table border="0">';
 echo '<tr>';
 $result = get_user_softs($_SESSION['username']);
while ($softs=mysql_fetch_array($result))
{
$info = get_soft_info($softs['sid']);
if ($info['tipo'] == "juego")
{
	
  echo '<td><p align="center"><div align="center" class="icono soft_'. $info['id'] .'"><img src="icons/'. $info['icono'] .'" width="64" height="64" /><br />'. $info['nsoft'] .'<br />v'. $info['ver'] .'</div></p></td>';
} 
}
   echo '</tr>';
   echo '</table>';
   
   ?>
</div>
</div>
</body>
</html>
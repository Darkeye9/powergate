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
	var hardn = $(this).attr("class");
	hardn=substr(hardn,11);   
	$.get("adminhard.php", {op: "borrar", hard: hardn  },  function(data){if(strpos(data, "Error")==false){
																												$(".hard_"+hardn).hide("explode");
																												setTimeout(function(){$(".hard_"+hardn).remove();},700);
																												}else
																												{
																												alert(data);
																												}});}
	}, icon:'icons/contx_abrir.png', disabled:false }},
	
	
	
	
	
	
	
	
	{'Vender':{ onclick:function(menuItem,menu) { $(this).dblclick(); }, icon:'icons/contx_abrir.png', disabled:false } }
	];
	
	
	
	
	
	 $(function() { $('.icono').contextMenu(menu4); });

	
	place=recognizeWinLIKE_(top);
	$(".header_hdds").click(function () { 
      $(".hdds").toggle("blind", {}, 1000);
    });
	$(".header_netws").click(function () { 
      $(".netws").toggle("blind", {}, 1000);
    });
	$("#boton_barra").click(function () { 
      $("#barra").toggle("drop", {}, 1000);
    });
 <?php 
 $result = get_user_hards($_SESSION['username']);
 while ($hards=mysql_fetch_array($result))
{
$info = get_hard_info($hards['hid']);
  echo "$('.hard_". $info['id'] ."').dblclick(function () { place.WinLIKE.openaddress('". $info['url'] ."',null,'hard_". $info['id'] ."'); });";
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
.hdds {
	background-image: url(JSq/mbMenu/header_bgnd.jpg);
}
.netws {
	background-image: url(JSq/mbMenu/header_bgnd.jpg);

}
-->
</style>

</head>

<body>
 <h2><strong><img src="icons/mipc.png" width="48" height="48" /></strong>
   <br />
<hr>
</h2>
<div class="ui-widget ui-corner-all">
<div class="header_hdds ui-widget-header ui-corner-all">Discos Duros</div>
<div class="hdds ui-corner-all">
<?php 
$result = get_user_hards($_SESSION['username']);


 echo '<table border="0">';
 echo '<tr>';
while ($hards=mysql_fetch_array($result))
{
$info = get_hard_info($hards['hid']);
if ($info['tipo'] == "drive")
{
  echo '<td><p align="center"><div align="center" class="icono hard_'. $info['id'] .'"><img src="icons/'. $info['icono'] .'" width="64" height="64"/><br />'. $info['nhard'] .'<br />'. $info['modelo'] .'</div></p></td>';
} 
}
   echo '</tr>';
   echo '</table>';
   
   ?>
</div>
</div>
<p></p>
<div class="ui-widget ui-corner-all">
<div class="header_netws ui-widget-header ui-corner-all">Internet</div>
<div class="netws ui-corner-all">
<?php
 echo '<table border="0">';
 echo '<tr>';
 $result = get_user_hards($_SESSION['username']);
while ($hards=mysql_fetch_array($result))
{
$info = get_hard_info($hards['hid']);
if ($info['tipo'] == "netw")
{
	
  echo '<td><p align="center"><div align="center" class="icono hard_'. $info['id'] .'"><img src="icons/'. $info['icono'] .'" width="64" height="64" /><br />'. $info['nhard'] .'<br />'. $info['modelo'] .'</div></p></td>';
} 
}
   echo '</tr>';
   echo '</table>';
   
   ?>
</div>
</div>
</body>
</html>

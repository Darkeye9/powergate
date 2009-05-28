<?php 
	session_start();
	include("mysqlcon.php");
	
	if (isset($_GET['op']))
{
$op=$_GET['op'];
$user=$_SESSION['username'];
$mid=$_GET['ms'];
switch ($op)
{
case "abandonar":
abandonar_ms($mid, $user);
exit();

case "aceptar":
aceptar_ms($mid, $user);
exit();

}



}
function showcont($time, $id)
{
echo '<script   type="text/javascript">
                v=new Date();
				var notif_'. $id .'=0;
                function t_'. $id .'(){
                	n=new Date();
                	ss='. $time .';
                	s=ss-Math.round((n.getTime()-v.getTime())/1000.);
                	m=0;h=0;
                	if(s<0){
                		$("#time_'. $id .'").html("<font color=red>-</font>");
                	}else{
                		if(s>59){
                			m=Math.floor(s/60);
                			s=s-m*60
                		}
                		if(m>59){
                			h=Math.floor(m/60);
                			m=m-h*60
                		}
                		if(s<10){
                			s="0"+s
                		}
                		if(m<10){
                			m="0"+m
                		}
                		$("#time_'. $id .'").html(h+":"+m+":"+s+"<br>");                	}
                	;
                	window.setTimeout("t_'. $id .'();",999);
                }
				  $(document).ready(function(){t_'. $id .'();});
                
                </script>';


}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Mis misiones</title>
<script src="JSq/php.js"></script>
<script src="Jsq/jquery.js"></script>
<script src="JSq/JSui/jquery-ui.js"></script>
<script type="text/javascript" src="JSq/context/jquery.contextmenu.js"></script>
<script>

var menu4 = [ 

	{'Abandonar':{ onclick:function(menuItem,menu) {
	 if(confirm('Esta seguro?\r\nEsta acción no tiene marcha atrás'))
	 { 
	var msn = $(this).attr("class");
	msn=substr(msn,9);   
	$.get("misions.php", { op: "abandonar", ms: msn  },  function(data){if(strpos(data, "Error")==false){
																												$(".ms_"+msn).hide("explode");
																												setTimeout(function(){$(".ms_"+msn).remove();},700);
																												}});}
	}, icon:'icons/contx_abrir.png', disabled:false }}
	
	];
	
	
	
	
	
	 $(function() { $('.icono').contextMenu(menu4); });
</script>
<style type="text/css">
<!--
@import url("JSq/mbMenu/css/menu1.css");
@import url("JSq/theme/azul/ui.all.css");
@import url("JSq/context/jquery.contextmenu.css");
body {
	background-image: url(images/trans.png);
}
.ms {	background-image: url(JSq/mbMenu/header_bgnd.jpg);
}
-->
</style></head>

<body>
<h2><strong><img src="images/mision.png" alt="" width="110" height="110" /></strong> <br />
    <hr />
</h2>
<div class="ui-widget ui-corner-all">
  <div class="header_ms ui-widget-header ui-corner-all">Misiones</div>
  <div class="ms ui-corner-all">
    <?php 
$result = get_user_ms($_SESSION['username']);


 echo '<table border="0">';
 echo '<tr>';
while ($ms=mysql_fetch_array($result))
{
$einfo=get_empresa_info($ms['objetivo']);
showcont($ms['final']-mktime(), $ms['id']);
  echo '<td><p align="center"><div align="center" class="icono ms_'. $ms['id'] .'"><img src="images/mision.png" width="64" height="64"/><br />'. $einfo['nombre'] .'<br />Nivel: '. $ms['nivel'] .'<br /><span id="time_'. $ms['id'] .'">--</span></div></p></td>';
}
   echo '</tr>';
   echo '</table>';
   
   ?>
  </div>
</div>
<p></p>
</body>
</html>

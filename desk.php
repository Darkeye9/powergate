<?php 
     include("mysqlcon.php");
	 session_start();
	 
	 
if ($_GET['op']=="savewin")
{
windows_save($_SESSION['username'],$_GET['wdata']);
exit();
}
?>
<html>
<head>
<!-- WinLIKE (c) 1998-2007 by CEITON technologies GmbH - www.winlike.net -->
<!-- Change this source for older browsers! --><SCRIPT>WinLIKEerrorpage='JSq/winlike/winman/hlp-error.html';</SCRIPT>
<SCRIPT SRC="JSq/winlike/winman/wininit.js"></SCRIPT><SCRIPT SRC="JSq/winlike/winman/winman.js"></SCRIPT>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Power Gate</title>
<SCRIPT>
	WinLIKE.definewindows=mydefs;
	function mydefs() {
	<?php
echo windows_load($_SESSION['username']);
?>

				// do not remove this comment line, otherwise the following line will uncommented by the end of the WinLIKE string--just the HTML code in the Browser
	}
</SCRIPT>
<script type="text/javascript" src="Jsq/jquery.js"></script>
<script type="text/javascript" src="JSq/php.js"></script>
<script type="text/javascript" src="JSq/jquery.at_intervals.js"></script>
<script type="text/javascript" src="JSq/JSui/jquery-ui.js"></script>
<script type="text/javascript" src="JSq/mbMenu/inc/mbMenu.js"></script>
<link href="JSq/mbMenu/css/menu1.css" rel="stylesheet" type="text/css">
<script>
  $(document).ready(function(){
  	$(".papelera").at_intervals(function(){   try {$.get("desk.php", { op: "savewin", wdata: WinLIKE.currentstates(true, true) },  function(data){});} catch (error){} finally {  }}, { name: "foo", delay: 60000 })
    $(".mipc").draggable();
	$(".papelera").draggable();
	$(".programas").draggable();
	$(".papelera").droppable({
	activeClass: 'droppable-active',
	hoverClass: 'droppable-hover',
	drop: function(ev, ui) {
		$(ui.draggable).css("visibility","hidden");
	}
});


$(".mensajes").at_intervals(function(){  try {$.get("msgs.php", {op: "updatemsg"},  function(data){
var temp = $("#newmsg").text();
temp=substr(temp,1);
temp=substr(temp,0,parseInt(temp.length)-1);
if (temp=="") { temp=0;}
if (temp < data) {$("#newmsg").text("("+data+")");$(".mensajes").effect("pulsate"); }
if (temp > data) {$("#newmsg").text("("+data+")");}
if (data==0) {$("#newmsg").text("");}
});} catch (error){} finally {  }}, { name: "foo", delay: 30000 })


    $(".mipc").dblclick(function () { 
     parent.WinLIKE.openaddress('mipc.php',null,'mipc'); 
    });
	 $(".programas").dblclick(function () { 
     parent.WinLIKE.openaddress('programas.php',null,'programas'); 
    });
	 $(".mensajes").dblclick(function () { 
     parent.WinLIKE.openaddress('msgs.php',null,'mensajes'); 
    });
 $(".myMenu").buildMenu(
            {
                additionalData:"",
                menuWidth:200,
                openOnRight:false,
                menuSelector: ".menuContainer",
                iconPath:"JSq/mbMenu/ico/",
                hasImages:true,
                fadeTime:200,
                adjustLeft:2,
                adjustTop:10,
                opacity:.95,
                shadow:true
            });


  });
  </script>
<script>
function mostraricono(icono)
{
$("."+icono).css("visibility","visible");
$("."+icono).css("left","615");
$("."+icono).css("top","50");
}

function apagar()
{
try {$.get("desk.php", { op: "savewin", wdata: WinLIKE.currentstates(true, true) },  function(data){window.location="index.php";});} catch (error){alert("error");} finally {  }
}

function ventana(titulo, nombre)
{
	var j=new WinLIKE.window(titulo,128,126,579,615,80);
	j.Nam=nombre;
	j.Vis=true;
	j.Ski='round';
	WinLIKE.addwindow(j);
}
</script>
<style type="text/css">
<!--
body {
	background-image     : url(images/background2.jpg);
	background-attachment: fixed;
	background-repeat    : no-repeat;
	background-position  : top;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.mipc {
	position:absolute;
	left:0px;
	top:50px;
	width:58px;
	height:69px;
	visibility: visible;
}
.papelera {
	position:absolute;
	left:84px;
	top:50px;
	width:58px;
	height:69px;
	z-index:-1;
	visibility: visible;
}
.droppable-active {
	opacity: 1.0;
}
.droppable-hover {
	outline: 5px dotted green;
}
.programas {
	position:absolute;
	left:167px;
	top:50px;
	width:58px;
	height:69px;
	visibility: visible;
}
-->
</style>
</head>

<body onResize=WinLIKE.resizewindows() onLoad="WinLIKE.init();t();" onDragStart="self.event.returnValue=false;">
	<IMG id=ig_ src="JSq/winlike/winman/load.gif" style="position:absolute; left:35%; top:40%; z-index:4000; visibility: hidden;">

	<IMG ID=ih_ SRC="JSq/winlike/winman/trans.gif" style="zIndex:20; position:absolute; left:0; top:0; width:100%; height:100%; visibility: hidden;">




<div class="mipc">
  <div align="center"><img src="icons/mipc.png" width="48" height="48" border="0" /><br>
  Sistema</div>
</div>
<div class="papelera"><img src="icons/papelera.png" width="48" height="48"><br>
Papelera</div>
<div class="programas">
  <div align="center"><img src="icons/programas.png" width="48" height="48" border="0"><br>
    Programas</div>
</div>

<!-- Estrcutura del menu -->

<table width="100%" border="0" cellpadding="0" background="JSq/mbMenu/images/bgnd_sel_1.jpg">
  <tr>
    <td class="container myMenu" height="23" align="left" valign="top" >
                      <td class="myMenu">


                        <table class="rootVoices" cellspacing='0' cellpadding='0' border='0'><tr>
                            <td menu="menu_2" >Aplicaciones</td>
                            <td menu="menu_web" >Web</td>
                          <td menu="menu_3" >Sistema</td>
                            

                        </tr></table>                    </td>

           
<td><div align="right"><img class="mensajes" src="icons/mensaje.png" width="34" height="32"></div></td>
                      <td width="0" align="left">
                        <div align="right">
                          <div align="left"><strong>
                            <?php
							$msg=new_msgs($_SESSION['username']);
										 if (msg!=0) echo "(";
										echo "<span id='newmsg'>";
										if (msg!=0) echo new_msgs($_SESSION['username']);
										if (msg!=0) echo ')';
										 echo '</span>';
										 ?>
                          </strong></div>
                        </div>
<td width="15%"><div align="right" id="dinero"><strong>
                        <?php $user=get_user_info($_SESSION['username']); echo $user['dinero']; ?>
  &euro;</strong> </div>                      
    <td width="10%" align="left" valign="top" background=""><div align="right"><a href="Javascript:apagar()"><img src="icons/power.png" width="32" height="32" border="0"></a></div></td>
  </tr>
</table>

<!--  estructura menu -->

<div id="menu_2" class="menu">
    <a rel="text" action="document.title=('menu_3.0')">
<img src="icons/programas.png" style="position:absolute; margin-top:-20px; margin-left:-25px; margin-bottom:10px;"/><br>

        <br>
        En este menú encontrar&aacute;s todas las aplicaciones que tengas instaladas.<br>
    <br>
    </a>
    <a img="../../../icons/games.png" menu="menu_juegos">Juegos</a>
    <a img="../../../icons/defensa.png" menu="menu_defensa">Defensa</a>
    <a action="parent.WinLIKE.openaddress('misions.php',null,'admin_ms');" img="../../../images/mision.png">Admin. Misiones</a>
    <a action="parent.WinLIKE.openaddress('network.php?mode=dns',null,'net_dns');" img="../../../icons/dns.png">DNS</a>
    <a rel="separator"></a>
    <a action="mostraricono('programas')" img="24-image-add.png">Mostrar Icono</a>
</div>

<div id="menu_web" class="menu">
    <a rel="text" action="document.title=('menu_3.0')">
<img src="icons/netws.png" width="48" height="48" style="position:absolute; margin-top:-20px; margin-left:-25px; margin-bottom:10px;"/><br>

        <br>
        Desde aqu&iacute; podras acceder a p&aacute;ginas web &uacute;tiles.<br>
    <br>
  </a>
    <a action="parent.WinLIKE.openaddress('hjob.php',null,'hard_1');" img="../../../icons/HJ.png">HJob.org</a>
    <a action="parent.WinLIKE.openaddress('',null,'hard_1');" img="../../../icons/EH.png">eHard.org</a>
</div>

<div id="menu_3" class="menu">
    <a rel="text" action="document.title=('menu_3.0')">
        <img src="icons/mipc.png" style="position:absolute;margin-top:-20px; margin-left:-25px;margin-bottom:10px"/><br>

        <br>Aqui podras encontrar todos los aspectos modificables del sistema.<br><br>
    </a>
    <a rel="separator"></a>
    <a img="../../../icons/hards.png" menu="menu_hdds">Almacenamiento</a>
    <a img="../../../icons/netws.png" menu="menu_netws">Conectividad</a>
    <a rel="separator"></a>
    <a action="mostraricono('mipc')" img="24-image-add.png">Mostrar Icono</a>
</div>

<div id="menu_juegos" class="menu">
<?php
$result = get_user_softs($_SESSION['username']);
while ($softs=mysql_fetch_array($result))
{
$info = get_soft_info($softs['sid']);
if ($info['tipo']=="juego")
{
echo '<a action="parent.WinLIKE.openaddress';
echo "('". $info['url'] ."',null,'soft_". $info['id'] ."')";
echo ';" img="../../../icons/'. $info['icono'] .'">'. $info['nsoft'] .'</a>';
}
}


?>
</div>

<div id="menu_hdds" class="menu">
<?php
$result = get_user_hards($_SESSION['username']);
while ($hards=mysql_fetch_array($result))
{
$info = get_hard_info($hards['hid']);
if ($info['tipo']=="drive")
{
echo '<a action="parent.WinLIKE.openaddress';
echo "('". $info['url'] ."',null,'hard_". $info['id'] ."')";
echo ';" img="../../../icons/'. $info['icono'] .'">'. $info['nhard'] .'</a>';
}
}


?>
</div>

<div id="menu_netws" class="menu">
<?php
$result = get_user_hards($_SESSION['username']);
while ($hards=mysql_fetch_array($result))
{
$info = get_hard_info($hards['hid']);
if ($info['tipo']=="netw")
{
echo '<a action="parent.WinLIKE.openaddress';
echo "('". $info['url'] ."',null,'hard_". $info['id'] ."')";
echo ';" img="../../../icons/'. $info['icono'] .'">'. $info['nhard'] .'</a>';
}
}


?>
</div>

<div id="menu_defensa" class="menu">
 <?php
$result = get_user_softs($_SESSION['username']);
while ($softs=mysql_fetch_array($result))
{
$info = get_soft_info($softs['sid']);
if ($info['tipo']=="defensa")
{
echo '<a action="parent.WinLIKE.openaddress';
echo "('". $info['url'] ."',null,'soft_". $info['id'] ."')";
echo ';" img="../../../icons/'. $info['icono'] .'">'. $info['nsoft'] .'</a>';
}
}


?>
</div>

<!-- Fin estructura del del menu -->
</body>
</html>

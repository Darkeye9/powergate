<?php 
include("mysqlcon.php");
if ($_GET['mode']=="look")
{
$result = get_servers_from_domain($_GET['dominio']);
while ($servers=mysql_fetch_array($result))
{
if ($error!="no") { echo "Resultados del dominio: ".$_GET['dominio']."<br /><br />"; }
$error="no";
echo "<a href='network.php?mode=connect&ip=".$servers['ip']."'>".$servers['ip']."</a><br />";

}
if ($error!="no")
{
echo '<div class="error ui-corner-all">No se han encontrado registros</div>';

}
exit();
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="Jsq/jquery.js"></script>
<script src="JSq/php.js"></script>
<script src="JSq/JSui/jquery-ui.js"></script>
<script>
 $(document).ready(function(){
 $("#lookdns").click(function () { 
 var dom= document.form1.dominio.value;
      $.get("network.php", {mode: "look", dominio: dom},  function(data){if(strpos(data, "Error")==false){
	  																											$("#resultado").html(data);
																												$("#resultado").show("blind", {}, 1000);
																												}});
    });
 });
 </script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php 
$mode=$_GET['mode'];

switch ($mode)
{
case dns:
echo '<title>DNS Lookup</title>';
break;

case connect:
echo '<title>Connect to</title>';
break;
}


?>
<style type="text/css">
<!--
@import url("JSq/mbMenu/css/menu1.css");
@import url("JSq/theme/azul/ui.all.css");
@import url("JSq/context/jquery.contextmenu.css");
.content {background-image: url(JSq/mbMenu/header_bgnd.jpg);
}
body {
	background-image: url(images/trans.png);
}
.resultado {background-color:#339999;
}
.error {background-color:#FF0000;
}
-->
</style>
</head>

<body>
<?php 
switch ($mode)
{
case dns:
?>

<h2><strong><img src="icons/dns.png" alt="" width="90" height="90" /></strong> <br />
    <hr />
</h2>
<div class="ui-widget ui-corner-all">
  <div class="header_content ui-widget-header ui-corner-all">DNS Lookup</div>
  <div class="content ui-corner-all">
    <form id="form1" name="form1" method="post" action="">
    <label>Dominio:
    <input type="text" name="textfield" id="dominio" /></label>
  <label>
        <input type="button" name="button" id="lookdns" value="Consultar" />
        </label>
    </form>  </div>
</div>
<br />
    <div class="resultado ui-corner-all" id="resultado"></div>

<p></p>

<?php
break;

case connect:
echo '<title>Connectando..</title>';
?>
Conectando al Servidor, espere por favor...
<script>
setTimeout(function(){location.href="server.php?ip=<?php echo $_GET['ip'] ?>"},2000);
</script>

<?php
break;
}


?>
</body>
</html>

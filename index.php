<?php 
if (isset($_POST['user']))
{
include("mysqlcon.php");

if (login($_POST['user'], $_POST['pass'])==true)
{
session_start();
$_SESSION['username'] = $_POST['user'];
header("Location: desk.php");
}
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Power Gate</title>
<style type="text/css">
<!--
body {
	background-image: url(images/powergate.jpg);
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
.style2 {color: #FFFFFF}
#apDiv1 {
	position:absolute;
	left:268px;
	top:100px;
	width:618,000px;
	height:36,000px;
	z-index:1;
}
#apDiv2 {
	position:absolute;
	left:265px;
	top:217px;
	width:533px;
	height:365px;
	z-index:2;
}
-->
</style></head>

<body>
<div id="apDiv1">
  <form id="form1" name="form1" method="post" action="">
    <label><span class="style1">Nombre de usuario: </span>
    <input type="text" name="user" id="user" />
    </label>
    <span class="style1">
    <label>Clave: </label>
    </span><span class="style2">
      <label></label>
    </span>
    <label>
    <input type="text" name="pass" id="pass" />
    </label>
    <label>
    <input type="submit" name="button" id="button" value="Entrar" />
    <br />
    <br />
    <span class="style1">Version en desarrollo<br />
    </span></label>
  </form>
</div>
<div id="apDiv2">
  <p class="style2"><strong>Ultimos cambios:</strong></p>
  <p class="style1">[+] Sistema de misiones completo<br />
    [+] Funcion de apagar<br />
    [+] Layout de Sistema<br />
    [+] Programas dinamizados<br />
  [+] Administraci&oacute;n de Programas</p>
</div>
</body>
</html>

<?php 
include("mysqlcon.php");
$info = get_server_info($_GET['ip']);

if ($_GET['hash']==$info['prothash'])
{
header("Location: files.php?ip=".$_GET['ip']."&hash=".$_GET['hash']);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Bienvenido a <?php echo $info['empresa'] ?></title>
<style type="text/css">
<!--
body {
	background-color: #D9D9E5;
}
-->
</style></head>

<body>
<?php 
echo $info['prot'];

?>
</body>
</html>

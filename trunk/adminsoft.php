<?php 
session_start();
include("mysqlcon.php");

$user = $_SESSION['username'];
$op = $_GET["op"];
$soft = $_GET["soft"];

if ($op=="borrar")
{
borrar_soft($user, $soft);
}
echo "Usuario: ". $user ." <br> OP: ". $op . " <br> Soft: ". $soft;
?>
<?php 
include("mysqlcon.php");
$user = $_SESSION['username'];
$op = $_GET["op"];
$hard = $_GET["hard"];

if ($op=="borrar")
{
borrar_hard($user, $hard);
}
echo "Usuario: ". $user ." <br> OP: ". $op . " <br> Hard: ". $hard;
?>
<?php
 $conn = mysql_connect("localhost","USER","PASS");
 mysql_select_db("pg");
 
 
function get_soft_info ($sid)
{
 $query="SELECT * FROM softdef WHERE id='$sid'";
$result=mysql_query($query)
or die ("Error".mysql_error());
$row=mysql_fetch_array($result);
return $row;
}
function get_file_info ($fid)
{
$query="SELECT * FROM files WHERE id=$fid";
$result=mysql_query($query)
or die ("Error".mysql_error());
$row=mysql_fetch_array($result);
return $row;
}
function get_user_info ($name)
{
if(is_numeric($name))
{
$query="SELECT * FROM users WHERE id='$name'";
$result=mysql_query($query)
or die ("Error".mysql_error());
$row=mysql_fetch_array($result);
return $row;
}else{
$query="SELECT * FROM users WHERE username='$name'";
$result=mysql_query($query)
or die ("Error".mysql_error());
$row=mysql_fetch_array($result);
return $row;
}
}
function get_user_softs ($name)
{
$uinfo=get_user_info($name);
$query="SELECT * FROM soft WHERE user='". $uinfo['id'] ."'";
$result=mysql_query($query)
or die ("Error".mysql_error());
return $result;
}
function borrar_soft ($username, $softn)
{
$uinfo=get_user_info($username);
$query="DELETE FROM soft WHERE user = '". $uinfo['id'] ."' AND sid = '$softn'";
$result=mysql_query($query)
or die ("Error".mysql_error());
}
function borrar_file ($user ,$fid)
{
$uinfo=get_user_info($user);
$file_info=get_file_info($fid);
if ($uinfo['id']==$file_info['user'] or $file_info['user']=" ")
{
$query="DELETE FROM files WHERE id =". $fid;
$result=mysql_query($query)
or die ("Error".mysql_error());
return "Archivo borrado correctamente";
}else
{
return "Acceso Denegado";
}
}
function windows_save ($user, $datos)
{
$datos = str_replace("\\", "", $datos);
$datos=base64_encode($datos);
$query="UPDATE users SET windows = '$datos' WHERE username='$user'";
$result=mysql_query($query)
or die ("Error".mysql_error());
}
function windows_load ($name)
{
$query="SELECT windows FROM users WHERE username='$name'";
$result=mysql_query($query)
or die ("Error".mysql_error());
$row=mysql_fetch_array($result);
return base64_decode($row['windows']);
}
function get_user_hards ($name) 
{
$uinfo=get_user_info($name);
$query="SELECT * FROM hard WHERE user='". $uinfo['id'] ."'";
$result=mysql_query($query)
or die ("Error".mysql_error());
return $result;
}
 function get_hard_info ($hid)
{
$query="SELECT * FROM harddef WHERE id='$hid'";
$result=mysql_query($query)
or die ("Error".mysql_error());
$row=mysql_fetch_array($result);
return $row;
}
function borrar_hard ($username, $hardn)
{
$uinfo=get_user_info($username);
$query="DELETE FROM hard WHERE user = '". $uinfo['id'] ."' AND hid = '$hardn'";
$result=mysql_query($query)
or die ("Error".mysql_error());
}
function login ($username, $pass)
{
$query="SELECT * FROM users WHERE username='$username' AND pass='$pass'";
$result=mysql_query($query)
or die ("Error".mysql_error());
if (mysql_num_rows($result)==1) { return true; }else { return false; }
}
function new_msgs ($username)
{
$uinfo=get_user_info($username);
$query="SELECT * FROM msg WHERE receptor='". $uinfo['id'] ."' AND leido=0";
$result=mysql_query($query)
or die ("Error".mysql_error());
return mysql_num_rows($result);
}
function get_user_msgs ($name)
{
$uinfo=get_user_info($name);
$query="SELECT * FROM msg WHERE receptor='". $uinfo['id'] ."' ORDER BY id DESC";
$result=mysql_query($query)
or die ("Error".mysql_error());
return $result;
}
function marcar_msg_leido ($user, $mid)
{
$uinfo=get_user_info($user);
$query="UPDATE msg SET leido = '1' WHERE id =$mid AND receptor='". $uinfo['id'] ."'";
$result=mysql_query($query)
or die ("Error".mysql_error());
}
function send_msg($emisor, $receptor, $titulo, $texto)
{
$emisor_info=get_user_info($emisor);
$recip_info=get_user_info($receptor);
$query="INSERT INTO msg (id ,emisor ,receptor ,titulo ,texto ,leido)VALUES (NULL , '". $emisor_info['id'] ."', '". $recip_info['id'] ."', '$titulo', '$texto', '0');";
$result=mysql_query($query)
or die ("Error".mysql_error());
}
function delete_msg($mid, $user)
{
$uinfo=get_user_info($user);
$query="DELETE FROM msg WHERE id =$mid AND receptor='". $uinfo['id'] ."'";
$result=mysql_query($query)
or die ("Error".mysql_error());
}
function get_misiones($cat)
{
if ($cat!=""){
$query="SELECT * FROM misiones WHERE tipo='$cat' AND user='' ORDER BY id DESC";
}else
{
$query="SELECT * FROM misiones WHERE user='' ORDER BY id DESC";
}
$result=mysql_query($query)
or die ("Error".mysql_error());
return $result;
}
 function get_empresa_info ($eid)
{
 $query="SELECT * FROM empresas WHERE id='$eid'";
$result=mysql_query($query)
or die ("Error".mysql_error());
$row=mysql_fetch_array($result);
return $row;
}
function get_user_ms ($name)
{
$query="SELECT * FROM misiones WHERE user='$name'";
$result=mysql_query($query)
or die ("Error".mysql_error());
return $result;
}
function abandonar_ms ($msid, $user)
{
$query="UPDATE misiones SET user = '', final='' WHERE id=$msid AND user='$user'";
echo $query;
$result=mysql_query($query)
or die ("Error".mysql_error());
$ms=get_ms_info($msid);
$empresa=get_empresa_info($ms['objetivo']);
send_msg("Admin. Misiones", $user, "Has abandonado una misión", "<font color=red>Has abandonado la misión de atacar la empresa ". $empresa['nombre'] ."</font>");
}
function get_ms_info ($msid)
{
$query="SELECT * FROM misiones WHERE id='$msid'";
$result=mysql_query($query)
or die ("Error".mysql_error());
$row=mysql_fetch_array($result);
return $row;
}
function aceptar_ms ($msid, $user)
{
$info=get_ms_info($msid);
$fechafinal=mktime()+$info['limite'];
$query="UPDATE misiones SET user = '$user', final='$fechafinal' WHERE id=$msid";
$result=mysql_query($query)
or die ("Error".mysql_error());
$uinfo=get_user_info($user);
$php = str_replace("%user%", $uinfo['id'], $info['prep']);
$ms=get_ms_info($msid);
$empresa=get_empresa_info($ms['objetivo']);
send_msg("Admin. Misiones", $user, "Mision Aceptada", "Has aceptado atacar la empresa ". $empresa['nombre'] ."<br /><b>Misión:</b><br />". $ms['desc']);
eval($php);
}
function fracasar_ms ($msid, $user) //Actualmente no usada
{
$query="UPDATE misiones SET user = '', final='' WHERE id=$msid AND user='$user'";
$result=mysql_query($query)
or die ("Error".mysql_error());
send_msg("Admin. Misiones", $user, "Misión fracasada", "<font color=red>Has fracasado una mision.</font>");
}
function get_servers_from_domain ($dominio)
{
$query="SELECT * FROM empresas WHERE dominio='$dominio'";
$result=mysql_query($query)
or die ("Error".mysql_error());
$row=mysql_fetch_array($result);
$idempresa=$row['id'];
$query="SELECT * FROM servers WHERE empresa='$idempresa'";
$result=mysql_query($query)
or die ("Error".mysql_error());
return $result;
}
function create($sid, $file, $user="", $cont="", $azar=100)
{
if (rand(0,100)<$azar)
{
$query="INSERT INTO files (id ,servidor ,nombre, user ,contenido)VALUES (NULL , '$sid', '$file', '$user', '$cont');";
echo $query;
$result=mysql_query($query)
or die ("Error".mysql_error());
}
}
function check($sid, $file, $estado)
{
$query="SELECT * FROM files WHERE servidor='$sid' AND nombre='$file'";
$result=mysql_query($query)
or die ("Error".mysql_error());
if (mysql_num_rows($result)==$estado) { return true; }else { return false; }
}
function get_prot_info ($pid)
{
$query="SELECT * FROM protec WHERE id='$pid'";
$result=mysql_query($query)
or die ("Error".mysql_error());
$row=mysql_fetch_array($result);
return $row;
}
function get_server_info ($sip)
{
$query="SELECT * FROM servers WHERE ip='$sip'";
$result=mysql_query($query)
or die ("Error".mysql_error());
$row=mysql_fetch_array($result);
$empresa = get_empresa_info($row['empresa']);
$prot = get_prot_info($row['prot']);
$server = array("id" => $row['id'], "empresa" => $empresa['nombre'], "prot" => $prot['code'], "prothash" => $prot['hash']);
return $server;
}
function get_server_files ($ip)
{
$server=get_server_info($ip);
$query="SELECT * FROM files WHERE  servidor='" . $server['id'] . "'"; 
$result=mysql_query($query)
or die ("Error".mysql_error());
return $result;
}
function get_file_contents ($fid)
{
$query="SELECT * FROM files WHERE  id=". $fid;  
$result=mysql_query($query)
or die ("Error".mysql_error());
$row=mysql_fetch_array($result);
return $row['contenido'];
}
 ?>
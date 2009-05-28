<?php 
include("mysqlcon.php");
$info = get_server_info($_GET['ip']);
if ($_GET['hash']!=$info['prothash'])
{
die("Acceso Denegado");
}

if ($_GET['mode']=="open")
{
echo str_replace("\r\n","<br />",get_file_contents($_GET['file'], $_GET['ip']));
exit();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Archivos en <?php echo $info['empresa'] ?></title>
<script src="Jsq/jquery.js"></script>
<script src="JSq/winlike/winman/winxtra.js"></script>
<script src="JSq/JSui/jquery-ui.js"></script>
<script src="JSq/php.js"></script>
<script type="text/javascript" src="JSq/context/jquery.contextmenu.js"></script>
<script>
 $(document).ready(function(){
 var menu4 = [ 
	{'Abrir':{ onclick:function(menuItem,menu) {
	var filen = $(this).attr("class");
	filen=substr(filen,5); 
	filen=substr(filen,0,strpos(filen,"ui-"));
	 $.get("files.php", {mode: "open", ip: "<?php echo $_GET['ip'] ?>", hash: "<?php echo $_GET['hash'] ?>", file: filen},  function(data){if(strpos(data, "Error")==false){
	  																											$("#panel").html(data);
																												$("#panel").show("blind", {}, 1000);
																												}}); }, icon:'icons/contx_abrir.png', disabled:false } },
	
	
	{'Borrar':{ onclick:function(menuItem,menu) {
	 if(confirm('Esta seguro?\r\nEsta acción no tiene marcha atrás'))
	 { 
	var softn = $(this).attr("class");
	softn=substr(softn,11);   
	$.get("adminsoft.php", {op: "borrar", soft: softn  },  function(data){if(strpos(data, "Error")==false){
																												$(".soft_"+softn).hide("explode");
																												setTimeout(function(){$(".soft_"+softn).remove();},700);
																												}});}
	}, icon:'icons/contx_abrir.png', disabled:false }}
	];
	
	
	
	
	
	 $(function() { $('.file').contextMenu(menu4); });
 var items;
 $(function() {
		$("#selectable").selectable({
			stop: function(){
			items="";
				$(".ui-selected", this).each(function(){
					var index = $("#selectable li").index(this);
					items = items +" #" + (index + 1);
				});
			}
		});
		
	 $(".delete").click(function () { 
  		alert(items);
    });
	});
	
	});
	 </script>
     
<style type="text/css">
<!--
@import url("JSq/mbMenu/css/menu1.css");
@import url("JSq/theme/azul/ui.all.css");
@import url("JSq/context/jquery.contextmenu.css");
#feedback { font-size: 1.4em; color:#000000 }
#selectable .ui-selecting { background: #FECA40; }
#selectable .ui-selected { background: #F39814; }
#selectable { list-style-type: none; padding:0; cursor:default; width:inherit; }
body {
	background-image: url(images/trans.png);
}
li
{
margin: 3px; color: #ffffff; font-weight: bold;
}
.resultado {background-color:#3366FF;
}
-->
</style>
</head>

<body>
<h2>Archivos en <?php echo $_GET['ip'] ?> - <?php echo $info['empresa'] ?></h2>     

<table width="100%" border="0">
  <tr>
    <td><table border="0">
        <tr>
          <td><ol id="selectable" >
<?php           
$result = get_server_files($_GET['ip']);
while ($file=mysql_fetch_array($result))
{
echo '<li class="file ' . $file['id'] . '">' . $file['nombre'] . '</li>';
}


?>
</ol></td>
        </tr>
</table>


<br />
<table width="200" border="0">
  <tr>
    <td>Seleccionados: <img class="delete" src="icons/delete.png" width="16" height="16" /></td>
  </tr>
</table></td>
    <td width="50%"></td>
  </tr>
</table><div id="panel" class="resultado ui-corner-all"></div>
</body>
</html>

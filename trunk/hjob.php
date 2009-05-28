<?php 
include ("mysqlcon.php");

$cat=$_GET['cat'];
$result = get_misiones($cat);
$ms;
$i = 1;
while ($mis=mysql_fetch_array($result))
{
$empresa=get_empresa_info($mis['objetivo']);
$ms[$i] = array("objetivo" => $empresa['nombre'], "nivel" => $mis['nivel'], "dinero" => $mis['dinero'], "id" => $mis['id']);
$i++;
}
$ms["count"]=$i-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- DW6 -->
<head>

<!-- Copyright 2005 Macromedia, Inc. All rights reserved. -->
<title>Entertainment - Catalog</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="css/mm_entertainment.css" type="text/css" />
<script type="text/javascript" src="Jsq/jquery.js"></script>
<script type="text/javascript" src="JSq/php.js"></script>
<script>
  $(document).ready(function(){
   $(".mis").dblclick(function () { 
   var mid=$(this).attr("class");
   mid=mid.substring(7);
     try {$.get("misions.php", {op: "aceptar", ms: mid},  function(data)
	 {
if (strpos(data, "Error")==false)
{
$(".ms_"+mid).hide("scale");
setTimeout(function(){$(".ms_"+mid).remove();},700);
}else
{
alert(data);
}
	 
	 });} catch (error){} finally {  }
    });
  
  
  });
  </script>
</head>
<body bgcolor="#14285f">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr bgcolor="#02021e">
    <td width="360" height="58" nowrap="nowrap" id="logo" valign="bottom">Hjob.org</td>
    <td width="100%">&nbsp;</td>
  </tr>
  <tr bgcolor="#02021E">
    <td height="57" nowrap="nowrap" id="tagline" valign="top">The job page for Hackers</td>
	<td width="100%">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#cc3300"><img src="images/mm_spacer.gif" alt="" width="1" height="2" border="0" /></td>
  </tr>

   <tr>
    <td colspan="2"><img src="images/mm_spacer.gif" alt="" width="1" height="2" border="0" /></td>
  </tr>

   <tr>
    <td colspan="2" bgcolor="#cc3300"><img src="images/mm_spacer.gif" alt="" width="1" height="1" border="0" /></td>
  </tr>

   <tr>
    <td colspan="3" id="dateformat">&nbsp;
      <table border="0">
      <tr>
        <td><a href="hjob.php">home</a></td>
        <td width="10">&nbsp;</td>
        <td><strong><a href="hjob.php?cat=rob">Robos</a></strong></td>
        <td width="10">&nbsp;</td>
        <td><strong><a href="hjob.php?cat=alter">Alteraciones</a></strong></td>
        <td width="10">&nbsp;</td>
        <td><strong><a href="hjob.php?cat=destroy">Destrucciones</a></strong></td>
        <td width="10">&nbsp;</td>
        <td><strong><a href="hjob.php?cat=inves">Investigación</a></strong></td>
      </tr>
    </table>
	<br />	</td>
  </tr>

  <tr>
   <td valign="top"><br />
	<table border="0" cellspacing="0" cellpadding="2" width="610">
        <tr>
          <td colspan="7" class="subHeader"><?php
          switch ($cat)
		  {
		  case "":
		  	echo "Todos";
			break;
		  case "rob":
		  	echo "Robos";
			break;
		  case "alter":
		  	echo "Alteraciones";
			break;
		  case "destroy":
		  	echo "Destrucciones";
			break;
		  case "inves":
		  	echo "Investigaciones";
			break;
		  
		  
		  }
		  
		  ?></td>
        </tr>
		<?php
		$count=1;
		while ($count<=$ms['count'])
		{
		echo '<tr>';
         if($ms[$count]["objetivo"]!="") echo '<td width="22%" height="110"><img class="mis ms_'.$ms[$count]["id"].'" src="images/mision.png" alt="small product photo" width="110" height="110" border="0" /></td>';
		 if($ms[$count]["objetivo"]!="") echo '<td>&nbsp;</td>';
		 if($ms[$count+1]["objetivo"]!="") echo '<td width="22%" height="110"><img class="mis ms_'.$ms[$count+1]["id"].'" src="images/mision.png" alt="small product photo" width="110" height="110" border="0" /></td>';
		 if($ms[$count+1]["objetivo"]!="") echo '<td>&nbsp;</td>';
		 if($ms[$count+2]["objetivo"]!="") echo '<td width="22%" height="110"><img class="mis ms_'.$ms[$count+2]["id"].'" src="images/mision.png" alt="small product photo" width="110" height="110" border="0" /></td>';
		if($ms[$count+2]["objetivo"]!="")  echo '<td>&nbsp;</td>';
		 if($ms[$count+3]["objetivo"]!="") echo '<td width="22%" height="110"><img class="mis ms_'.$ms[$count+3]["id"].'" src="images/mision.png" alt="small product photo" width="110" height="110" border="0" /></td>';
       echo '</tr>';
		echo '<tr>';
          if($ms[$count]["objetivo"]!="") echo '<td class="detailText" valign="top" nowrap="nowrap"><a href="javascript:;">'. $ms[$count]["objetivo"] .'</a><br />'. $ms[$count]["dinero"] .'&nbsp;&euro;<br />Nivel: '.$ms[$count]["nivel"].'</td>';
		 if($ms[$count]["objetivo"]!="") echo '<td>&nbsp;</td>';
		 if($ms[$count+1]["objetivo"]!="")  echo '<td class="detailText" valign="top" nowrap="nowrap"><a href="javascript:;">'. $ms[$count+1]["objetivo"] .'</a><br />'. $ms[$count+1]["dinero"] .'&nbsp;&euro;<br />Nivel: '.$ms[$count+1]["nivel"].'</td>';
		if($ms[$count+1]["objetivo"]!="") echo '<td>&nbsp;</td>';
		 if($ms[$count+2]["objetivo"]!="")  echo '<td class="detailText" valign="top" nowrap="nowrap"><a href="javascript:;">'. $ms[$count+2]["objetivo"] .'</a><br />'. $ms[$count+2]["dinero"] .'&nbsp;&euro;<br />Nivel: '.$ms[$count+2]["nivel"].'</td>';
		if($ms[$count+2]["objetivo"]!="")echo '<td>&nbsp;</td>';
		 if($ms[$count+3]["objetivo"]!="")  echo '<td class="detailText" valign="top" nowrap="nowrap"><a href="javascript:;">'. $ms[$count+3]["objetivo"] .'</a><br />'. $ms[$count+3]["dinero"] .'&nbsp;&euro;<br />Nivel: '.$ms[$count+3]["nivel"].'</td>';
        echo '</tr>';
		echo '<tr>';
			echo '<td colspan="7">&nbsp;</td>';
		echo '</tr>';
		$count = $count + 4;
		}
		?>
      </table>	  </td>
	  <td height="3">&nbsp;</td>
  </tr>
  <tr>
    <td width="360">&nbsp;</td>
	<td width="100%">&nbsp;</td>
  </tr>
</table>
<br />
</body>
</html>

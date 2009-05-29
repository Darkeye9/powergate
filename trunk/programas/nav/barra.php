<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="../../JSq/jquery.js"></script>
<script type="text/javascript" src="../../JSq/php.js"></script>
<script>
$(document).ready(function(){
 $("#ir").click(function () { 
 var dom= document.form1.url.value;
     window.parent.frames[1].location=dom;
    });
 });
</script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Navegador</title>


<style type="text/css">
<!--
body {
background-image:url(../../images/trans.png)
}
-->
</style></head>

<body>
<form id="form1" name="form1" method="post" action="">
  <label>URL:
  <input name="url" type="text" id="url" value="<?php echo $_POST['url'] ?>" size="100" />
  </label>
  <label>
  <input type="submit" name="ir" id="ir" value="Ir" />
  </label>
</form>
</body>
</html>

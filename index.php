<?php
session_start();
echo '<title>Call Center</title>';
/*echo '<form action="make_call.php" method="post"> */
echo '<form action="ClickToCall.php" method="post">
<table width="35%">
<tr><td>Deseas mas informacion de las cuentas, deja tu numero y marcamos</td></tr>
<tr><td> <input type="text" name="number" /></td></tr>
<tr><td colspan="1" align="left"><input type="submit" value="Agendar Llamada" /></td></tr>
</table>
</form>
<img alt="Sedi Servicios" src="img/sedisupport.png">';
$_SESSION['calling'] = 'yes' ;
?>
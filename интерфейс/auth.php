<?php
require_once("/var/www/html/conectBD/databaseconnect.php");
$dbS = new DB_CONNECT();
$connd = $dbS->connect_bd('KR1');
$auth=0;
$idLifetime = 1800; //  завершение сеанса если нет активности более 1800сек
$t = time(); 
session_start();
if ($t-$_SESSION['starttime'] <= $idLifetime ) {
	$auth=1;
}
if ($auth==1) {
	$inf =  $_SESSION['mail']." / <button type='submit' class= 'nvhod' id='form_auth_submit' onclick = setAuthDestroy('1')><font size='3'><b>Выход</b></font></button>";
}else{
	$inf =  "<button type='submit' class= 'vhod' id='form_auth_submit' onclick = 'setAuthPriv()'><font size='3'><b>Войти</b></font></button>";
}
IF ($_SESSION['mail']) {
	$sql = "SELECT * FROM auth WHERE st_mail = '2' AND mail = '".$_SESSION['mail']."';";
	$rez_reg = $connd->prepare($sql);
	$rez_reg->execute();
	$bottom ="";
	if($rez_reg->rowCount() > 0) {
	$bottom = "<button class='form_addosnova_button' type='submit' id='form_addosnova_submit' onclick = 'setOsnova()'><font size='4'><b>добавить предприятие</b></font></button>";

	}
	$rez_reg->closeCursor();
}
echo "<table width='100%' border='0' backgraund='grey'>
		<tr>
			<td>$bottom</td>
			<td align='right'>$inf</td>
		</tr>
		</table><hr>";

?>
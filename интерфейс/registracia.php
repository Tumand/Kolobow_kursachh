<?php
require_once("/var/www/html/conectBD/databaseconnect.php");
$dbS = new DB_CONNECT();
$connd = $dbS->connect_bd('KR1');
$error_msg = '0';
$mail = $_REQUEST['mail'];
$pass = md5($_REQUEST['pass'].'thisisforhabr');
$code = $_REQUEST['code'];

$sql = "call add_new_lgn('$mail','$pass','$code');";
$rez_reg = $connd->prepare($sql);
$rez_reg->execute();
if($rez_reg->rowCount() > 0) {
	$row_reg = $rez_reg->fetch();
	$error_msg = $row_reg['_inf'];
}
$rez_reg->closeCursor();
echo ':::'.$error_msg.':::';
?>
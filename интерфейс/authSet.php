<?php
require_once("/var/www/html/conectBD/databaseconnect.php");
$dbS = new DB_CONNECT();
$connd = $dbS->connect_bd('KR1');
$error_msg = '0'; //проверка непройдена
$code = $_REQUEST ['code'];
$mail = $_REQUEST['mail'];
$pass = md5($_REQUEST['pass'].'thisisforhabr');

$sql = "call auth_proverka('$mail','$pass','$code')";
$rez_reg = $connd->prepare($sql);
$rez_reg->execute();
if($rez_reg->rowCount() > 0) {
	$row_reg = $rez_reg->fetch();
	$error_msg = $row_reg['_inf']; //'1' - проверка пройдена
	if ($error_msg == '1') {
		session_start();
		$_SESSION['starttime'] = time();
		$_SESSION["mail"]=$mail;
		$_SESSION["ses"]=$pass;
	}
}
$rez_reg->closeCursor();
echo ':::'.$error_msg.':::';
?>
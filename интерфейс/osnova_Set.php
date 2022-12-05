<?php
require_once("/var/www/html/conectBD/databaseconnect.php");
$dbS = new DB_CONNECT();
$connd = $dbS->connect_bd('KR1');
$error_msg = '0';
$par = $_REQUEST ['par'];
$idcomp = $_REQUEST ['idcomp'];
$code = $_REQUEST ['code'];
$nameCom = $_REQUEST ['nameCom'];
$keyword = $_REQUEST ['keyword'];
$services = $_REQUEST ['services'];
$phone = $_REQUEST ['phone'];
$url = $_REQUEST ['url'];
$katPR = $_REQUEST ['katPR'];
$addres = $_REQUEST ['addres'];
$sql = "call add_new_PR('$par','$idcomp','$nameCom','$keyword','$services','$phone','$url','$katPR','$addres','$code');";
$rez_osn = $connd->prepare($sql);
$rez_osn->execute();
if($rez_osn->rowCount() > 0) {
	$row_osn = $rez_osn->fetch();
	$error_msg = $row_osn['_inf'];
}
$rez_osn->closeCursor();
echo ':::'.$error_msg.':::';
?>
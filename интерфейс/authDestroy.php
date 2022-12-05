<?php
if ($_REQUEST['out']) {
	$out = $_REQUEST['out']; 
}else{
	$out = '0';
}
session_start();
$idLifetime = 1800; //  завершение сианса если нет активности более 1800сек
$t = time(); 
if ($t-$_SESSION['starttime'] >= $idLifetime ) {
	$out = '1';
}
if ($out == '1') {
	$_SESSION['mail'] ='';
	$_SESSION['ses'] ='';
	session_unset();
	session_destroy();
}
?>
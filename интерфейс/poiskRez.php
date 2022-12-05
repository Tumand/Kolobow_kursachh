<?php
require_once("/var/www/html/conectBD/databaseconnect.php");
$dbS = new DB_CONNECT();
$connd = $dbS->connect_bd('KR1');
$poisk = $_REQUEST['poisk'];
$bottom_pr = "0";
session_start();
IF ($_SESSION['mail']) {
	$sql = "SELECT * FROM auth WHERE st_mail = '2' AND mail = '".$_SESSION['mail']."';";
	$rez_reg = $connd->prepare($sql);
	$rez_reg->execute();
	if($rez_reg->rowCount() > 0) {
		$bottom_pr = "1";
		
	}
	$rez_reg->closeCursor();
}




$sql = "call poisk_PR('$poisk');";
$rez_poisk = $connd->prepare($sql);
$rez_poisk->execute();
if($rez_poisk->rowCount() > 0) {
	echo "<p class='form_poisk_block_head_text'>РЕЗУЛЬТАТ</p>";
	while($row_poisk = $rez_poisk->fetch()){
		IF ($bottom_pr == "1") {
				$bottom = "<button class='rez' type='submit' id='form_addosnova_submit' onclick = 'setEdit(".$row_poisk['id'].")'><font size='4'><b>✏️</b></font></button>";
		}
		echo "<div class='form_osn_button' onclick = \"setPoiskCompany('".$row_poisk['id']."')\">".$row_poisk['name']."$bottom</div>
		<div id='poiskRezCompany".$row_poisk['id']."'></div>";
	}
} else{
	echo "<p class='form_poisk_block_head_text'>результат не найден</p>";
}
$rez_poisk->closeCursor();

?>
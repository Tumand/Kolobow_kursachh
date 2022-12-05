<?php
require_once("/var/www/html/conectBD/databaseconnect.php");
$dbS = new DB_CONNECT();
$connd = $dbS->connect_bd('KR1');
$poisk = $_REQUEST['poisk'];
$sql = "SELECT * FROM company where id_company = '$poisk'";
$rez_poisk = $connd->prepare($sql);
$rez_poisk->execute();
$echo .= "<table width='98%' border='0'>";
if($rez_poisk->rowCount() > 0) {
	while($row_poisk = $rez_poisk->fetch()){
		
		$echo .= "	<tr><td width='8%'><font size='2' color='#3d3d3d'>Услуги:</font></td><td width='92%'>".$row_poisk['services_pr']."</td></tr>
					<tr><td><font size='2' color='#3d3d3d'>Сайт:</font></td><td>".$row_poisk['website_pr']."</td></tr>
					<tr><td><font size='2' color='#3d3d3d'>Телефон:</font></td><td>".$row_poisk['phone_pr']."</td></tr>
					<tr><td><font size='2' color='#3d3d3d'>Адрес:</font></td><td>".$row_poisk['adres_pr']."</td></tr>";
		
	}
} 
$rez_poisk->closeCursor();
$echo .= "</table>";
echo" <div class='form_poisk_rez'><center>
		$echo
		</center></div>";
?>
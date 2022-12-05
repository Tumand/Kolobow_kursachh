<?php
require_once("/var/www/html/conectBD/databaseconnect.php");
$dbS = new DB_CONNECT();
$connd = $dbS->connect_bd('KR1');
$idpoisk = $_REQUEST['idpoisk'];
$sql = "SELECT * FROM company where id_company = '$idpoisk' limit 1";
$rez_com = $connd->prepare($sql);
$rez_com->execute();
$echo .= "<table width='98%' border='0'>";
if($rez_com->rowCount() > 0) {
	$row_com = $rez_com->fetch();
	$sql = "SELECT * FROM pre_company where id = '$idpoisk' limit 1";
	$rez_pre_com = $connd->prepare($sql);
	$rez_pre_com->execute();
	$row_pre_com = $rez_pre_com->fetch();
	
	$sql = "SELECT * FROM company_category where id = '".$row_pre_com['id_category']."' limit 1";
	$rez_cat = $connd->prepare($sql);
	$rez_cat->execute();
	$row_cat= $rez_cat->fetch();
	
	echo " <div class='osnova'>
			<div class='form_osn_block'>
			<p class='form_osn_block_head_text'>Форма изменения предприятия</p>
			<table border='0' width='100%' cellpadding='5'>
				<tr>
					<td align='right'>
						<input type='text' name='nameCom' style='font-size:18px;' id='nameCom' placeholder='введите название предприятия' required value='".$row_pre_com['name']."'>
					</td>
					<td  width='10%'>
					</td>
				</tr>
				<tr>
					<td align='right'>
						<input type='text' name='services' style='font-size:18px;' id='services' placeholder='введите услуги предприятия' required value='".$row_com['services_pr']."'>
					</td>
					<td>
					</td>
				</tr>
				<tr>
					<td align='right'>
						<input type='text' name='addres' style='font-size:18px;' id='addres' placeholder='введите адрес предприятия' required value='".$row_com['adres_pr']."'>
					</td>
					<td>
					</td>
				</tr>
				<tr>
					<td align='right'>
						<input type='tel' name='phone' style='font-size:18px;' id='phone' placeholder='введите контактный телефон предприятия' required value='".$row_com['phone_pr']."'>
					</td>
					<td>
					</td>
				</tr>
				<tr>
					<td  align='right'>
						<input type='url' name='url' style='font-size:18px;' id='url' placeholder='введите сайт предприятия' required value='".$row_com['website_pr']."'>
					</td>
					<td>
					</td>
				</tr>
				<tr>
					<td align='right'>
						<input type='text' name='katPR' style='font-size:18px;' id='katPR' placeholder='введите категорию предприятия' required value='".$row_cat['nm_category']."'>
					</td>
					<td>	
						<button  style='border-radius: 10px;border: none;cursor: pointer;' onclick = \"setaddkat('')\"><font size='5'>+</font></button>
					</td>
				</tr>
				<tr>
					<td align='right'>
						<input type='text' name='keyword' style='font-size:18px;' id='keyword' placeholder='введите ключевые слова для поиска вашего предприятия' required value='".$row_pre_com['keyword']."'>
					</td>
					<td>
					</td>
				</tr>
				<tr>
					<td colspan='2'><br>
						<button class='form_osn_button' onclick = \"setPR('1','$idpoisk')\"><font size='4'><b>сохранить </b></font></button>
					</td>
				</tr>
				<tr>
					<td colspan='2'>
						<button class='form_osn_button' onclick = \"setPoisk('')\"><font size='3'>Назад</font></button>			
					</td>
				</tr>
			</table>
			</div>
			</div>";
			$rez_cat->closeCursor();
			$rez_pre_com->closeCursor();	
} 
$rez_com->closeCursor();	
?>
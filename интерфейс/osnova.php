<?php
require_once("/var/www/html/conectBD/databaseconnect.php");
$dbS = new DB_CONNECT();
$connd = $dbS->connect_bd('KR1');
$code_msg = '0';
$sql = "call add_key();";
$rez_osn = $connd->prepare($sql);
$rez_osn->execute();
if($rez_osn->rowCount() > 0) {
	$row_osn = $rez_osn->fetch();
	$code_msg = $row_osn['_code'];
}
$rez_osn->closeCursor();
echo " <div class='osnova'>
	<div class='form_osn_block'>
	<p class='form_osn_block_head_text'>Форма добавления предприятия</p>
	<table border='0' width='100%' cellpadding='5'>
		<tr>
			<td align='right'>
				<input type='text' name='nameCom' style='font-size:18px;' id='nameCom' placeholder='введите название предприятия' required value=''>
			</td>
			<td  width='10%'>
			</td>
		</tr>
		<tr>
			<td align='right'>
				<input type='text' name='services' style='font-size:18px;' id='services' placeholder='введите услуги предприятия' required value=''>
			</td>
			<td>
			</td>
		</tr>
		<tr>
			<td align='right'>
				<input type='text' name='addres' style='font-size:18px;' id='addres' placeholder='введите адрес предприятия' required value=''>
			</td>
			<td>
			</td>
		</tr>
		<tr>
			<td align='right'>
				<input type='tel' name='phone' style='font-size:18px;' id='phone' placeholder='введите контактный телефон предприятия' required value=''>
			</td>
			<td>
			</td>
		</tr>
		<tr>
			<td  align='right'>
				<input type='url' name='url' style='font-size:18px;' id='url' placeholder='введите сайт предприятия' required value=''>
			</td>
			<td>
			</td>
		</tr>
		<tr>
			<td align='right'>
				<input type='text' name='katPR' style='font-size:18px;' id='katPR' placeholder='введите категорию предприятия' required value=''>
			</td>
			<td>	
				<button  style='border-radius: 10px;border: none;cursor: pointer;' onclick = \"setaddkat('')\"><font size='5'>+</font></button>
			</td>
		</tr>
		<tr>
			<td align='right'>
				<input type='text' name='keyword' style='font-size:18px;' id='keyword' placeholder='введите ключевые слова для поиска вашего предприятия' required value=''>
			</td>
			<td>
			</td>
		</tr>
		<tr>
			<td colspan='2'><br>
				<button class='form_osn_button' onclick = \"setPR('0','0')\"><font size='4'><b>добавить</b></font></button>
			</td>
		</tr>
		<tr>
			<td colspan='2'>
				<button class='form_osn_button' onclick = \"setPoisk('')\"><font size='3'>Назад</font></button>			
			</td>
		</tr>
	</table>
	</div>
	</div>
	<div id='Code' style = 'display:none;'>$code_msg</div>";
?>
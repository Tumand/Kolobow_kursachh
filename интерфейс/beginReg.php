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
echo "<div class='form_reg_block'>
			<div class='form_auth_block_content'>
				<p class='form_auth_block_head_text'>Форма регистрации</p>
				
					<input type='email' name='mailReg' style='font-size:18px;' id='mailReg' placeholder='Почта' required value=''><br>
					<input type='password' name='passReg' style='font-size:18px;' id='passReg' placeholder='Пароль' required value=''><br>
					<input type='password' name='rePassReg' style='font-size:18px;'  id='rePassReg' placeholder='Повторите ваш пароль' required value=''><br><br>
					<button class='form_auth_button' onclick = \"setReg()\"><font size='4'><b>Зарегистрироваться</b></font></button><br>
					<button class='form_auth_button' onclick = \"setAuthPriv('')\"><font size='3'>Назад</font></button><br>
					<div id='Code' style = 'display:block;'>$code_msg</div>
			</div>
	</div>";
?>
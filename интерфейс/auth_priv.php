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
echo "<div class='form_auth_block'>
			  <div class='form_auth_block_content'>
					<p class='form_auth_block_head_text'>Авторизация</p>
					 <label>Введите Вашу почту и пароль</label><br>
					  <input type='email' style='font-size:18px;' id='auth_mail' placeholder='Введите Вашу почту' required ><br>
					  <input type='password' style='font-size:18px;' id='auth_pass' placeholder='Введите пароль' required ><br><br>
					  <button class='form_auth_button' type='submit' id='form_auth_submit' onclick = 'setAuthPR()'><font size='4'><b>Войти</b></font></button>
					  <button class='form_auth_button' type='submit' id='form_auth_reg' onclick = 'setBeginReg()'><font size='3'>Регистрация</font></button><br>
					  <button class='form_auth_button' type='submit' id='form_auth_reg' onclick = 'setPoisk()'><font size='3'>Назад</font></button>
			  </div>
		</div>
		<div id='Code' style = 'display:none;'>$code_msg</div>";
?>
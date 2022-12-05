<?php
$rand = rand(10000,99999);
echo "<html xmlns='http://www.w3.org/1999/xhtml' lang='en' xml:lang='en' class='form_poisk_RRRRRRRR'>
		<head>
			<title> курсач </title>
			<link type='text/css' rel='stylesheet' href='css/indexcss.css?r=$rand'>
			<script type='text/javascript' src='./js/jquery.min.js?r=$rand'></script>
			<link rel='icon' type='image/jpeg' href='./imj/icon.jpg?r=$rand'>
		</head>
		<div id='loadAuth' style='background: #ffffff;opacity: 0.8; margin: 0 auto;'></div>
		<div  id='loadIndex'>privet</div>
		<div id='loadCod' style = 'display:block;'></div>
	</html>";
If ($_SESSION['starttime']){
	$idLifetime = 1800; //  завершение сеанса если нет активности более 1800сек   
	$t = time(); 
	session_start();
	if ($t-$_SESSION['starttime'] >= $idLifetime ) {
		$_SESSION['mail'] ='';
		$_SESSION['ses'] ='';
		session_unset();
		session_destroy();
	}else{
		session_regenerate_id(true);
		$_SESSION['starttime'] = $t;
	}
}
	
?>
<script>
	var loadHTMLI ='Load...';
	setAuth();
	setPoisk();
	setInterval('setAuthDestroy()',600000);
	
	// функция проверяет правильность вводв email
	function isValidEmailAddress(emailAddress) {
		var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
		return pattern.test(emailAddress);
	}
	
	// функция проверяет время сессии аунтефикации, раз в 10 мин вызывает скрипт провряющий активность в течении 30 мин при не активности завершает сессию
	function setAuthDestroy (out){		
		var rand = Math.random();
		$('#loadCod').load('authDestroy.php?out='+out+'&r='+rand, function () {	
			$('#loadCod').html('');
			setAuth();
		//	$('#loadIndex').html('');
		});	
	}
	// функция вызывает окно авторизации 
	function setAuth (){
		var rand = Math.random();
		$('#loadAuth').load('auth.php?r='+rand, function () {	
			loadHTMLI = $('#loadAuth').html().replace(String.fromCharCode(65279), '');// удаление отступа #65279
			$('#loadAuth').html(loadHTMLI);
		});
	}
	// функция вызывает окно авторизации 
	function setAuthPriv (mail){
		var rand = Math.random();
		$('#loadIndex').load('auth_priv.php?r='+rand, function () {	
			loadHTMLI = $('#loadIndex').html().replace(String.fromCharCode(65279), '');// удаление отступа #65279
			$('#loadIndex').html(loadHTMLI);
			$('#auth_mail').val(mail);
		});
	}
	// функция проверяет правильность ввода данных и вызывает скрипт поиска данных в бд, после выполняет вход
	function setAuthPR (){ 
		var rand = Math.random();
		var errAuth = 0;
		var errAuthTxt = '';
		var code = $('#Code').html();
		var mailAuth = $('#auth_mail').val();
		var passAuth = $('#auth_pass').val();
		
		if (passAuth.length < 8) {errAuth = 1; errAuthTxt = 'пароль должен быть не меньше 8 символов, ты хлебушек';} 
		if (!isValidEmailAddress(mailAuth)) {errAuth = 1; errAuthTxt = 'e-mail некорректен, ты хлебушек';}
		if (errAuth == 0) {
			$('#loadCod').load('authSet.php?mail='+mailAuth+'&pass='+passAuth+'&code='+code+'&r='+rand, function () {	
					loadHTMLI = $('#loadCod').html().replace(String.fromCharCode(65279), '');
					$('#loadCod').html('');
					var massOtv = loadHTMLI.split(':::');
					if (massOtv[1] == '0'){
						alert('не правильный логин или пароль');
					}else{
						setAuth(); 
						setPoisk();
						$('#loadIndex').html('');
					}
			});
		}else{
			alert(errAuthTxt);
		}
	}
	// функция вызывает окно регистрации
	function setBeginReg (){
		var rand = Math.random();
		$('#loadIndex').load('beginReg.php?r='+rand, function () {	
			loadHTMLI = $('#loadIndex').html().replace(String.fromCharCode(65279), '');
			$('#loadIndex').html(loadHTMLI);
		});
		
	}
	function setOsnova (){
		var rand = Math.random();
		$('#loadIndex').load('osnova.php?r='+rand, function () {	
			loadHTMLI = $('#loadIndex').html().replace(String.fromCharCode(65279), '');
			$('#loadIndex').html(loadHTMLI);
		});
		
	}
	// функция проверяет правильность ввода данных и вызывает скрипт регистрации в бд, проверяя на уже существующие записи) 
	function setReg (){
		var rand = Math.random();
		var errReg = 0;
		var errRegTxt = '';
		var code = $('#Code').html();
		var mailReg = $('#mailReg').val();
		var passReg = $('#passReg').val();
		var rePassReg = $('#rePassReg').val();
		
		if (passReg != rePassReg) { errReg = 1; errRegTxt = 'пароли не совпадают, ты хлебушек';}
		if (passReg.length < 8) { errReg = 1; errRegTxt = 'пароль должен быть не меньше 8 символов, ты хлебушек';}
		if (!isValidEmailAddress(mailReg)) { errReg = 1; errRegTxt = 'e-mail некорректен, ты хлебушек';}
		
		if (errReg == 0) {
				$('#loadCod').load('registracia.php?mail='+mailReg+'&pass='+passReg+'&code='+code+'&r='+rand, function () {	
					loadHTMLI = $('#loadCod').html().replace(String.fromCharCode(65279), '');
					$('#loadCod').html('');
					var massOtv = loadHTMLI.split(':::');
					if (massOtv[1] == '1'){
						alert('пользователь с такими даными уже существует');
					}else{
						setAuthPriv(mailReg);
					}
				});
		}else{
			alert(errRegTxt);
		}
		
	}
	function setPR (par, idcomp){// par - если 0 то добавляем новую компанию, если 1 то обновляем данные по компании; idcomp - используется если par = 1, эт id компании для обновления
		var rand = Math.random();
		var errSet = '0';
		var errSetTxt = '';
		
		var code = $('#Code').html();
		var nameCom = $('#nameCom').val();
		var keyword = $('#keyword').val();
		var services = $('#services').val();
		var phone = $('#phone').val();
		var url = $('#url').val();
		var katPR = $('#katPR').val();
		var addres = $('#addres').val();
		
		if (nameCom.length < 1) { errSet = 1; errSetTxt = ' название должно быть, ты хлебушек';}
		if (services.length < 1) { errSet = 1; errSetTxt = 'услуги должны быть, ты хлебушек';}
		if (addres.length < 1) { errSet = 1; errSetTxt = 'адрес должен быть, ты хлебушек';}
		if (phone.length < 11) { errSet = 1; errSetTxt = 'телефон должен состоять из не менее 11 символов, ты хлебушек';}
		if (url.length < 1) { errSet = 1; errSetTxt = 'сайт должен быть, ты хлебушек';}
		if (katPR.length < 1) { errSet = 1; errSetTxt = 'категория должна быть, ты хлебушек';}
		if (keyword.length < 1) { errSet = 1; errSetTxt = 'ключ должен быть, ты хлебушек';}
			
		if (errSet == 0) {
			var parametr = encodeURI('par='+par+'&idcomp='+idcomp+'&nameCom='+nameCom+'&keyword='+keyword+'&services='+services+'&phone='+phone+'&url='+url+'&katPR='+katPR+'&addres='+addres+'&code='+code+'&r='+rand);
			$('#loadCod').load('osnova_Set.php?'+parametr, function () {	
				loadHTMLI = $('#loadCod').html().replace(String.fromCharCode(65279), '');
				
				$('#loadCod').html('');
				setAuth();
				setPoisk();
			});
		}else{
			alert(errSetTxt);
		}
	}
	// функция вызывает окно поиска
	function setPoisk (){
		var rand = Math.random();
		$('#loadIndex').load('PoiskSet.php?r='+rand, function () {	
			loadHTMLI = $('#loadIndex').html().replace(String.fromCharCode(65279), '');
			$('#loadIndex').html(loadHTMLI);
		});
	}
	function setPoiskRez (){
		var rand = Math.random();
		var poiskPR = $('#poiskPR').val();
		$('#poiskRez').load('poiskRez.php?poisk='+encodeURI(poiskPR)+'&r='+rand, function () {	
			loadHTMLI = $('#poiskRez').html().replace(String.fromCharCode(65279), '');
			$('#poiskRez').html(loadHTMLI);
		});
	}
	function setPoiskCompany (id){
		var rand = Math.random();
		var IdDiv = '#poiskRezCompany'+id;
		if ($(IdDiv).html() == '') {
			$(IdDiv).load('poiskCompany.php?poisk='+id+'&r='+rand, function () {	
				loadHTMLI = $(IdDiv).html().replace(String.fromCharCode(65279), '');
				$(IdDiv).html(loadHTMLI);
			});
		} else{
			$(IdDiv).html('');
		}
	}
	function setEdit (id){
		var rand = Math.random();
			$('#loadIndex').load('redact.php?idpoisk='+id+'&r='+rand, function () {	
				loadHTMLI = $('#loadIndex').html().replace(String.fromCharCode(65279), '');
				$('#loadIndex').html(loadHTMLI);
			});
	}
</script>
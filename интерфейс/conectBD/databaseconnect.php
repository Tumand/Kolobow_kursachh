<?php
class DB_CONNECT {
    public function __construct() {
                //$this->connect_bd();
	}
    public function __destruct() {
        $this->close();
    }
    public function connect_bd($bd = '0', $host = 'localhost', $port = '31306') {
		//phpinfo(8);
		//print_r(PDO::getAvailableDrivers());
		$usr = "userphp";
		$pass = "PHP_kolobok1";
		if ($bd != '0'){
				try {
				  $conn = new PDO("mysql:host=$host;port=$port;dbname=$bd;charset=utf8;",$usr ,$pass,array(PDO::ATTR_PERSISTENT => true,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));
				  return $conn;
				}
				catch(PDOException $e) {
					die('Подключение не удалось: ' . $e->getMessage());
					return 1;
				}
		}else{
				return null;
		}
    }
    public function close() {
        $connect = null;
    }
}

?>
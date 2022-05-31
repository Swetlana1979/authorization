<?php
//
// Помощник работы с БД
//
class M_MSQL
{
	private static $instance;
	
	public static function Instance(){
		if (self::$instance == null)
			self::$instance = new M_MSQL();
		return self::$instance;
	}
	//
	// Конструктор
	//
	private function __construct(){
		
		
	}
	
	//
	// Соединение с БД
	//
	public function con(){

		
		$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if (!$con) {
			printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error());
			exit;
		}
		return $con;
	}
	
	//
	// Авторизация пользователя
	// $sql - подготовленный запрос
	// $username - имя пользователя
	//
	public function login($sql,$username){
		
		$con = $this->con();
		$stmt = mysqli_prepare($con,$sql); 
		if(!$stmt){
			echo 'не удалось получить данные';		  
		}
		mysqli_stmt_bind_param($stmt, "s", $username);
		mysqli_stmt_execute($stmt);
		$numrows = mysqli_stmt_get_result($stmt);
		$row = mysqli_fetch_array($numrows, MYSQLI_NUM);
		mysqli_stmt_close($stmt);
		return $row;
	}
	
	//
	// Регистрация пользователя
	// $sql - подготовленный запрос
	// $username - имя пользователя
	// $password - пароль
	// $date - время создания
	// $hash - хеш для шифрования пароля
	//
	public function register($sql,$username, $password, $date, $hash){
		
		$con =  $this->con();
		$stmt = mysqli_prepare($con, $sql); 
		mysqli_stmt_bind_param($stmt, "ssss", $username, $password, $date, $hash);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}
}

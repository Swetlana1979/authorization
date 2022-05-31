<?php
class M_User
{
	private static $instance; 	// ссылка на экземпляр класса
	private $msql; 				// драйвер БД
	
	//
	// Получение единственного экземпляра (синглтон)
	//
	public static function instance(){
		if (self::$instance == null)
			self::$instance = new M_User();
		return self::$instance;
	}
	
	//
	// Конструктор
	//
	public function __construct()
	{
		$this->msql = M_MSQL::instance();
	}
	//
	// Авторизация
	// $username - имя пользователя
	// $row - данные зарегистрированного пользователя
	//
	public function login($username){
		$sql="SELECT * FROM users WHERE username = ?";
		$row=$this->msql->login($sql,$username);
		return $row;
	}
	
	
	//
	// Регистрация
	// $username - имя пользователя
	// $password - пароль
	// $date - время создания
	// $row - данные зарегистрированного пользователя
	//
	public function register($username, $password, $date, $hash){
		$sql="INSERT INTO users(username, password, date, hash)VALUES(?,?,?,?)"; 
		$row=$this->msql->register($sql,$username, $password, $date, $hash);
		
	}
}
?>
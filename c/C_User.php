<?php
//
// Конттроллер страницы чтения.
//

class C_User extends C_Base{
	
	
	//
	// Конструктор.
	//
	function __construct()	{		
		
		parent::__construct();
		
	}
	
	//
	// Наследование
	//
	public function mUser() {
		
		return $this->mUser = M_User::Instance();
    }
	
	//
	//Вывод профиля пользователя или формы регистрации
	//
	public function action_index() {
				
		//буферизация данных, отправка в шаблон
		$this->content = $this->template('./v/index.php');		
	}
	
	//
	// Разлогинивание
	//
	public function action_logout() {
		
		unset($_SESSION['session_login']);
		unset($_SESSION['session_id']);
		session_destroy();
		header("location:index.php?act=index");
		
	}
	
	//
	// Авторизация
	//
	public function action_login() {
		
		if((!empty($_POST['login'])&&(!empty($_POST['password'])))){
			$username = htmlspecialchars($_POST['login']);
			$password = htmlspecialchars($_POST['password']);
			$mUser = $this->mUser();
			$row=$mUser->login($username);
			
			if(!empty($row)){
				$dblogin = $row[1];
				$hash = $row[4];
				$dbpass = password_verify($password, $hash);
				$user_id = $row[0];
				if(($username === $dblogin) && ($dbpass===true)){
					$_SESSION['session_login'] = $username;
					$_SESSION['session_id'] = $user_id;
					header("Location:index.php");
				} else {
					$mess = "Неверный логин или пароль!";
					$this->content = $this->template('./v/index.php', array('username'=>$username,'mess' => $mess));
					
				}				
			} else {
				//буферизация данных, отправка в шаблон
				$mess = "Такой пользователь не зарегистрирован";
				$this->content = $this->template('./v/index.php', array('mess' => $mess));
				
			} 
		} else {
			$this->content = $this->template('./v/index.php');
		}
		
	}
	
	//
	// Регистрация
	//
	public function action_register() {
		
		$this->content = $this->template('./v/registerForm.php');
		
		if((!empty($_POST['login'])&&(!empty($_POST['password'])))){
			$username = htmlspecialchars($_POST['login']);
			$password = htmlspecialchars($_POST['password']);
			$password_rep = htmlspecialchars($_POST['password_rep']);
			
			if($password!==$password_rep){
				$mess = "Пароли не совпадают";
				$this->content = $this->template('./v/registerForm.php',array('username' => $username,'mess' => $mess));
			} else {
				$mUser = $this->mUser();
				$row=$mUser->login($username);
				
				if(!empty($row)){
					$mess = "Такой пользователь уже зарегистрирован";
					$this->content = $this->template('./v/registerForm.php', array('mess' => $mess));
				} else{
					
					$date = date("Y-m-d H:i:s");
					$hash = password_hash($password, PASSWORD_BCRYPT);
					$mUser->register($username, $password, $date, $hash);
					$this->content = $this->template('./v/registerSuccess.php',array('username' => $username));
				}
			}
	    } else {
			$this->content = $this->template('./v/registerForm.php');
		} 
	}
}

?>
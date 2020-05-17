<?php
require_once('functions.php');
// require_once('userdata.php');
require_once('config/db.php');
require_once('data_base_func.php');
require_once('vendor/autoload.php');
require_once('database.php');

//Запускаем сессию
session_start();

//запускаем базу данных процедурный метод
// $connect = mysqli_connect($db_host,$db_user,$db_password,$db_name);
// if ($connect == false){
// 	print ('Ошибка подключения: '. mysqli_connect_errors());
// }

// запускаем базу данных ООП
$connect = new mysqli('localhost','root','','yeticave');
if ($connect->connect_errno) {
	die ('Ошибка подключения: '. $connect->connect_errors());
}

//Пользователь проходит аутентификацию и авторизацию
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$form = $_POST;

	$required=['email','password'];
	$errors = [];
	foreach ($required as $value) {
		if(empty($form[$value])){
			$errors[$value] = 'Это поле надо заполнить';
		}
	}

	//проверка через массив.
	// if (!count($errors) and $user = searchUserByEmail($form['email'], $users)){
	// if (password_verify($form['password'], $user['password'])){
	// 	$_SESSION['user']=$user;
	// }
	// 	else {
	// 		$errors['password'] = 'Вы ввели неверный пароль';
	// 	}
	// }
	// else {
	// 	$errors['email'] = 'Такой пользователь не найден';
	// }
	

	// Проверка через базу данных
	if (!empty($form['email'])){
		$email = $form['email'];
		// $sql =  "SELECT * FROM `users` WHERE `email` ='$email'";
		// $email_result = mysqli_query($connect, $sql);
		// $user = mysqli_fetch_array($email_result, MYSQLI_ASSOC);
		$email_result=$connect->query("SELECT * FROM `users` WHERE `email` ='$email'");
		$user = $email_result->fetch_array();
		
		if (!count($errors) and $user){
			if (password_verify($form['password'], $user['password'])) {
				$_SESSION['user']=$user;
			} 
			else {
				$errors['password'] = 'Вы ввели неверный пароль';
			}
		}
		else {
			$errors['email'] = 'Пользователь с таким email не существует';
		}
	}



	if (count($errors)){
		$page_content= include_template('login.php', [
			'form' => $form,
			'errors' => $errors
		]);
	}
	else { 
		header('Location: /index.php');
		exit();
	}

}
else {
	$page_content= include_template('login.php', [
			'form' => $form,
			'errors' => $errors
		]);
}


$layout_content = include_template('layout.php', [
	'content' => $page_content,
	'CategoriesArr' => $CategoriesArr,
	'title' => 'YetiCave - Вход'
]);

print($layout_content);
?>
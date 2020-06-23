<?php
error_reporting(-1);
// require_once('Arrays.php');
require_once('functions.php');
require_once('config/db.php');
require_once('data_base_func.php');
require_once('vendor/autoload.php');

//Запускаем сессию
$is_auth=false;
session_start();


//подключаем базу данных
$connect = new mysqli('localhost','root','','yeticave');
if ($connect->connect_errno) {
	die ('Ошибка подключения: '. $connect->connect_errors());
}



//проверка или пользователь вошел в профиль
//Запускаем сессию

if (isset($_SESSION['user'])){
header('Location:/index.php');

}

// Регистрация
if ($_SERVER['REQUEST_METHOD']=='POST'){
	$regdata = $_POST;

	$required = [
		'email',
		'password',
		'name',
		'message'
	];

	$errors = [];

	foreach ($required as $val){
		if (empty($regdata[$val])){
			$errors[$val] = 'Введите данные';
		}
	}

	if (strlen($regdata['password']) < 6){
		$errors['password'] = 'В пароле должно быть не меньше 6 символов';
	}

	if (strlen($regdata['name']) < 3){
		$errors['name'] = 'В имени должно быть не меньше 3 символов';
	}


	// Проверка email по функции
	// $user = searchUserByEmail($regdata['email'], $users);
	// if ($user['email']==$regdata['email']){
	// 	$errors['email'] = 'Пользователь с таким email уже существует';
	// } elseif (filter_var($regdata['email'], FILTER_VALIDATE_EMAIL)== false){
	// 	$errors['email'] = 'Введите корректный email';
	// }

	// Проверка email по базе данных
	if (!empty($regdata['email'])){
		$email = $regdata['email'];
		// $sql = "SELECT * FROM `users` WHERE `email` ='$email'";
		// $email_result = mysqli_query($connect, $sql);
		// $user = mysqli_fetch_array($email_result, MYSQLI_ASSOC);
		$email_result=$connect->query("SELECT * FROM `users` WHERE `email` ='$email'");
		$user = $email_result->fetch_array();
		if ($user['email'] == $email) {
			$errors['email'] = 'Пользователь с таким email уже существует';
		}
		else
			if (filter_var($regdata['email'], FILTER_VALIDATE_EMAIL)== false){
	 		$errors['email'] = 'Введите корректный email';
	 	}
	}


	//загрузка аватара
	if (isset($_FILES['avatar'])){
        $tmp_name = $_FILES['avatar']['tmp_name'];
        $file_relative_path = '\uploads\\img\\';
        $file_path = __DIR__ . $file_relative_path;
        $file_name = $_FILES['avatar']['name'];
        $file_url = $file_path . $file_name;

        if (!empty($tmp_name)) {
            $file_info = finfo_open(FILEINFO_MIME_TYPE);
            $file_type = finfo_file($file_info, $tmp_name);
        }

		if ($file_type === "image/gif" || $file_type === "image/png" || $file_type === "image/jpeg" || $file_type === "image/jpg") {
			move_uploaded_file($tmp_name, $file_url);
			$regdata['avatar'] = $file_relative_path . $file_name;
		}
		else {
			$error_avatar['avatar'] = 'Загрузите файл в формате jpeg/png';
		}
    }

    if (count($errors)){
    	$page_content = include_template('sign-uppage.php',[
    		'regdata' => $regdata,
    		'errors' => $errors,
    		'error_avatar' => $error_avatar,
    		'Arr1'=> $Arr1,
    		'is_auth' => $is_auth,
    		'user_name' =>$user_name,
    		'CategoriesArr'=> $CategoriesArr
    ]);
    }
    if(empty($errors)){
    	$email = $regdata['email'];
    	$name = $regdata['name'];
    	$password = password_hash($regdata['password'], PASSWORD_DEFAULT);
    	$message = $regdata['message'];

    	// $sql1 = "INSERT INTO `users` SET `user_name`='$name', `password` = '$password', `email`='$email', `message`='$message'";
    	// if (!mysqli_query($connect, $sql1)){
    	// 	echo 'Ошибка: ' . mysqli_error($connect);
    	// }

    	$sql1=$connect->query("INSERT INTO `users` SET
    		`user_name`='$name',
    		`password` = '$password',
    		`email`='$email',
    		`message`='$message'");
		if(!$sql1){
			echo 'Ошибка: ' . $connect->connect_errors();
		}

    	header('Location:/index.php');
    }


}
else {
	$page_content=include_template('sign-uppage.php',[
	'Arr1'=>$Arr1]);
}




$layout_content = include_template('layout.php', [
	'content' => $page_content,
	'CategoriesArr' => $CategoriesArr,
	'title' => 'Регистрация',
	'is_auth'=>$is_auth,
	'user_name' =>$user_name
]);
print($layout_content);

?>

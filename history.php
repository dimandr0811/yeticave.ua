<?php
require_once('functions.php');
// require_once('Arrays.php');
require_once('data_base_func.php');
require_once('vendor/autoload.php');

//проверка или пользователь вошел в профиль
$is_auth=false;
if(!isset($_SESSION)){
    session_start();
}

if (isset($_SESSION['user'])){
    $user_name = $_SESSION['user']['user_name'];
    $is_auth = true;
}

// проверяет или пользователь нажимал на лот
if (isset($_COOKIE['history'])){
	$history_lot = json_decode($_COOKIE['history']);
}

//запускаем базу данных
$connect = mysqli_connect($db_host,$db_user,$db_password,$db_name);
if ($connect == false){
	print ('Ошибка подключения: '. mysqli_connect_errors());
}

$page_content=include_template('historylot.php',[
	'Arr1'=>$Arr1,
	'history_lot' =>$history_lot,
]);

$layout_content = include_template('layout.php', [
	'content' => $page_content,
	'CategoriesArr' => $CategoriesArr,
	'title' => 'История',
	'is_auth'=>$is_auth,
	'user_name' =>$user_name
]);

print($layout_content);

?>
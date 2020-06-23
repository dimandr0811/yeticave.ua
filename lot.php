<?php
error_reporting(0);
require_once('functions.php');
require_once('config/db.php');
require_once('data_base_func.php');
require_once('vendor/autoload.php');

// запускаем базу данных
$connect = mysqli_connect($db_host,$db_user,$db_password,$db_name);
if ($connect == false){
	print ('Ошибка подключения: '. mysqli_connect_errors());
}



//проверка или пользователь вошел в профиль
$is_auth=false;
if(!isset($_SESSION)){
    session_start();
}

if (isset($_SESSION['user'])){
    $user_name = $_SESSION['user']['user_name'];
    $is_auth = true;
}


//Определяется переданный в параметрах идентификатор и получаем по нему соответствующий лот из массива

$lot=null;
if (isset($_GET['lot_id'])){
	$lot_id=$_GET['lot_id'];

	foreach ($Arr1 as $value) {
		if ($value['product_id']==$lot_id){
			$lot=$value;
			break;
		}
	}
}
if (!$lot){
	http_response_code(404);

}

//установка Cookie

if (isset($_COOKIE['history'])) {
	$history_lot=json_decode($_COOKIE['history']);
	if (!in_array($lot_id, $history_lot)){
		array_push($history_lot, $lot_id);
	}
}
else {
	$history_lot=[];
	array_push($history_lot, $lot_id);
}


$ser_history= json_encode($history_lot); // сериализация массива

$name = 'history';
$value = $ser_history;
$expire = time();
$path = '/';

setcookie($name,$value,$expire,$path);


// сделать ставку
	$rate = $_POST;
	$errors = [];
	if (empty($rate['cost'])) {
		$errors['cost']='Введите вашу ставку';
	} else {
		if ($rate['cost']<=$lot['price']){
		$errors['cost'] = 'Введите ставку больше чем '. price_format($lot['price']);
	}
	}

	if (empty($errors)){
		$price = $rate['cost'];
		$id = $lot['product_id'];
		$sql = "UPDATE `products` SET `price`='$price' where `product_id` = '$id'";

		if (!mysqli_query($connect, $sql)){
    		echo 'Ошибка: ' . mysqli_error($connect);
    	}
    	else{
    	header("Location:/lot.php?lot_id=" . $id);
    	}
    	}






$page_content=include_template('lotpage.php',[
	'errors'=>$errors,
	'lot'=>$lot,
	'is_auth' => $is_auth,
]);
$layout_content = include_template('layout.php', [
	'content' => $page_content,
	'CategoriesArr' => $CategoriesArr,
	'title' => 'YetiCave - Просмотр лота',
	'is_auth'=>$is_auth,
	'user_name' =>$user_name
]);
print($layout_content);


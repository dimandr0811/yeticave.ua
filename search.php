<?php
require_once('functions.php');
require_once('config/db.php');
require_once('data_base_func.php');
require_once('vendor/autoload.php');

//проверяет или пользователь вошел в профиль
$is_auth=false;
if(!isset($_SESSION)){
    session_start();
}

if (isset($_SESSION['user'])){
    $user_name = $_SESSION['user']['user_name'];
    $is_auth = true;
}


// запускаем базу данных ООП
$connect = new mysqli('localhost','root','','yeticave');
if ($connect->connect_errno) {
	die ('Ошибка подключения: '. $connect->connect_errors());
}



if ($_SERVER['REQUEST_METHOD']=='GET'){
	$search = $_GET['search'];
	// $sql = "SELECT * FROM `products` JOIN categories on categories.cat_id = products.category 
	// 		WHERE MATCH (product_name,description) AGAINST ('$search') order by product_id asc";
	// $result = mysqli_query($connect,$sql);
	// $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
	$sql = $connect->query("SELECT * FROM `products` JOIN categories on categories.cat_id = products.category 
		WHERE MATCH (product_name,description) AGAINST ('$search') order by product_id asc");
	$rows = $sql->fetch_all(MYSQLI_ASSOC);
    if (empty($rows)){
       	$rows = 'Ничего не найдено по вашему запросу';
    }
}
else {
	$rows = 'Ничего не найдено по вашему запросу';
}




$page_content=include_template('searchpage.php',[
	'Arr1'=>$Arr1,
	'lot' => $rows
]);
$layout_content = include_template('layout.php', [
	'content' => $page_content,
	'CategoriesArr' => $CategoriesArr,
	'title' => 'YetiCave - Главная страница',
	'is_auth'=>$is_auth,
	'user_name' =>$user_name
]);
print($layout_content);
?>

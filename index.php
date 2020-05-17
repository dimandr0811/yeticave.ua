<?php
// require_once('Arrays.php');
require_once('functions.php');
require_once('config/db.php');
require_once('data_base_func.php');
require_once('vendor/autoload.php');

// запускаем базу данных
// $connect = mysqli_connect($db_host,$db_user,$db_password,$db_name);
// if ($connect == false){
// 	print ('Ошибка подключения: '. mysqli_connect_errors());
// }


// Все перешло в файл data_base_func.php
// // Подлючаем таблицу Категории из Базы данных
// $sql_cat = "SELECT * FROM `categories`";
// $result_cat = mysqli_query($connect, $sql_cat);
// $CategoriesArr = mysqli_fetch_all($result_cat, MYSQLI_ASSOC);

// // Подключаем таблицу Продакт из Базы данных
// $sql_product = "SELECT
// product_id,
// product_name,
// price, 
// URL_picture,
// cat_name
// FROM products
// JOIN categories on categories.cat_id = products.category
// order by product_id asc";
// $result_product = mysqli_query($connect, $sql_product);
// $Arr1 = mysqli_fetch_all($result_product, MYSQLI_ASSOC);



//проверяет или пользователь вошел в профиль
$is_auth=false;
if(!isset($_SESSION)){
    session_start();
}

if (isset($_SESSION['user'])){
    $user_name = $_SESSION['user']['user_name'];
    $is_auth = true;
}

// пагинация
// $cur_page = $_GET['page']?? 1;
// $page_items = 6;
// $result = mysqli_query($connect, "SELECT count(*) as cnt from products");
// $items_count = mysqli_fetch_assoc($result)['cnt'];
// $pages_count = ceil($items_count/$page_items);
// $offset = ($cur_page-1)*$page_items;
// $pages = range(1, $pages_count);



$page_content=include_template('index.php',[
	'Arr1'=>$Arr1
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

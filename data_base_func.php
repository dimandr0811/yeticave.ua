<?php
require_once('functions.php');
require_once('config/db.php');
require_once('vendor/autoload.php');
require_once('database.php');

//Используем ООП в database.php
$db = new database ($db_host,$db_user,$db_password,$db_name);

if ($db->getLastError()){
	var_dump($db->getLastError());
}
else{
	// Подлючаем таблицу Категории из Базы данных (layout.php)
	$db->executeQuery("SELECT * FROM `categories`");

	if (!$db->getLastError()){
		$CategoriesArr = $db->getResultAsArray();
	}
	else {
		var_dump($db->getLastError());
	}

	// Подключаем таблицу Продакт из Базы данных (index.php)
	$db->executeQuery("SELECT
	product_id,
	product_name,
	price, 
	URL_picture,
	start_price,
	rate,
	description,
	author,
	user_name,
	cat_name
	FROM products
	JOIN categories on categories.cat_id = products.category
	JOIN users on users.user_id = products.author
	order by product_id asc");

	if (!$db->getLastError()){
		$Arr1 = $db->getResultAsArray();
	}
	else {
		var_dump($db->getLastError());
	}

	// Подключаем таблицу Продакт из Базы данных (lot.php)
	$db->executeQuery("SELECT
	product_id,
	product_name,
	price, 
	URL_picture,
	start_price,
	rate,
	description,
	author,
	user_name,
	cat_name
	FROM products
	JOIN categories on categories.cat_id = products.category
	JOIN users on users.user_id = products.author
	order by product_id asc");

	if (!$db->getLastError()){
		$lot = $db->getResultAsArray();
	}
	else {
		var_dump($db->getLastError());
	}
}

// запускаем базу данных
// $connect = mysqli_connect($db_host,$db_user,$db_password,$db_name);
// if ($connect == false){
// 	print ('Ошибка подключения: '. mysqli_connect_errors());
// }


// Подлючаем таблицу Категории из Базы данных (layout.php)
// $sql_cat = "SELECT * FROM `categories`";
// $result_cat = mysqli_query($connect, $sql_cat);
// $CategoriesArr = mysqli_fetch_all($result_cat, MYSQLI_ASSOC);

// Подключаем таблицу Продакт из Базы данных (index.php)
// $sql_product = "SELECT
// product_id,
// product_name,
// price, 
// URL_picture,
// start_price,
// rate,
// description,
// author,
// user_name,
// cat_name
// FROM products
// JOIN categories on categories.cat_id = products.category
// JOIN users on users.user_id = products.author
// order by product_id asc";
// $result_product = mysqli_query($connect, $sql_product);
// $Arr1 = mysqli_fetch_all($result_product, MYSQLI_ASSOC);


// // Подключаем таблицу Продакт из Базы данных (lot.php)
// $sql_product = "SELECT
// product_id,
// product_name,
// price, 
// URL_picture,
// start_price,
// rate,
// description,
// author,
// user_name,
// cat_name
// FROM products
// JOIN categories on categories.cat_id = products.category
// JOIN users on users.user_id = products.author
// order by product_id asc";
// $result_product = mysqli_query($connect, $sql_product);
// $lot = mysqli_fetch_all($result_product, MYSQLI_ASSOC);
?>
<?php
require_once('functions.php');
// require_once('Arrays.php');
require_once('data_base_func.php');

//проверка или пользователь вошел в профиль
$is_auth=false;
if(!isset($_SESSION)){
    session_start();
}

if (isset($_SESSION['user'])){
    $user_name = $_SESSION['user']['user_name'];
    $is_auth = true;
}
//если пользователь не вошел, то выдавать ошибку 403
else {
	http_response_code(403);
	exit();
}

//запускаем базу данных
//$connect = mysqli_connect($db_host,$db_user,$db_password,$db_name);
//if ($connect == false){
//    print ('Ошибка подключения: '. mysqli_connect_errors());
//}

// запускаем базу данных ООП
$connect = new mysqli('localhost','root','','yeticave');
if ($connect->connect_errno) {
    die ('Ошибка подключения: '. $connect->connect_error);
}
//добавление лота
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$addlot=$_POST;

	$required= [
		'lot-name',
		'category',
		'message',
		'lot-rate',
		'lot-step',
		'lot-date'
	];

	// $errors_descr =[
	// 	'lot-name'=>'Наименование',
	// 	'category'=>'Категория',
	// 	'message'=>'Описание',
	// 	'lot-rate'=>'Начальная цена',
	// 	'lot-step'=>'Шаг ставки',
	// 	'lot-date'=>'Дата окончания торгов'
	// ];

	$errors = [];

	// Проверяем наличие данных в форме. Если их нет - заполняем массив $errors.
	foreach ($required as $value) {
		if(empty($addlot[$value])){
			$errors[$value] ='Заполни поле';
		}
	}

	if (!is_numeric($addlot['lot-rate'])) {
        $errors['lot-rate'] = "Заполните поле корректными данными";
    }
    if (!is_numeric($addlot['lot-step'])) {
        $errors['lot-step'] = "Заполните поле корректными данными";
    }

    if ($addlot['category']=='Выберите из списка'){
    	$errors['category'] = 'Категория не выбрана';
    }


    if (!isset($_FILES['filename'])) {
    	$errors['filename'] = 'Файл не загружен';
	}
	else {
		$tmp_name = $_FILES['filename']['tmp_name'];
        $file_relative_path = '\uploads\\img\\';
        $file_path = __DIR__ . $file_relative_path;
        $file_name = $_FILES['filename']['name'];
        $file_url = $file_path . $file_name;

        if (!empty($tmp_name)) {
            $file_info = finfo_open(FILEINFO_MIME_TYPE);
            $file_type = finfo_file($file_info, $tmp_name);
        }

		if ($file_type === "image/gif" || $file_type === "image/png" || $file_type === "image/jpeg" || $file_type === "image/jpg") {
			move_uploaded_file($tmp_name, $file_url);
			$addlot['filename'] = $file_relative_path . $file_name;
		}
		else {
			$errors['filename'] = 'Загрузите файл в формате jpeg/png';
		}

	}

	if (count($errors)) {
		$page_content = include_template('addlot.php', [
			'addlot' => $addlot,
			'errors' => $errors,
			// 'error_descr' => $error_descr,
			'is_auth'=>$is_auth,
			'user_name' =>$user_name,
			'CategoriesArr'=> $CategoriesArr
		]);
	}

	//добавление лота в базу данных
    if(empty($errors)){
    	$lot_name = $addlot['lot-name'];
    	$category = $addlot['category'];
    	$URL_picture = "uploads/img/" . $file_name;
    	$start_price = $addlot['lot-rate'];
    	$rate = $addlot['lot-step'];
    	$date = $addlot['lot-date'];
    	$author = $_SESSION['user']['user_id'];

    	// Категория из другой таблицы.
    	$category = $addlot['category'];
    	$category = (string)$category;
//    	$sqlcat =  "SELECT * FROM `categories`";
//    	$sqlres = mysqli_query($connect, $sqlcat);
//    	$rescat = mysqli_fetch_all($sqlres, MYSQLI_ASSOC);
        $sqlcat = $connect->query("SELECT * FROM `categories`");
        $rescat = $sqlcat->fetch_all(MYSQLI_ASSOC);
    	foreach ($rescat as $val){
    		if (($category)== ($val['cat_name'])){
    			$category = $val['cat_id'];
    			break;
    		}
    	}

    	$sql = "INSERT INTO `products` SET
    	`product_name`='$lot_name',
    	`category` = '$category',
    	`start_price`='$start_price',
    	`price`='$start_price',
    	`rate`='$rate',
    	`URL_picture` = '$URL_picture',
    	`data`='$date',
    	`author`='$author',
    	`state` = 'open'";
        $success= $connect->query($sql);
    	if (!$success){
    		echo 'Ошибка: ' . $connect->error;
    	}
    	else{
    	$lot_id = $connect->insert_id;
    	header("Location:/lot.php?lot_id=" . $lot_id);
    	}
    }

}
else {
        $page_content = include_template('addlot.php', [
        	'CategoriesArr'=> $CategoriesArr
        ]);
     }


$layout_content = include_template('layout.php', [
	'content' => $page_content,
	'CategoriesArr' => [],
	'title' => 'Добавление лота',
	'is_auth'=>$is_auth,
	'user_name' =>$user_name,
]);

print($layout_content);


?>

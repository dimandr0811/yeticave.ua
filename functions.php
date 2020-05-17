<?php

//Функция - шаблонизатор
function include_template ($path,$array=array()) {
	if(file_exists('templates/'.$path)) {
 		ob_start();
 		extract($array);
 		require 'templates/'.$path;
 		return ob_get_clean();
 	} else {
 		return (' ');
 	}
}


//Функция, формирующая цену
function price_format ($price) {
  $price = ceil($price);
  if ($price < 1000 and $price >0) {
    return ($price . ' грн');
  } elseif ($price >= 1000) {
    $price = number_format($price);
    return ($price. ' грн');
  } else {
    $price ='Ошибка в цене';
    return ($price);
  }
}


//Функция поиска Пользователя по Email (для базы данных не нужна)
function searchUserByEmail($email, $users){
  $result=null;
  foreach($users as $user) {
    if ($user['email'] == $email){
      $result = $user;
      break;
    }
  }
  return $result;
}

date_default_timezone_set('Europe/Kiev');
$ost = date('H:i:s',strtotime('tomorrow+6')-time('now'));

?>
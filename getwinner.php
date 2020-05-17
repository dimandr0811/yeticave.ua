<?php
require_once('functions.php');
require_once('config/db.php');
require_once('data_base_func.php');
require_once('vendor/autoload.php');


$transport = (new Swift_SmtpTransport('smtp.ukr.net',465))
 			->setUsername('dimandr@ukr.net')
        	->setPassword('cjyzcjyz0811')
;
$mailer = new Swift_Mailer($transport);

$message = new Swift_Message();
$message -> setSubject('Вы Выиграли');
$message -> setFrom(['dimandr@ukr.net' => 'yeticave.ua']);
$message -> setTo(['dimandr@i.ua' =>'Дмитрий']);
$message -> setBody('Здравствуйте! Вы выиграли');

$result = $mailer->send($message);



?>
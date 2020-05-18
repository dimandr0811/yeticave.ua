<?
require_once('functions.php');
// require_once('Arrays.php');
require_once('data_base_func.php');
require_once('vendor/autoload.php');


$gump = new GUMP();

$gump ->validation_rules([
	'email' => 'required|valid_email',
	'password' =>'required|max_len,100|min_len,10',
	'name'=>'required',
	'age'=>'required|numeric'
]);

$gump->set_fields_error_messages([
	'email'=>[
		'required'=>'Введите email',
		'valid_email'=>'Введите email'
	],
	'password' =>[
		'required' => 'Введите пароль',
		'max_len|min_len' => 'Введите пароль'
	],
	'name'=>[
		'required'=>'Введите имя'
	],
	'age'=>[
		'required'=>'Введите возраст',
	],

]);

$gump->filter_rules([
    'email' => 'trim|sanitize_email',
    'password' => 'trim',
    'name'    => 'trim',
    'age'   => 'trim'
]);

$valid_data = $gump->run($_POST);


$errors = $gump->get_errors_array();
echo '<pre>';
var_dump($errors);
echo '</pre>';

echo '<pre>';
var_dump($valid_data);
echo '</pre>';



$page_content = include_template('testpage.php',[
'valid_data'=>$valid_data,
'errors'=>$errors
]);

$layout_content = include_template('layout.php', [
	'content' => $page_content,
	'CategoriesArr' => $CategoriesArr,
	'title' => 'Test',
]);
print($layout_content);

?>

<main>
	<h2>Регистрация нового аккаунта</h2>
	<form action="test.php" method="post" enctype="multipart/form-data">

	<?php 
  $error_email = isset($errors['email']) ? $errors['email'] : '';
  $error_name = isset($errors['name']) ? $errors['name'] : '';
  $error_password = isset($errors['password']) ? $errors['password'] : '';
  $error_age = isset($errors['age']) ? $errors['age'] : '';
   ?>

	<div> 
      <label>E-mail*</label>
      <input id="email" type="text" name="email" placeholder="Введите e-mail">
      <span ><?=$error_email;?></span>
    </div>
    <div> 
      <label>Имя</label>
      <input id="name" type="text" name="name" placeholder="Введите имя">
      <span><?=$error_name;?></span>
    </div>
	<div> 
      <label>Пароль</label>
      <input id="password" type="password" name="password" placeholder="Введите пароль">
      <span><?=$error_password;?></span>
    </div>
	<div> 
      <label>Возраст</label>
      <input id="number" type="number" name="age" placeholder="Введите ваш возраст">
      <span ><?=$error_age;?></span>
    </div>
    <button type="submit" >Зарегистрироваться</button>
	</form>
</main>

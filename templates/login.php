<main>

  <?php $classname = isset($errors) ? "form--invalid" : '';?>

  <form class="form container <?=$classname;?>" action="login.php" method="POST"> <!-- form--invalid -->
    <h2>Вход</h2>

    <?php $classname = isset($errors['email'])? "form__item--invalid": "";
    $value = isset($form['email']) ? $form['email'] : '';
    $errormsg = isset($errors['email']) ? $errors['email'] : "";?>

    <div class="form__item <?=$classname?>"> <!-- form__item--invalid -->
      <label for="email">E-mail</label>
      <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?=$value;?>" >
      <span class="form__error"><?=$errormsg?></span>
    </div>

    <?php $classname = isset($errors['password'])? "form__item--invalid": "";
    $errormsg = isset($errors['password']) ? $errors['password']: "";?>

    <div class="form__item <?=$classname;?>">
      <label for="password">Пароль</label>
      <input id="password" type="password" name="password" placeholder="Введите пароль" >
      <span class="form__error"><?=$errormsg;?></span>
    </div>

    <button type="submit" class="button">Войти</button>

  </form>
</main>

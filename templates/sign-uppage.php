<main>

  <?php $classname = isset($errors)? "form--invalid": "" ?>
  <form class="form container <?=$classname;?>" action="sign-up.php" method="post" enctype="multipart/form-data"> <!-- form--invalid -->
    <h2>Регистрация нового аккаунта</h2>

    <?php $classname = isset($errors['email']) ? "form__item--invalid" : "";
    $value = isset($regdata['email'])? $regdata['email'] : '';
    $errormsg = isset($errors['email']) ? $errors['email'] : ''; ?>

    <div class="form__item <?=$classname; ?>"> <!-- form__item--invalid -->
      <label for="email">E-mail*</label>
      <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?=$value;?>">
      <span class="form__error"><?=$errormsg;?></span>
    </div>

    <?php $classname = isset($errors['password']) ? "form__item--invalid" : "";
    $value = isset($regdata['password'])? $regdata['password'] : '';
    $errormsg = isset($errors['password']) ? $errors['password'] : ''; ?>

    <div class="form__item <?=$classname;?>">
      <label for="password">Пароль*</label>
      <input id="password" type="password" name="password" placeholder="Введите пароль" value="<?=$value;?>" >
      <span class="form__error"><?=$errormsg;?></span>
    </div>

    <?php $classname = isset($errors['name']) ? "form__item--invalid" : "";
    $value = isset($regdata['name'])? $regdata['name'] : '';
    $errormsg = isset($errors['name']) ? $errors['name'] : ''; ?>

    <div class="form__item<?=$classname;?>">
      <label for="name">Имя*</label>
      <input id="name" type="text" name="name" placeholder="Введите имя" value="<?=$value;?>" >
      <span class="form__error"><?=$errormsg;?></span>
    </div>

    <?php $classname = isset($errors['message']) ? "form__item--invalid" : "";
    $value = isset($regdata['message'])? $regdata['message'] : '';
    $errormsg = isset($errors['message']) ? $errors['message'] : ''; ?>

    <div class="form__item <?=$classname;?>">
      <label for="message">Контактные данные*</label>
      <textarea id="message" name="message" placeholder="Напишите как с вами связаться"><?=$value;?></textarea>
      <span class="form__error"><?=$errormsg;?></span>
    </div>

    <?php $classname = isset($errors_avatar['avatar']) ? "form__item--invalid" : "";
    $uploaded = isset($regdata['avatar']) ? "form__item--uploaded" : ""  ?>
    <div class="form__item form__item--file form__item--last <?=$classname;?> <?=$uploaded;?>">
      <label>Аватар</label>
      <div class="preview">
        <button class="preview__remove" type="button">x</button>
        <div class="preview__img">
          <img src="<?=$regdata['avatar']?>" class="img" width="113" height="113" alt="Ваш аватар">
        </div>
      </div>

      <?php $classname = isset($errors_avatar['avatar']) ? "form__item--invalid" : "";
      $errormsg = isset($errors_avatar['avatar']) ? $errors_avatar['avatar'] : ''; ?>
      <div class="form__input-file <?=$classname;?>">
        <input class="visually-hidden" type="file" id="avatar" name="avatar" value="">
        <label for="avatar">
          <span>+ Добавить</span>
        </label>
        <span class="form__error"><?=$errormsg;?></span>
      </div>
    </div>


    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Зарегистрироваться</button>
    <a class="text-link" href="#">Уже есть аккаунт</a>
  </form>
</main>
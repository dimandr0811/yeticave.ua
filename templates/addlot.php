<?php $classname = isset($errors) ? "form--invalid" : ""; ?>

<form class="form form--add-lot container <?=$classname;  ?>" action="add.php" method="POST" enctype="multipart/form-data"> <!-- form--invalid -->
    <h2>Добавление лота</h2>
    <div class="form__container-two">

    <?php $classname = isset($errors['lot-name']) ? "form__item--invalid" : "";
    $value = isset($addlot['lot-name']) ? $addlot['lot-name'] : ""; ?>

      <div class="form__item <?=$classname;?>"> <!-- form__item--invalid -->
        <label for="lot-name">Наименование</label>
        <input id="lot-name" type="text" name="lot-name" placeholder="Введите наименование лота" value = "<?=$value;?>">
        <span class="form__error">Введите наименование формы</span>
      </div>

      <?php $classname = isset($errors['category']) ? "form__item--invalid" : ""; ?>
      <div class="form__item <?=$classname;?>">
        <label for="category">Категория</label>
        <select id="category" name="category" >
          <option>Выберите из списка</option>
          <?php foreach ($CategoriesArr as $value): ?>
            <? if (isset($addlot['category']) && $addlot['category']==$value['cat_name']): ?>
              <option selected><?=$value['cat_name'];?></option>
            <? endif;?>
          <?php endforeach;?>
<!--           <option>Крепления</option>
          <option>Ботинки</option>
          <option>Одежда</option>
          <option>Инструменты</option>
          <option>Разное</option>  -->
        </select>
        <span class="form__error">Выберите категорию</span>
      </div>
    </div>

    <?php $classname = isset($errors['message']) ? "form__item--invalid" : "";
    $value = isset($addlot['message']) ? $addlot['message'] : ""; ?>

    <div class="form__item form__item--wide <?=$classname;?>">
      <label for="message">Описание</label>
      <textarea id="message" name="message" placeholder="Напишите описание лота"><?=$value;?></textarea>
      <span class="form__error">Напишите описание лота</span>
    </div>

    <?php $classname = isset($errors['filename']) ? "form__item--invalid" : "";
    $uploaded = isset($addlot['filename']) ? "form__item--uploaded" : "";
    ?>

    <div class="form__item form__item--file <?=$classname;?> <?=$uploaded;?>"> <!-- form__item--uploaded -->
      <label>Изображение</label>
      <div class="preview">
        <button class="preview__remove" type="button">x</button>
        <div class="preview__img">
          <img src="<?=$addlot['filename']?>" width="113" height="113" alt="Изображение лота">
        </div>
      </div>
      <div class="form__input-file">
        <input class="visually-hidden" type="file" id="filename" name = "filename" value="">
        <label for="filename">
          <span>+ Добавить</span>
        </label>
      </div>
        <?php $errormsg = isset($errors['filename']) ? $errors['filename'] : ''; ?>
    <span class="form__error"><?=$errormsg; ?></span>
    </div>

    <div class="form__container-three">

      <?php $classname = isset($errors['lot-rate']) ? "form__item--invalid" : "";
      $value = isset($addlot['lot-rate']) ? $addlot['lot-rate'] : "";
      $errormsg = isset($errors['lot-rate']) ? $errors['lot-rate'] : ''; ?>

      <div class="form__item form__item--small <?=$classname;?>">
        <label for="lot-rate">Начальная цена</label>
        <input id="lot-rate" type="number" name="lot-rate" placeholder="0" value="<?=$value?>">
        <span class="form__error"><?=$errormsg;?></span>
      </div>

      <?php $classname = isset($errors['lot-step']) ? "form__item--invalid" : "";
          $value = isset($addlot['lot-step']) ? $addlot['lot-step'] : "";
          $errormsg = isset($errors['lot-step']) ? $errors['lot-step'] : ''; ?>

      <div class="form__item form__item--small <?=$classname;?>">
        <label for="lot-step">Шаг ставки</label>
        <input id="lot-step" type="number" name="lot-step" placeholder="0" value="<?=$value;?>">
        <span><?=$errormsg;?></span>
      </div>

      <div class="form__item">
        <label for="lot-date">Дата окончания торгов</label>
        <input class="form__input-date" id="lot-date" type="date" name="lot-date">
        <span class="form__error">Введите дату завершения торгов</span>
      </div>

    </div>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Добавить лот</button>
  </form>

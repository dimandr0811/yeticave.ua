    <section class="lot-item container">
    <?php if(isset($lot)):?>
    <h2><?=$lot['product_name'];?></h2>
    <div class="lot-item__content">
      <div class="lot-item__left">
        <div class="lot-item__image">
          <img src="<?=$lot['URL_picture'];?>" width="730" height="548" alt="<?=$lot['product_name'];?>">
        </div>
        <p class="lot-item__category">Категория: <span><?=$lot['cat_name'];?></span></p>
        <p class="lot-item__category">Автор: <span><?=$lot['user_name'];?></span></p>
        <p class="lot-item__description"><?=$lot['description'];?></p>
      </div>
      <div class="lot-item__right">

        <div class="lot-item__state">
          <div class="lot-item__timer timer">
            10:54:12
          </div>
          <div class="lot-item__cost-state">
            <div class="lot-item__rate">
              <span class="lot-item__amount">Текущая цена</span>
              <span class="lot-item__cost"><?php print(price_format($lot['price']));?></span>
            </div>
          </div>
          <div>
              <span class="lot-item__amount">Рекомендуемый шаг ставки: </span>
              <span class="lot-item__cost"><?php print(price_format($lot['rate']));?></span>
          </div>

          <?php if ($is_auth==true):?>

          <form class="lot-item__form" action="lot.php?lot_id=<?=$lot['product_id']?>" method="post">

          <?php $errormsg = isset($errors['cost']) ? $errors['cost'] : ''; ?>

            <p class="lot-item__form-item">
              <label for="cost">Ваша ставка</label>
              <input id="cost" type="number" name="cost" placeholder="Введите ставку">
            </p>
            <button type="submit" class="button">Сделать ставку</button>
          </form>
          <p style="display: block; font-size: 13px; line-height: 21px; color: red;">
            <label><?=$errormsg;?></label>
          </p>

          <?php endif; ?>

        </div>
        <div class="history">
          <h3>История ставок (<span>10</span>)</h3>
          <table class="history__list">
            <tr class="history__item">
              <td class="history__name">Иван</td>
              <td class="history__price">10 999 р</td>
              <td class="history__time">5 минут назад</td>
            </tr>
            <tr class="history__item">
              <td class="history__name">Константин</td>
              <td class="history__price">10 999 р</td>
              <td class="history__time">20 минут назад</td>
            </tr>
            <tr class="history__item">
              <td class="history__name">Евгений</td>
              <td class="history__price">10 999 р</td>
              <td class="history__time">Час назад</td>
            </tr>
            <tr class="history__item">
              <td class="history__name">Игорь</td>
              <td class="history__price">10 999 р</td>
              <td class="history__time">19.03.17 в 08:21</td>
            </tr>
            <tr class="history__item">
              <td class="history__name">Енакентий</td>
              <td class="history__price">10 999 р</td>
              <td class="history__time">19.03.17 в 13:20</td>
            </tr>
            <tr class="history__item">
              <td class="history__name">Семён</td>
              <td class="history__price">10 999 р</td>
              <td class="history__time">19.03.17 в 12:20</td>
            </tr>
            <tr class="history__item">
              <td class="history__name">Илья</td>
              <td class="history__price">10 999 р</td>
              <td class="history__time">19.03.17 в 10:20</td>
            </tr>
            <tr class="history__item">
              <td class="history__name">Енакентий</td>
              <td class="history__price">10 999 р</td>
              <td class="history__time">19.03.17 в 13:20</td>
            </tr>
            <tr class="history__item">
              <td class="history__name">Семён</td>
              <td class="history__price">10 999 р</td>
              <td class="history__time">19.03.17 в 12:20</td>
            </tr>
            <tr class="history__item">
              <td class="history__name">Илья</td>
              <td class="history__price">10 999 р</td>
              <td class="history__time">19.03.17 в 10:20</td>
            </tr>
          </table>
        </div>
      </div>
    </div>
   <?php else:?>
     <h1 style="color: black">Ошибка 404</h1>
    <?php endif;?>

  </section>

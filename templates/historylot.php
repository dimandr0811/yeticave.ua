

    <section class="lots">
      <h2>История просмотров</h2>
      <ul class="lots__list">
        <?php if(!isset($_COOKIE['history'])){
          echo "<h3>Вы ещё ничего не просматривали</h3>";
        }
        else foreach ($Arr1 as $value) {
          if(in_array($value['product_id'], $history_lot)){?>
 
        <li class="lots__item lot">
          <div class="lot__image">
            <img src="<?=$value['URL_picture'];?>" width="350" height="260" alt="<?=$value['product_name'];?>">
          </div>
          <div class="lot__info">
            <span class="lot__category"><?=$value['cat_name'];?></span>
            <h3 class="lot__title"><a class="text-link" href="lot.php?lot_id=<?=$value['product_id'];?>"><?=$value['product_name']?></a></h3>
            <div class="lot__state">
              <div class="lot__rate">
                <span class="lot__amount">Стартовая цена</span>
                <span class="lot__cost"><?php print(price_format($value['price']));?></span>
              </div>
              <div class="lot__timer timer">
                16:54:12
              </div>
            </div>
          </div>
        </li>
      <?php   } ?>
    <?php } ?>
      </ul>
    </section>

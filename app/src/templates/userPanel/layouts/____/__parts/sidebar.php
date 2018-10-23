<?php
use yii\helpers\Html;

?>
<div class="col-sm-2 no-padding row-eq-height-sm">
  <!-- Бургер-->
  <div id="hamburger" rel="sidebar" class="hamburger">
    <span class="ico-bar"></span>
    <span class="ico-bar"></span>
    <span class="ico-bar"></span>
  </div>
  <!--/ Бургер-->

  <!-- Меню -->
  <div id="sidebar" class="sidebar">
    <div class="sidebar__close">&#10006;</div>

      <?= \app\widgets\userpanel\Userpanel::widget(); ?>

    <div class="menu">
      <div class="menu-block">
        <ul class="menu-block__ul">

          <li class="menu-block__li <?= ( Yii::$app->controller->module->id !=
                                          'user' ) ?: "menu-block__li--active"; ?>">
              <?= Html::a(
                  "Профиль",
                  Yii::$app->homeUrl,
                  [ "class" => "menu-block__a" ]
              ); ?>
          </li>
        </ul>
      </div>

      <!--tosee-->
        <?php if ( Yii::$app->user->can( 'author' ) or Yii::$app->user->can( 'moderator' ) or
                   Yii::$app->user->can( 'administrator' )
        ) { ?>
          <div class="menu-block menu-block--padding-bot">
            <div class="menu-block__img menu-block__img--tosee">
            </div>
            <ul class="menu-block__ul">

                <?php if ( Yii::$app->user->can( 'author' ) ) { ?>
                  <li class="menu-block__li <?= ( Yii::$app->controller->id !=
                                                  'author' ) ?: "menu-block__li--active"; ?>">
                      <?= Html::a(
                          "Редактор",
                          Yii::$app->homeUrl . "/author",
                          [ "class" => "menu-block__a" ]
                      ); ?>
                  </li>
                <?php } ?>

                <?php if ( Yii::$app->user->can( 'moderator' ) ) { ?>
                  <li class="menu-block__li <?= ( Yii::$app->controller->id !=
                                                  'moderator' ) ?: "menu-block__li--active"; ?>">
                      <?= Html::a(
                          "Модератор",
                          Yii::$app->homeUrl . "/moderator",
                          [ "class" => "menu-block__a" ]
                      ); ?>
                  </li>
                <?php } ?>

                <?php if ( Yii::$app->user->can( 'administrator' ) ) { ?>
                  <li class="menu-block__li <?= ( Yii::$app->controller->id !=
                                                  'director' ) ?: "menu-block__li--active"; ?>">
                      <?= Html::a(
                          "Директор",
                          Yii::$app->homeUrl . "/director",
                          [ "class" => "menu-block__a" ]
                      ); ?>
                  </li>
                <?php } ?>
            </ul>
          </div>
        <?php } ?>
      <!--// tosee-->

      <div class="menu-block menu-block--padding-bot">
        <div class="menu-block__img menu-block__img--probank">
        </div>
        <ul class="menu-block__ul">
          <li class="menu-block__li <?= ( Yii::$app->controller->id !=
                                           'photographer' ) ?: "menu-block__li--active"; ?>">
              <?= Html::a(
                  "Фотограф",
                  Yii::$app->homeUrl . "/photographer",
                  [ "class" => "menu-block__a" ]
              ); ?>
          </li>
          <li class="menu-block__li <?= ( Yii::$app->controller->id !=
                                           'model' ) ?: "menu-block__li--active"; ?>">
              <?= Html::a(
                  "Модель",
                  Yii::$app->homeUrl . "/model",
                  [ "class" => "menu-block__a" ]
              ); ?>
          </li>
        </ul>
      </div>

      <div class="menu-block menu-block--padding-bot">
        <div class="menu-block__img menu-block__img--shotme">
        </div>
        <ul class="menu-block__ul">
          <li class="menu-block__li"><a href="/admin/shotme1.html" class="menu-block__a">Меню шотми 1</a>
          </li>
          <li class="menu-block__li"><a href="/admin/shotme2.html" class="menu-block__a">Меню шотми 2</a>
          </li>
        </ul>
      </div>

    </div>
  </div>
  <!--/ Меню -->
</div>
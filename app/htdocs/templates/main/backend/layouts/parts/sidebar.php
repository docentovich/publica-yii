<?php use yii\helpers\Html;
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
        <div class="sidebar__close">X</div>

        <?= components\widgets\userpanel\Userpanel::widget();?>

        <div class="menu">
            <div class="menu-block">
                <ul class="menu-block__ul">
                    <li class="menu-block__li <?= ($this->context->route != 'user/settings/profile') ?: "menu-block__li--active"; ?>">
                        <?= Html::a(
                            "Профиль",
                            Yii::$app->homeUrl,
                            ["class" => "menu-block__a"]
                        ); ?>
                    </li>
                </ul>
            </div>
            <div class="menu-block menu-block--padding-bot">
                <div class="menu-block__img menu-block__img--tosee">
                </div>
                <ul class="menu-block__ul">
                    <li class="menu-block__li <?= ($this->context->route != 'tosee/site/editor') ?: "menu-block__li--active"; ?>">
                        <?= Html::a(
                            "Редактор",
                            Yii::$app->homeUrl . "/editor",
                            ["class" => "menu-block__a"]
                        ); ?>
                    </li>
                    <li class="menu-block__li <?= ($this->context->route != 'tosee/site/moderator') ?: "menu-block__li--active"; ?>">
                        <?= Html::a(
                            "Модератор",
                            Yii::$app->homeUrl . "/moderator",
                            ["class" => "menu-block__a"]
                        ); ?>
                    </li>
                    <li class="menu-block__li <?= ($this->context->route != 'tosee/site/director') ?: "menu-block__li--active"; ?>">
                        <?= Html::a(
                            "Директор",
                            Yii::$app->homeUrl . "/director",
                            ["class" => "menu-block__a"]
                        ); ?>
                    </li>
                </ul>
            </div>
            <?php /*
                    <div class="menu-block menu-block--padding-bot">
                        <div class="menu-block__img menu-block__img--probank">
                        </div>
                        <ul class="menu-block__ul">
                            <li class="menu-block__li"><a href="/admin/fotograf.html" class="menu-block__a">Фотограф</a>
                            </li>
                            <li class="menu-block__li"><a href="/admin/model.html" class="menu-block__a">Модель</a>
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
                    */ ?>
        </div>
    </div>
    <!--/ Меню -->
</div>
<?php use components\helpers\Helpers; ?>
<!-- menu -->
<div class="menu">
    <div class="menu__group">
        <div class="menu__header">События
        </div>
        <div class="menu__content">
            <div class="menu__item">
                <a href="/past.html" class="menu__a">
                    <span class="menu__img"><?= Helpers::i("tosee", "past", ["menu__i"]); ?></span>
                    <span class="menu__text">Что было</span>
                </a>
            </div>
            <div class="menu__item">
                <a href="/future.html" class="menu__a">
                    <span class="menu__img"><?= Helpers::i("tosee", "future", ["menu__i"]); ?></span>
                    <span class="menu__text">Что Будет</span>
                </a>
            </div>
            <div class="menu__item">
                <a href="/dates.html" class="menu__a">
                    <span class="menu__img"><?= Helpers::i("tosee", "calendar", ["menu__i"]); ?></span>
                    <span class="menu__text">Календарь</span>
                </a>
            </div>
        </div>
    </div>
    <?php /*
    <div class="menu__group">
        <div class="menu__header">Конкурсы
        </div>
        <div class="menu__content">
            <div class="menu__item"><a href="#" class="menu__a"><span class="menu__img"><i
                            class="menu__i sprite-img sp-tosee sp-tosee__ico-round"></i></span><span class="menu__text">Мисс tosee</span></a>
            </div>
            <div class="menu__item"><a href="#" class="menu__a"><span class="menu__img"><i
                            class="menu__i sprite-img sp-tosee sp-tosee__ico-round"></i></span><span class="menu__text">Мистер tosee</span></a>
            </div>
            <div class="menu__item"><a href="#" class="menu__a"><span class="menu__img"><i
                            class="menu__i sprite-img sp-tosee sp-tosee__ico-round"></i></span><span class="menu__text">Лучшее фото</span></a>
            </div>
        </div>
    </div>
    */ ?>
</div>
<!--/ menu -->

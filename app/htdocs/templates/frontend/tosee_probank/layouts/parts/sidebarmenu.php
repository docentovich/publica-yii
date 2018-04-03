<?php
use components\helpers\Helpers;
?>
<!-- menu -->
<div class="menu">
    <div class="menu__group">
        <div class="menu__header">События
        </div>
        <div class="menu__content">
            <div class="menu__item">
                <a style="text-decoration: none;" href="/past" class="menu__a">
                    <span class="menu__img"><?= Helpers::i("tosee", "past", ["menu__i"]); ?></span>
                    <span class="menu__text">Что было</span>
                </a>
            </div>
            <div class="menu__item">
                <a style="text-decoration: none;" href="/" class="menu__a">
                    <span class="menu__img"><?= Helpers::i("tosee", "future", ["menu__i"]); ?></span>
                    <span class="menu__text">Что Будет</span>
                </a>
            </div>

            <div class="menu__item"><span rel="modal-container-calendar" animation="six" class="menu__a menu__a_calendar"><span class="menu__img"><i class="menu__i sprite-img sp-tosee sp-tosee__calendar"></i></span><span class="menu__text">Календарь</span></span>
                <div id="modal-container-calendar">
                    <div class="modal-background">
                        <div class="modal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveaspectratio="none" class="modal-svg">
                                <rect x="0" y="0" fill="none" width="100%" height="100%" rx="3" ry="3"></rect>
                            </svg>
                            <div id="calendar" class="menu__calendar">
                            </div>
                        </div>
                    </div>
                </div>
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

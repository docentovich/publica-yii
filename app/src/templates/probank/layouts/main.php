<?php
use app\assets\Asset;
use app\assets\AssetIE9;

$bundle = Asset::register($this);
AssetIE9::register($this);

$this->beginPage(); ?>
<html>
  <head>
    <meta charset="utf-8"/>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <meta content="IE=edge" http-equiv="X-UA-Compatible"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Landing Page</title>
    <link rel="icon" href="/favicon.png" type="image/x-icon"/>
    <!-- CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous"/>
    <!-- --CDN---->
    <?php $this->head() ?>
  </head>
  <body class="pageload">
    <?php $this->beginBody() ?>
    <header>
        <div id="header-inner">
            <div class="navigation-panel">
                <div class="navigation-part">
                    <div class="menu">
                        <div class="hamburger toggle-overlay" id="service-menu" rel="service-menu"><img src="<?= $bundle->baseUrl; ?>/images/icons/burger.svg"/></div>
                        <div class="toggle-drop-down-action-panel base-logo" id="services" rel="services"><img src="<?= $bundle->baseUrl; ?>/images/logo-inline/probank.svg"/></div>
                    </div>
                </div>
                <div class="navigation-part">
                    <div class="controls">
                        <div class="toggle-drop-down-action-panel control" id="search" rel="search"><i class="icon-search"></i></div>
                        <div class="toggle-drop-down-action-panel control" id="geo" rel="geo"><i class="icon-geo"></i></div>
                        <div class="toggle-drop-down-action-panel control" id="enter" rel="enter"><a href="http://user-panel.shablonkin.shn-host.ru/"><i class="icon-enter"></i></a></div>
                    </div>
                </div>
            </div>
            <div class="action-panel toggle-overlay" id="drop-down-geo" rel="geo">
                <div class="action-panel-control"><i class="icon-geo"></i><span>Орел. Russia</span></div>
            </div>
            <div class="action-panel" id="drop-down-search">
                <div class="action-panel-control">
                    <div id="search-placeholder"><i class="icon-search"></i><span>Найти на сайте</span></div>
                    <input type="text" value="" id="search-input" rel="search"/>
                </div>
            </div>
            <div class="action-panel" id="drop-down-services"><a class="drop-down-service" href="http://publica.shablonkin.shn-host.ru/">
                    <div class="drop-down-service-image drop-down-service--publica"><img src="<?= $bundle->baseUrl; ?>/images/logo-inline/publica.svg"/></div>
                    <div class="drop-down-service-description"></div></a><a class="drop-down-service" href="http://tosee.shablonkin.shn-host.ru/">
                    <div class="drop-down-service-image drop-down-service--tosee"><img src="<?= $bundle->baseUrl; ?>/images/logo-inline/tosee.svg"/></div>
                    <div class="drop-down-service-description">События</div></a><a class="drop-down-service" href="http://shotme.shablonkin.shn-host.ru/">
                    <div class="drop-down-service-image drop-down-service--shootme"><img src="<?= $bundle->baseUrl; ?>/images/logo-inline/shootme.svg"/></div>
                    <div class="drop-down-service-description">Фотографы</div></a>
            </div>
        </div>
    </header>
    <div class="overlay" id="geo-overlay">
        <ul class="overlay-list">
            <li>Москва</li>
            <li>Санкт-Петербург</li>
            <li>Орел</li>
            <li>Хацапетовка</li>
            <li>Ньюйорк</li>
            <li>Токио</li>
            <li>Вырица</li>
            <li>Орел</li>
            <li>Хацапетовка</li>
            <li>Ньюйорк</li>
            <li>Токио</li>
            <li>Вырица</li>
        </ul>
    </div>
    <div class="overlay" id="search-overlay">
        <ul class="overlay-list">
            <li>
                В Лондоне объяснили условия
                въезда Абрамовича по
                израильскому гражданству
            </li>
            <li>
                Лавров рассекретил
                переговоры Путина и Обамы по
                Украине в 2014 году
            </li>
            <li>
                В аэропорту Лондона на
                12 часов был задержан ребенок
                из России
            </li>
            <li>
                Шарапова вышла во
                второй круг Roland Garros
            </li>
            <li>
                Саакашвили привал ЕС
                ввести санкции против
                Порошенко: будет некуда бежать
            </li>
            <li>
                Экс-главу Котельников
                доставили в суд
            </li>
        </ul>
    </div>
    <div class="overlay" id="service-menu-overlay">
        <div class="service-overlay-wrapper">
            <ul class="probank-menu">
                <li>Модели</li>
                <li>Фотографы</li>
            </ul>
        </div>
    </div>
    <div class="content-wrapper">
        <div class="content">
            <div id="waiting"><i class="fa fa-spinner fa-spin"></i></div>
            <script>pageType = 'POSTS';</script>
            <div class="members masonry">
                <div class="grid-sizer"></div>
                <div class="gutter-sizer"></div>
                <div class="item-member item-masonry" style="display: none"><a href="/member.html"><img src="<?= $bundle->baseUrl; ?>/images/members/2.jpg"/>
                        <div class="member-description">
                            <div class="member-name">Анастасия</div>
                            <div class="member-type">Модель</div>
                        </div></a></div>
                <div class="item-member item-masonry" style="display: none"><a href="/member.html"><img src="<?= $bundle->baseUrl; ?>/images/members/3.jpg"/>
                        <div class="member-description">
                            <div class="member-name">Анастасия</div>
                            <div class="member-type">Фотограф</div>
                        </div></a></div>
                <div class="item-member item-masonry" style="display: none"><a href="/member.html"><img src="<?= $bundle->baseUrl; ?>/images/members/4.jpg"/>
                        <div class="member-description">
                            <div class="member-name">Анастасия</div>
                            <div class="member-type">Модель</div>
                        </div></a></div>
                <div class="item-member item-masonry" style="display: none"><a href="/member.html"><img src="<?= $bundle->baseUrl; ?>/images/members/5.jpg"/>
                        <div class="member-description">
                            <div class="member-name">Анастасия</div>
                            <div class="member-type">Фотограф</div>
                        </div></a></div>
                <div class="item-member item-masonry" style="display: none"><a href="/member.html"><img src="<?= $bundle->baseUrl; ?>/images/members/6.jpg"/>
                        <div class="member-description">
                            <div class="member-name">Анастасия</div>
                            <div class="member-type">Модель</div>
                        </div></a></div>
                <div class="item-member item-masonry" style="display: none"><a href="/member.html"><img src="<?= $bundle->baseUrl; ?>/images/members/2.jpg"/>
                        <div class="member-description">
                            <div class="member-name">Анастасия</div>
                            <div class="member-type">Модель</div>
                        </div></a></div>
                <div class="item-member item-masonry" style="display: none"><a href="/member.html"><img src="<?= $bundle->baseUrl; ?>/images/members/3.jpg"/>
                        <div class="member-description">
                            <div class="member-name">Анастасия</div>
                            <div class="member-type">Фотограф</div>
                        </div></a></div>
                <div class="item-member item-masonry" style="display: none"><a href="/member.html"><img src="<?= $bundle->baseUrl; ?>/images/members/4.jpg"/>
                        <div class="member-description">
                            <div class="member-name">Анастасия</div>
                            <div class="member-type">Модель</div>
                        </div></a></div>
                <div class="item-member item-masonry" style="display: none"><a href="/member.html"><img src="<?= $bundle->baseUrl; ?>/images/members/5.jpg"/>
                        <div class="member-description">
                            <div class="member-name">Анастасия</div>
                            <div class="member-type">Фотограф</div>
                        </div></a></div>
                <div class="item-member item-masonry" style="display: none"><a href="/member.html"><img src="<?= $bundle->baseUrl; ?>/images/members/6.jpg"/>
                        <div class="member-description">
                            <div class="member-name">Анастасия</div>
                            <div class="member-type">Модель</div>
                        </div></a></div>
                <div class="item-member item-masonry" style="display: none"><a href="/member.html"><img src="<?= $bundle->baseUrl; ?>/images/members/2.jpg"/>
                        <div class="member-description">
                            <div class="member-name">Анастасия</div>
                            <div class="member-type">Модель</div>
                        </div></a></div>
                <div class="item-member item-masonry" style="display: none"><a href="/member.html"><img src="<?= $bundle->baseUrl; ?>/images/members/3.jpg"/>
                        <div class="member-description">
                            <div class="member-name">Анастасия</div>
                            <div class="member-type">Фотограф</div>
                        </div></a></div>
                <div class="item-member item-masonry" style="display: none"><a href="/member.html"><img src="<?= $bundle->baseUrl; ?>/images/members/4.jpg"/>
                        <div class="member-description">
                            <div class="member-name">Анастасия</div>
                            <div class="member-type">Модель</div>
                        </div></a></div>
                <div class="item-member item-masonry" style="display: none"><a href="/member.html"><img src="<?= $bundle->baseUrl; ?>/images/members/5.jpg"/>
                        <div class="member-description">
                            <div class="member-name">Анастасия</div>
                            <div class="member-type">Фотограф</div>
                        </div></a></div>
                <div class="item-member item-masonry" style="display: none"><a href="/member.html"><img src="<?= $bundle->baseUrl; ?>/images/members/6.jpg"/>
                        <div class="member-description">
                            <div class="member-name">Анастасия</div>
                            <div class="member-type">Модель</div>
                        </div></a></div>
            </div>
        </div>
    </div>
    <!-- CDN-->
    <script
            src="https://code.jquery.com/jquery-2.2.4.min.js"
            integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
            crossorigin="anonymous"></script>
    <script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>
    <!-- --CDN---->
    <?php $this->endBody() ?>
  </body>
</html>
<?php $this->endPage() ?>
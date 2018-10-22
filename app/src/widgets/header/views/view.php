<header>
    <div id="header-inner">
        <div class="navigation-panel">
            <div class="navigation-part">
                <div class="menu">
                    <div class="hamburger toggle-overlay" id="service-menu" rel="service-menu">
                        <img src="<?= $bundle->baseUrl; ?>/images/icons/burger.svg"/>
                    </div>
                    <div class="toggle-drop-down-action-panel base-logo" id="services" rel="services">
                        <img src="<?= $bundle->baseUrl; ?>/images/logo-inline/tosee.svg"/>
                    </div>
                </div>
            </div>
            <div class="navigation-part">
                <div class="controls">
                    <div class="toggle-drop-down-action-panel control" id="search" rel="search">
                        <i class="icon-search"></i>
                    </div>
                    <div class="toggle-drop-down-action-panel control" id="geo" rel="geo">
                        <i class="icon-geo"></i>
                    </div>
                    <div class="toggle-drop-down-action-panel control" id="enter" rel="enter">
                        <a href="/admin">
                            <i class="icon-enter"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="action-panel toggle-overlay" id="drop-down-geo" rel="geo">
            <div class="action-panel-control">
                <i class="icon-geo"></i><span>Орел. Russia</span>
            </div>
        </div>
        <div class="action-panel" id="drop-down-search">
            <div class="action-panel-control">
                <div id="search-placeholder"><i class="icon-search"></i>
                    <span>Найти на сайте</span></div>
                <input type="text" value="" id="search-input" rel="search"/>
            </div>
        </div>
        <div class="action-panel" id="drop-down-services">
            <a class="drop-down-service"  href="http://publica.shablonkin.shn-host.ru/">
                <div class="drop-down-service-image drop-down-service--publica">
                    <img src="<?= $bundle->baseUrl; ?>/images/logo-inline/publica.svg"/>
                </div>
                <div class="drop-down-service-description"></div>
            </a>
            <a class="drop-down-service" href="http://probank.shablonkin.shn-host.ru/">
                <div class="drop-down-service-image drop-down-service--probank">
                    <img src="<?= $bundle->baseUrl; ?>/images/logo-inline/probank.svg"/></div>
                <div class="drop-down-service-description">Модели</div>
            </a>
            <a class="drop-down-service" href="http://shotme.shablonkin.shn-host.ru/">
                <div class="drop-down-service-image drop-down-service--shootme">
                    <img src="<?= $bundle->baseUrl; ?>/images/logo-inline/shootme.svg"/></div>
                <div class="drop-down-service-description">Фотографы</div>
            </a>
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
<?= $content; ?>
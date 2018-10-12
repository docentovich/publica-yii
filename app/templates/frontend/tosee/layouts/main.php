<?php
use app\assets\FrontendAsset;
use app\assets\FrontendAssetIE9;

$bundle = FrontendAsset::register($this);
FrontendAssetIE9::register($this);

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
              <div class="hamburger toggle-overlay" id="service-menu" rel="service-menu"><img src="/images/icons/burger.svg"/></div>
              <div class="toggle-drop-down-action-panel base-logo" id="services" rel="services"><img src="/images/logo-inline/tosee.svg"/></div>
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
            <div class="drop-down-service-image drop-down-service--publica"><img src="/images/logo-inline/publica.svg"/></div>
            <div class="drop-down-service-description"></div></a><a class="drop-down-service" href="http://probank.shablonkin.shn-host.ru/">
            <div class="drop-down-service-image drop-down-service--probank"><img src="/images/logo-inline/probank.svg"/></div>
            <div class="drop-down-service-description">Модели</div></a><a class="drop-down-service" href="http://shotme.shablonkin.shn-host.ru/">
            <div class="drop-down-service-image drop-down-service--shootme"><img src="/images/logo-inline/shootme.svg"/></div>
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
        <ul class="tosee-menu">
          <li>Что было?</li>
          <li>Что будет?</li>
          <li>Календарь</li>
        </ul>
      </div>
    </div>
    <div class="content-wrapper">
      <div class="content">
        <div id="waiting"><i class="fa fa-spinner fa-spin"></i></div>
        <div class="posts masonry">
          <div class="grid-sizer"></div>
          <div class="gutter-sizer"></div>
          <div class="item-post item-masonry" style="display: none"><a href="/post.html"><img src="/images/posts/2.jpg"/>
              <div class="post-description">1 концерт софии ротару</div></a></div>
          <div class="item-post item-masonry" style="display: none"><a href="/post.html"><img src="/images/posts/3.jpg"/>
              <div class="post-description">2 концерт софии ротару</div></a></div>
          <div class="item-post item-masonry" style="display: none"><a href="/post.html"><img src="/images/posts/4.jpg"/>
              <div class="post-description">3 концерт софии ротару, концерт софии ротару, концерт софии ротару, концерт софии ротару, </div></a></div>
          <div class="item-post item-masonry" style="display: none"><a href="/post.html"><img src="/images/posts/5.jpg"/>
              <div class="post-description">4 концерт софии ротару</div></a></div>
          <div class="item-post item-masonry" style="display: none"><a href="/post.html"><img src="/images/posts/6.jpg"/>
              <div class="post-description">5 концерт софии ротару</div></a></div>
          <div class="item-post item-masonry" style="display: none"><a href="/post.html"><img src="/images/posts/2.jpg"/>
              <div class="post-description">6 концерт софии ротару</div></a></div>
          <div class="item-post item-masonry" style="display: none"><a href="/post.html"><img src="/images/posts/3.jpg"/>
              <div class="post-description">7 концерт софии ротару</div></a></div>
          <div class="item-post item-masonry" style="display: none"><a href="/post.html"><img src="/images/posts/4.jpg"/>
              <div class="post-description">8 концерт софии ротару, концерт софии ротару, концерт софии ротару, концерт софии ротару, </div></a></div>
          <div class="item-post item-masonry" style="display: none"><a href="/post.html"><img src="/images/posts/5.jpg"/>
              <div class="post-description">9 концерт софии ротару</div></a></div>
          <div class="item-post item-masonry" style="display: none"><a href="/post.html"><img src="/images/posts/6.jpg"/>
              <div class="post-description">10 концерт софии ротару</div></a></div>
          <div class="item-post item-masonry" style="display: none"><a href="/post.html"><img src="/images/posts/2.jpg"/>
              <div class="post-description">11 концерт софии ротару</div></a></div>
          <div class="item-post item-masonry" style="display: none"><a href="/post.html"><img src="/images/posts/3.jpg"/>
              <div class="post-description">12 концерт софии ротару</div></a></div>
          <div class="item-post item-masonry" style="display: none"><a href="/post.html"><img src="/images/posts/4.jpg"/>
              <div class="post-description">13 концерт софии ротару, концерт софии ротару, концерт софии ротару, концерт софии ротару, </div></a></div>
          <div class="item-post item-masonry" style="display: none"><a href="/post.html"><img src="/images/posts/5.jpg"/>
              <div class="post-description">14 концерт софии ротару</div></a></div>
          <div class="item-post item-masonry" style="display: none"><a href="/post.html"><img src="/images/posts/6.jpg"/>
              <div class="post-description">15 концерт софии ротару</div></a></div>
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
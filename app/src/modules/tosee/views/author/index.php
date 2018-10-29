
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
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css"/>
    <!-- --CDN---->
    <!-- vendor--><link href='/bundle/vendor-a7d91a50ce.css' media='all' rel='stylesheet' type='text/css'/>
    <!-- --vendor---->
    <!-- custom-->
    <link href="/css/main.css" rel="stylesheet"/>
    <link href="/widgets/header/css/index.css" rel="stylesheet"/>
    <!-- --custom---->
  </head>
  <body class="pageload">
    <header>
      <div id="header-inner">
        <div class="navigation-panel">
          <div class="navigation-part">
            <div class="menu">
              <div class="hamburger toggle-overlay" id="service-menu" rel="service-menu"><i class="icon-burger"></i></div>
              <div class="toggle-drop-down-action-panel base-logo" id="services" rel="services"><img src="/images/logo-inline/publica.svg"/></div>
            </div>
          </div>
          <div class="navigation-part">
            <div class="controls">
              <div class="toggle-drop-down-action-panel control" id="search" rel="search"><i class="icon-search"></i></div>
              <div class="toggle-drop-down-action-panel control" id="geo" rel="geo"><i class="icon-geo"></i></div>
              <div class="toggle-drop-down-action-panel control" id="enter" rel="enter"><a href="http://localhost:8003/"><i class="icon-enter"></i></a></div>
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
        <div class="action-panel" id="drop-down-services"><a class="drop-down-service" href="http://localhost:8001/">
            <div class="drop-down-service-image drop-down-service--tosee"><img src="/images/logo-inline/tosee.svg"/></div>
            <div class="drop-down-service-description">События</div></a><a class="drop-down-service" href="http://localhost:8002/">
            <div class="drop-down-service-image drop-down-service--probank"><img src="/images/logo-inline/probank.svg"/></div>
            <div class="drop-down-service-description">Модели</div></a><a class="drop-down-service" href="http://localhost:8003/">
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
    <div class="overlay overlay--user-panel" id="service-menu-overlay">
      <div class="service-overlay-wrapper">
        <ul class="user-panel-menu">
          <li><a href="/profile.html">Профиль</a></li>
          <li><a href="/my/comments.html">Мои комментарии</a></li>
          <li><a href="/my/orders.html">Мои заказы</a></li>
          <li><a href="/my/calendar.html">Мой календарь</a></li>
          <li><a href="/my/rating.html">Мой рейтинг</a></li>
          <li><a href="/roles/journalist.html">Журналист</a></li>
          <li><a href="/roles/model.html">Модель</a></li>
          <li><a href="/roles/photographer.html">Фотораф</a></li>
        </ul><a class="feedback" href="#"><span>Обратная связь</span><span class="small">(сообщение в администрацию сайта)</span></a>
      </div>
    </div>
    <div class="content">
      <div class="role">
        <div class="user-avatar-name">
          <div class="user-name">Журналист Иван Петров</div>
          <div class="user-avatar dark-icon"><i class="fa fa-user"></i></div>
        </div>
        <div class="role-actions"><a href="/add-article.html">Добавить статью</a><a href="/my/articles.html">Мои стать</a></div>
      </div>
    </div>
    <!-- CDN-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js" integrity="sha256-tW5LzEC7QjhG0CiAvxlseMTs2qJS7u3DRPauDjFJ3zo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.ru.min.js" integrity="sha256-iGDUwn2IPSzlnLlVeCe3M4ZIxQxjUoDYdEO6oBZw/Go=" crossorigin="anonymous"></script>
    <!-- --CDN---->
    <!-- vendor--><script src='/bundle/vendor-ce6da7a36b.js' type='text/javascript'></script>
    <!-- --vendor---->
    <!-- custom-->
    <script src="/js/main.js"></script>
    <script src="/widgets/header/js/index.js"></script>
    <!-- --custom---->
  </body>
</html>
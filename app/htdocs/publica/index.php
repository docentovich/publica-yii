<?php
if($_SERVER['REQUEST_URI'] !== '/')
{
    http_response_code (404);
    die("404");
}
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8"/>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <meta content="IE=edge" http-equiv="X-UA-Compatible"/>
    <meta name="viewport" content="width=1350, initial-scale=1, maximun-scale=5, user-scalable=no"/>
    <title>Landing Page</title>
    <link rel="icon" href="/favicon.png" type="image/x-icon"/>
    <!-- build:css /css/vendor.css    -->
    <!-- endbuild-->
    <!-- build:css /css/main.css-->
    <link href="/css/main.css" rel="stylesheet"/>
    <!-- endbuild -->
    <!--[if lte IE 9]>
    <![endif]
    
    -->
  </head>
  <body class="pageload no-js"><!-- content-home -->
    <div class="content-home">
      <div class="content-home__wrapper">
        <div class="content-home__mainlogo"><img src="/images/logos/publica.png" class="content-home__i content-home__i_mainlogo" alt="" role="presentation"/>
        </div>
        <div class="content-home__projects-row"><!-- project --> <a href="http://tosee.shablonkin.shn-host.ru/" class="project project_tosee"><span class="project__logo"><img src="/images/logos/tosee.png" class="project__i" alt="" role="presentation"/></span><span class="project__content"><img src="/images/dep.png" class="project__img" alt="" role="presentation"/><span class="project__text">Светская жизнь в моем городе, стране, мире</span></span></a><!--/ project --> <!-- project --> <a href="http://probank.shablonkin.shn-host.ru/" class="project project_probank"><span class="project__logo"><img src="/images/logos/probank.png" class="project__i" alt="" role="presentation"/></span><span class="project__content"><img src="/images/model.png" class="project__img" alt="" role="presentation"/><span class="project__text">Модели Фотографы Актеры</span></span></a><!--/ project --> <!-- project -->
          <a href="http://shotme.shablonkin.shn-host.ru/" class="project project_shotme">
            <div class="project__logo"><img src="/images/logos/shotme.png" class="project__i" alt="" role="presentation"/>
            </div>
            <div class="project__content"><img src="/images/fotografer.png" class="project__img" alt="" role="presentation"/>
              <div class="project__text">Закажи  фотографа прямо сейчас!
              </div>
            </div>
          </a><!--/ project -->
        </div>
      </div>
    </div><!--/ content-home -->
    <!--+footer1-->
    <script src="https://use.fontawesome.com/9371c6073a.js"></script>
    <!-- build:js /js/vendor.js  -->
    <!-- endbuild-->
    <!-- build:js /js/main.js-->
    <script src="/js/main.js"></script>
    <!-- endbuild-->
  
  </body>
</html>
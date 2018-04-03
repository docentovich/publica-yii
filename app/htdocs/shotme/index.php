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
    <script src="/libs/ie/html5shiv.js"></script>
    <script src="/libs/ie/respond.src.js"></script>
    <script src="/libs/ie/respond.matchmedia.addListener.src.js"></script>
    <script src="/libs/polyfills/background_size_emu.js"></script>
    <![endif]
    
    -->
  </head>
  <body class="pageload no-js"><!-- content-home --> 
    <div class="content-home">
      <div class="content-home__wrapper">
        <div class="content-home__projects-row"><!-- project --> 
          <div class="project project_shotme">
            <div class="project__logo"><img src="/images/logos/shotme.png" class="project__i" alt="" role="presentation"/>
            </div>
            <div class="project__content"><img src="/images/fotografer.png" class="project__img" alt="" role="presentation"/>
              <div class="project__text">Закажи  фотографа прямо сейчас!
              </div>
            </div>
          </div><!--/ project --> 
        </div>
      </div>
    </div><!--/ content-home --> <!-- footer1 --> 
    <div class="footer1">
      <div class="container-fluid">
        <div class="row">
          <div class="col-xs-24">
            <div class="footer1__copiright">© 2017 Copyrights Копирайты
            </div>
          </div>
        </div>
      </div>
    </div><!--/ footer1 --> 
    <script src="/libs/jquery.min.js"></script>
    <script src="https://use.fontawesome.com/9371c6073a.js"></script>
    <!-- build:js /js/vendor.js  -->
    <script src="/libs/bootstrap.min.js"></script>
    <script src="/libs/jquery-ui.js"></script>
    <!--script(src='/libs/jquery-migrate-3.0.0.min.js')-->
    <script src="/libs/jquery.mousewheel-3.0.6.pack.js"></script>
    <script src="/libs/fancybox/jquery.fancybox.js"></script>
    <script src="/libs/modernizr-custom.js"></script>
    <script src="/libs/polyfills/placeholders.min.js"></script>
    <!-- endbuild-->
    <!-- build:js /js/main.js-->
    <script src="/js/main.js"></script>
    <!-- endbuild-->
    <script src="/js/sidebar.js"></script>
    <script src="/js/header_dd.js"></script>
  </body>
</html>
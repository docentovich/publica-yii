<?php

/* @var $this yii\web\View */

$this->title = 'Что было';
?>
  <div class="sidebar" id="menu">
      <div class="sidebar__sidebar-inner-relative">
        <div class="sidebar__close">X
        </div>
        <div class="sidebar__sidebar-inner"><!-- menu --> 
          <div class="menu">
            <div class="menu__group">
              <div class="menu__header">События
              </div>
              <div class="menu__content">
                <div class="menu__item"><a href="/past.html" class="menu__a"><span class="menu__img"><i class="menu__i sprite-img sp-tosee sp-tosee__past"></i></span><a href="/past/1.html" class="menu__text">Что было</a></a>
                </div>
                <div class="menu__item"><a href="/future.html" class="menu__a"><span class="menu__img"><i class="menu__i sprite-img sp-tosee sp-tosee__future"></i></span><a href="/future/1.html" class="menu__text">Что Будет</a></a>
                </div>
                <div class="menu__item"><a href="/dates.html" class="menu__a"><span class="menu__img"><i class="menu__i sprite-img sp-tosee sp-tosee__calendar"></i></span><span class="menu__text">Календарь</span></a>
                </div>
              </div>
            </div>
            <div class="menu__group">
              <div class="menu__header">Конкурсы                
              </div>
              <div class="menu__content">
                <div class="menu__item"><a href="#" class="menu__a"><span class="menu__img"><i class="menu__i sprite-img sp-tosee sp-tosee__ico-round"></i></span><span class="menu__text">Мисс tosee</span></a>
                </div>
                <div class="menu__item"><a href="#" class="menu__a"><span class="menu__img"><i class="menu__i sprite-img sp-tosee sp-tosee__ico-round"></i></span><span class="menu__text">Мистер tosee</span></a>
                </div>
                <div class="menu__item"><a href="#" class="menu__a"><span class="menu__img"><i class="menu__i sprite-img sp-tosee sp-tosee__ico-round"></i></span><span class="menu__text">Лучшее фото</span></a>
                </div>
              </div>
            </div>
          </div><!--/ menu --> 
        </div>
      </div>
    </div><!--/ sidebar --> <!-- sidebar --> 
    <div class="sidebar sidebar_search" id="search">
      <div class="sidebar__sidebar-inner-relative">
        <div class="sidebar__close">X
        </div>
        <div class="sidebar__sidebar-inner"><!-- search-form --> 
          <form class="search-form"><input placeholder="Что ищем ?.." class="search-form__input" type="text"/>
            <div class="search-form__loopa"><img src="/images/svg/zoom1.svg" class="search-form__svg" alt="" role="presentation"/>
            </div>
          </form><!--/ search-form --> 
        </div>
      </div>
    </div><!--/ sidebar --> <!-- header --> 
    <div class="header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-xs-24"><a href="/" class="header__logo"><i class="header__i sprite-img sp-sprite sp-sprite__publica"></i></a>
            <div class="header__controls"><!-- controls --> 
              <div class="controls">
                <div class="controls__control">
                  <div class="controls__lang"><i class="controls__i sprite-img sp-sprite sp-sprite__flagrus"></i>
                  </div>
                </div>
                <div class="controls__control">
                  <div class="controls__city"><i class="controls__i sprite-img sp-sprite sp-sprite__city"></i>
                  </div>
                </div>
                <div class="controls__control"><a href="/admin/enter.html" class="controls__enter"><i class="controls__i sprite-img sp-sprite sp-sprite__enter"></i></a>
                </div>
              </div><!--/ controls --> 
            </div>
          </div>
        </div>
      </div>
    </div><!--/ header --> <!-- header1 --> 
    <div class="header1">
      <div class="container-fluid">
        <div class="row">
          <div class="col-xs-24"><img src="/images/logo.png" class="header1__logo" alt="" role="presentation"/>
            <div class="header1__controls1"><!-- controls1 --> 
              <div class="controls1">
                <div rel="menu" class="controls1__conrol1">
                  <div class="controls1__img-wrapper"><img src="/images/svg/hamburger1.svg" class="controls1__img" alt="" role="presentation"/>
                  </div>
                </div>
                <div rel="search" class="controls1__conrol1">
                  <div class="controls1__img-wrapper"><img src="/images/svg/zoom1.svg" class="controls1__img controls1__img_zoom" alt="" role="presentation"/>
                  </div>
                </div>
              </div><!--/ controls1 --> 
            </div>
          </div>
        </div>
      </div>
    </div><!--/ header1 --> <!-- content --> 
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-xs-24"><!-- navigation --> 
            <div class="navigation">               
              <div class="navigation__col navigation__col_center">Что было
              </div><a href="/future/1.html" class="navigation__col navigation__col_left"><span class="navigation__svg-wrapper"><img src="/images/svg/ar-left-w.svg" class="navigation__svg" alt="" role="presentation"/></span></a><a href="/future/1.html" class="navigation__col navigation__col_right"><span class="navigation__svg-wrapper"><img src="/images/svg/ar-right-w.svg" class="navigation__svg" alt="" role="presentation"/></span></a>
            </div><!--/ navigation --> 
          </div>
        </div><!-- events --> 
        <div class="events">
          <div class="row">
            <div class="events__events-list">
              <div class="events__event"><!-- event --> 
                <div class="event">
                  <div class="event__image-wrap"><a href="/post"><i style="background-image: url(/images/people/dep.jpg)" class="event__img img-well"></i></a>
                    <div class="event__date">25.12.17
                    </div>
                  </div>
                  <div class="event__content"><a href="/post" class="event__title">H1 Поста. Джонни Депп.</a>
                    <div class="event__description">Даль журчит по всей стране и обеспечивает ее всеми необходимыми правилами. Эта парадигматическая страна, в которой жаренные члены предложения залетают прямо в рот.
                    </div>
                  </div>
                </div><!--/ event --> 
              </div>
              <div class="events__event"><!-- event --> 
                <div class="event">
                  <div class="event__image-wrap"><a href="/post"><i style="background-image: url(/images/people/baba.jpg)" class="event__img img-well"></i></a>
                    <div class="event__date">25.12.17
                    </div>
                  </div>
                  <div class="event__content"><a href="/post" class="event__title">H1 Поста. Джонни Депп.</a>
                    <div class="event__description">Даль журчит по всей стране и обеспечивает ее всеми необходимыми правилами. Эта парадигматическая страна, в которой жаренные члены предложения залетают прямо в рот.
                    </div>
                  </div>
                </div><!--/ event --> 
              </div>
              <div class="events__event"><!-- event --> 
                <div class="event">
                  <div class="event__image-wrap"><a href="/post"><i style="background-image: url(/images/people/keri.jpg)" class="event__img img-well"></i></a>
                    <div class="event__date">25.12.17
                    </div>
                  </div>
                  <div class="event__content"><a href="/post" class="event__title">H1 Поста. Джонни Депп.</a>
                    <div class="event__description">Даль журчит по всей стране и обеспечивает ее всеми необходимыми правилами. Эта парадигматическая страна, в которой жаренные члены предложения залетают прямо в рот.
                    </div>
                  </div>
                </div><!--/ event --> 
              </div>
              <div class="events__event"><!-- event --> 
                <div class="event">
                  <div class="event__image-wrap"><a href="/post"><i style="background-image: url(/images/people/dep.jpg)" class="event__img img-well"></i></a>
                    <div class="event__date">25.12.17
                    </div>
                  </div>
                  <div class="event__content"><a href="/post" class="event__title">H1 Поста. Джонни Депп.</a>
                    <div class="event__description">Даль журчит по всей стране и обеспечивает ее всеми необходимыми правилами. Эта парадигматическая страна, в которой жаренные члены предложения залетают прямо в рот.
                    </div>
                  </div>
                </div><!--/ event --> 
              </div>
              <div class="events__event"><!-- event --> 
                <div class="event">
                  <div class="event__image-wrap"><a href="/post"><i style="background-image: url(/images/people/baba.jpg)" class="event__img img-well"></i></a>
                    <div class="event__date">25.12.17
                    </div>
                  </div>
                  <div class="event__content"><a href="/post" class="event__title">H1 Поста. Джонни Депп.</a>
                    <div class="event__description">Даль журчит по всей стране и обеспечивает ее всеми необходимыми правилами. Эта парадигматическая страна, в которой жаренные члены предложения залетают прямо в рот.
                    </div>
                  </div>
                </div><!--/ event --> 
              </div>
              <div class="events__event"><!-- event --> 
                <div class="event">
                  <div class="event__image-wrap"><a href="/post"><i style="background-image: url(/images/people/keri.jpg)" class="event__img img-well"></i></a>
                    <div class="event__date">25.12.17
                    </div>
                  </div>
                  <div class="event__content"><a href="/post" class="event__title">H1 Поста. Джонни Депп.</a>
                    <div class="event__description">Даль журчит по всей стране и обеспечивает ее всеми необходимыми правилами. Эта парадигматическая страна, в которой жаренные члены предложения залетают прямо в рот.
                    </div>
                  </div>
                </div><!--/ event --> 
              </div>
            </div>
          </div>
        </div><!--/ events --> 
        <div class="row">
          <div class="col-xs-24"><!-- pagination --> 
            <div class="pagination">       
              <div class="pagination__item"><!-- pagination-item --> <a href="" class="pagination-item pagination-item_disabled"><</a><!--/ pagination-item --> 
              </div>
              <div class="pagination__item"><!-- pagination-item --> <a href="" class="pagination-item pagination-item_disabled pagination-item_active">1</a><!--/ pagination-item --> 
              </div>
              <div class="pagination__item"><!-- pagination-item --> <a href="/past/2.html" class="pagination-item">2</a><!--/ pagination-item --> 
              </div>
              <div class="pagination__item"><!-- pagination-item --> <a href="/past/3.html" class="pagination-item">3</a><!--/ pagination-item --> 
              </div>
              <div class="pagination__item"><!-- pagination-item --> <a href="/past/4.html" class="pagination-item">4</a><!--/ pagination-item --> 
              </div>
              <div class="pagination__item"><!-- pagination-item --> <a href="/past/5.html" class="pagination-item">5</a><!--/ pagination-item --> 
              </div>
              <div class="pagination__dots">...
              </div>
              <div class="pagination__item"><!-- pagination-item --> <a href="/past/2.html" class="pagination-item">></a><!--/ pagination-item --> 
              </div>
            </div><!--/ pagination --> 
          </div>
        </div>
      </div>
    </div><!--/ content --> 
<!-- footer --> 
<div class="footer">
  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-24">
        <div class="footer__footer-inner">
          <div class="footer__logo footer__logo_tosee"><i class="footer__i sprite-img sp-sprite sp-sprite__tosee-grey"></i>
          </div>
          <div class="footer__logo footer__logo_probank"><i class="footer__i sprite-img sp-sprite sp-sprite__probank-grey"></i>
          </div>
          <div class="footer__logo footer__logo_shotme"><i class="footer__i sprite-img sp-sprite sp-sprite__shotme-grey"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div><!--/ footer --> <!-- footer1 --> 
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
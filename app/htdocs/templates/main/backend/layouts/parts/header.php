<? echo \components\widgets\header\Header::widget(["logo" => "publica"]);  ?>
<div class="clearfix"></div>
<div class="body container-fluid no-padding">
    <?php /*
    <div class="hidden-sidebar hidden-sidebar--lang" id="hslang">
        <div class="hidden-sidebar__close">X
        </div>
        <div class="lang">
            <div id="lang-dd" class="lang__drop-down">
                <div class="lang__drop-down-inner">
                    <div class="lang__lang-ico lang__lang-ico--flagrus">
                    </div>
                    <div class="lang__text">Русский
                    </div>
                </div>
            </div>
            <div id="lang-dd-ul" style="display: none;" class="lang__drop-down-ul"><ul>
                    <li rel="en" class="lang__li">
                        <div class="lang__drop-down-inner">
                            <div class="lang__lang-ico lang__lang-ico--england">
                            </div>
                            <div class="lang__text">Englesh
                            </div>
                        </div>
                    </li>
                    <li rel="de" class="lang__li">
                        <div class="lang__drop-down-inner">
                            <div class="lang__lang-ico lang__lang-ico--de">
                            </div>
                            <div class="lang__text">Deutch
                            </div>
                        </div>
                    </li>
                    <li rel="esp" class="lang__li">
                        <div class="lang__drop-down-inner">
                            <div class="lang__lang-ico lang__lang-ico--espanol">
                            </div>
                            <div class="lang__text">Español
                            </div>
                        </div>
                    </li>
                    <li rel="fr" class="lang__li">
                        <div class="lang__drop-down-inner">
                            <div class="lang__lang-ico lang__lang-ico--french">
                            </div>
                            <div class="lang__text">Le français
                            </div>
                        </div>
                    </li>
                    <li rel="port" class="lang__li">
                        <div class="lang__drop-down-inner">
                            <div class="lang__lang-ico lang__lang-ico--porto">
                            </div>
                            <div class="lang__text">Português
                            </div>
                        </div>
                    </li>
                    <li rel="it" class="lang__li">
                        <div class="lang__drop-down-inner">
                            <div class="lang__lang-ico lang__lang-ico--italy">
                            </div>
                            <div class="lang__text">Italiano
                            </div>
                        </div>
                    </li>
            </div>
        </div>
    </div>
    */ ?>
    <!-- Сайдбар города-->
    <div class="hidden-sidebar hidden-sidebar--city" id="hscity">
        <div class="hidden-sidebar__close">X</div>
        <div class="city">
            <div id="city-dd" class="city__drop-down">
                <div class="city__city-text">
                    Выберете ваш город
                </div>
                <div class="city__city-ico"></div>
            </div>
            <div id="city-dd-ul" style="display: none" class="city__drop-down-ul"><ul>
                    <li rel="null" class="city__li">&nbsp</li>
                    <li rel="spb" class="city__li">Спб</li>
                    <li rel="msk" class="city__li">Мск</li>
            </div>
        </div>
    </div>
    <!--/ Сайдбар города-->

    <div class="row-eq-height-sm">
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
                <div class="userpan">
                    <img src="<?= $bundle->baseUrl; ?>/images/tema.png" class="userpan__img" alt="" role="presentation"/>
                    <div class="userpan__name">Темка</div>
                </div>
                <div class="menu">
                    <div class="menu-block">
                        <ul class="menu-block__ul">
                            <li class="menu-block__li">
                                <a href="/admin/userpanel.html" class="menu-block__a">Профиль</a>
                            </li>
                        </ul>
                    </div>
                    <div class="menu-block menu-block--padding-bot">
                        <div class="menu-block__img menu-block__img--tosee">
                        </div>
                        <ul class="menu-block__ul">
                            <li class="menu-block__li menu-block__li--active">
                                <a href="/admin/redactor.html" class="menu-block__a">Редактор</a>
                            </li>
                            <li class="menu-block__li">
                                <a href="/admin/moderator.html" class="menu-block__a">Модератор</a>
                            </li>
                            <li class="menu-block__li">
                                <a href="/admin/director.html" class="menu-block__a">Директор</a>
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
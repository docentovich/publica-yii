<?php
use modules\tosee\widgets\sidebar\Sidebar;

echo \components\widgets\header\Header::widget(["logo" => "publica"]); //верхняя плашечка. она едина для всех частейы
?>
<!-- header1 -->
<div class="header1">
    <div class="container container-header">
        <div class="row">
            <div class="col-xs-24">
                <a href="/">
                    <img src="<?= $bundle->baseUrl; ?>/images/logo.png" class="header1__logo" alt=""
                         role="presentation"/>
                </a>

                <div class="header1__controls1">
                    <!-- controls1 -->
                    <div class="controls1">
                        <div rel="menu" class="controls1__conrol1 sidebar-open">

                            <div class="controls1__img-wrapper ">

                                <svg class="controls1__img" xmlns="http://www.w3.org/2000/svg" id="Capa_1" data-name="Capa 1" viewBox="0 0 274.36 228.86"><defs><style>.cls-1{fill:#fff}</style></defs><title>hamburger1</title><rect class="cls-1" width="274.36" height="57.11" rx="7.5" ry="7.5"/><rect class="cls-1" y="85.87" width="274.36" height="57.11" rx="7.5" ry="7.5"/><rect class="cls-1" y="171.75" width="274.36" height="57.11" rx="7.5" ry="7.5"/></svg>

                            </div>
                        </div>
                        <div rel="search" class="controls1__conrol1 sidebar-open">
                            <div class="controls1__img-wrapper ">
<!--                                <object preserveAspectRatio="xMinYMin none" data="--><?//= $bundle->baseUrl; ?><!--/images/svg/zoom1.svg"-->
<!--                                     class="controls1__img controls1__img_zoom"></object>-->
                                <svg  class="controls1__img controls1__img_zoom" xmlns="http://www.w3.org/2000/svg" id="Capa_1" data-name="Capa 1" viewBox="0 0 399.22 395.02"><defs><style>.cls-1{fill:#fff}</style></defs><title>zoom1</title><path class="cls-1" d="M18.51 343.63l123.86-122.68a35.45 35.45 0 0 1 24.45-10.24A129.14 129.14 0 0 1 183 46.37c51.25-50.69 134.64-50.69 185.89 0a129.14 129.14 0 0 1 0 183.85c-45.1 44.61-115.09 49.95-166.16 16a34.69 34.69 0 0 1-10.35 24.18L68.56 393.13a35.67 35.67 0 0 1-50 0 34.73 34.73 0 0 1-.05-49.5zm193.13-141.69c35.48 35.09 93.21 35.09 128.69 0a89.4 89.4 0 0 0 0-127.28c-35.48-35.09-93.21-35.09-128.69 0a89.4 89.4 0 0 0 0 127.28z" transform="translate(-8.15 -8.36)"/></svg>

                            </div>
                        </div>
                    </div>
                    <!--/ controls1 -->
                </div>

                <?php Sidebar::begin(["id" => "menu"]); ?>
                <?php require_once "sidebarmenu.php"; ?>
                <?php Sidebar::end(); ?>

                <?php Sidebar::begin(["id" => "search", "modif" => "search"]); ?>
                <?php require_once "sidebarsearch.php"; ?>
                <?php Sidebar::end(); ?>
            </div>
        </div>
    </div>
</div>

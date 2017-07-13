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
                                <img src="<?= $bundle->baseUrl; ?>/images/svg/hamburger1.svg" class="controls1__img"
                                     alt=""
                                     role="presentation"/>

                            </div>
                        </div>
                        <div rel="search" class="controls1__conrol1 sidebar-open">
                            <div class="controls1__img-wrapper ">
                                <img src="<?= $bundle->baseUrl; ?>/images/svg/zoom1.svg"
                                     class="controls1__img controls1__img_zoom" alt=""
                                     role="presentation"/>

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

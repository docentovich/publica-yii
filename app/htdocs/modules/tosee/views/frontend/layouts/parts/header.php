<?
use components\views\widgets\sidebar\Sidebar;
echo \components\views\widgets\header\Header::widget(["logo" => "publica"]); //верхняя плашечка. она едина для всех частейы
?>
<!-- header1 -->
<div class="header1">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-24">
                <img src="<?= $bundle->baseUrl; ?>/images/logo.png" class="header1__logo" alt="" role="presentation"/>

                <div class="header1__controls1"><!-- controls1 -->
                    <div class="controls1">
                        <div rel="menu" class="controls1__conrol1">

                            <div class="controls1__img-wrapper">
                                <img src="<?= $bundle->baseUrl; ?>/images/svg/hamburger1.svg" class="controls1__img" alt=""
                                     role="presentation"/>

                            </div>
                        </div>
                        <div rel="search" class="controls1__conrol1">
                            <div class="controls1__img-wrapper">
                                <img src="<?= $bundle->baseUrl; ?>/images/svg/zoom1.svg" class="controls1__img controls1__img_zoom" alt=""
                                     role="presentation"/>

                            </div>
                        </div>
                    </div><!--/ controls1 -->
                </div>

                <? Sidebar::begin(["id" => "menu"]); ?>
                <? require_once "sidebarmenu.php"; ?>
                <? Sidebar::end(); ?>

                <? Sidebar::begin(["id" => "search", "modif" => "sidebar_search"]); ?>
                <? require_once "sidebarsearch.php"; ?>
                <? Sidebar::end(); ?>
            </div>
        </div>
    </div>
</div>
<!--/ header1 -->
<?
use app\components\Sidebar;

echo \app\components\Header::widget(["logo" => "publica"]); //верхняя плашечка. она едина для всех частейы
?>
<!-- header1 -->
<div class="header1">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-24">
                <img src="/images/logo.png" class="header1__logo" alt="" role="presentation"/>

                <div class="header1__controls1"><!-- controls1 -->
                    <div class="controls1">
                        <div rel="menu" class="controls1__conrol1">

                            <div class="controls1__img-wrapper">
                                <img src="/images/svg/hamburger1.svg" class="controls1__img" alt=""
                                     role="presentation"/>
                                <? Sidebar::begin(["id" => "menu"]); ?>
                                <? require_once "sidebarmenu.php"; ?>
                                <? Sidebar::end(); ?>
                            </div>
                        </div>
                        <div rel="search" class="controls1__conrol1">
                            <div class="controls1__img-wrapper">
                                <img src="/images/svg/zoom1.svg" class="controls1__img controls1__img_zoom" alt=""
                                     role="presentation"/>
                                <? Sidebar::begin(["id" => "search"]); ?>
                                <? require_once "sidebarserch.php"; ?>
                                <? Sidebar::end(); ?>
                            </div>
                        </div>
                    </div><!--/ controls1 -->
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ header1 -->
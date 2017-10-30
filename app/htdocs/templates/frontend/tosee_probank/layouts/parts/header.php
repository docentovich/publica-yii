<?php
use components\widgets\sidebar\Sidebar;

echo \components\widgets\header\Header::widget(); //верхняя плашечка. она едина для всех частейы
?>
<div data-spy="affix" data-offset-top="10">
  <!-- header1 -->
  <div class="header1">
    <div class="container container-header">
      <div class="row">
        <div class="header1__inner col-xs-24">
          <div rel="search"  class="header1__item header1__item_control  sidebar-rel">
            <i class="header1__i fa fa-search"></i>
          </div>
          <div class="header1__item header1__item_logo">
            <img src="<?= $bundle->baseUrl; ?>/images/logos/tosee.png"
                                                             class="header1__logo" alt="" role="presentation"/>
          </div>
          <div rel="menu" class="header1__item header1__item_control sidebar-rel">
            <i class="header1__i fa fa-bars"></i>
          </div>


        </div>
      </div>
    </div>
  </div>
  <!--/ header1 -->
</div>

<?php Sidebar::begin(["id" => "menu"]); ?>
<?php require_once "sidebarmenu.php"; ?>
<?php Sidebar::end(); ?>

<?php Sidebar::begin(["id" => "search", "modif" => "search"]); ?>
<?php require_once "sidebarsearch.php"; ?>
<?php Sidebar::end(); ?>
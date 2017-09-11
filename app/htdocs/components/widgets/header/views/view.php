<?php
use yii\helpers\Html;
use components\helpers\Helpers;
use components\widgets\header\HeaderAsset;
use modules\tosee\widgets\sidebar\Sidebar;

/**
 * Самая верхняя плашечка
 * @var string $logo Логотип текущего модуля
 * @var array $cities Массив городов
 * @var int $current_city_id Текущий ИД города
 */
$bundle = HeaderAsset::register($this);
?>

<!-- header-dd -->
<div class="header-dd">
  <div class="container container-header">
    <div class="row">
      <div class="header-dd__inner col-xs-24">
        <div class="header-dd__item">
          <div class="header-dd__item-inner header-dd__item-inner_small-fz-item"><i class="header-dd__i fa fa-language"></i>
          </div>
          <div class="header-dd__item-label">Язык
          </div>
        </div>
        <div class="header-dd__item">
          <div class="header-dd__item-inner"><i class="header-dd__i fa fa-map-marker"></i>
          </div>
          <div class="header-dd__item-label">Город
          </div>
        </div>
        <div rel="menu" class="header-dd__item sidebar-rel">
          <div class="header-dd__item-inner"><i class="header-dd__i fa fa-sign-in"></i>
          </div>
          <div class="header-dd__item-label">Вход
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="header-dd__globe">
    <div class="header-dd__globe-inner"><i class="header-dd__i-globe fa fa-globe"></i>
    </div>
  </div>
</div>
<!--/ header-dd -->

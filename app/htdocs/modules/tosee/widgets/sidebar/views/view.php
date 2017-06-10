<?php
use modules\tosee\widgets\sidebar\SidebarAssets;
SidebarAssets::register($this);

if(!empty($modif)) $modif = "sidebar-swipe_".$modif;
?>
<!-- sidebar -->
<div class="sidebar-swipe <?=$modif?>" id="<?= $id ?>">
    <div class="sidebar-swipe__sidebar-inner-relative">
        <div class="sidebar-swipe__close">&#10006;</div>
        <div class="sidebar-swipe__sidebar-inner">
            <?= $content ?>
        </div>
    </div>
</div>
<!--/ sidebar -->

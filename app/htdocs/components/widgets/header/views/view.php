<?
use yii\helpers\Html;
use components\helpers\Helpers;
use components\widgets\header\HeaderAsset;
use modules\tosee\widgets\sidebar\Sidebar;

$bundle = HeaderAsset::register($this);
?>
<div class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-24">
                <?= Html::a(Helpers::i("sprite", $logo, ["header__i"]), "/", ["class" => "header__logo"]); ?>
                <?php //<a href="/" class="header__logo"><i class="header__i sprite-img sp-sprite sp-sprite__publica"></i></a> ?>
                <div class="header__controls"><!-- controls -->
                    <div class="controls">

                        <div class="controls__control">
                            <div class="controls__lang">
                                &nbsp;
                               <?php // <i class="controls__i sprite-img sp-sprite sp-sprite__flagrus"></i> ?>
                            </div>
                        </div>
                        <div class="controls__control">
                            <div class="controls__city " >
                                <img class="controls__i  sidebar-open" rel="city" src="<?= $bundle->baseUrl ?>/images/route.svg" type=""></img>
                            </div>
                        </div>

                        <?php
                        if (Yii::$app->user->isGuest) {
                            ?>
                            <div class="controls__control">
                                <?php
                                echo Html::a(
                                    Helpers::i("sprite", "enter", ["header__i"]), "/admin", ["class" => "controls__i"],
                                    ["class" => "controls__enter"]
                                );

                                ?>
                            </div>
                            <?php

                        } else {
                            echo Html::beginForm(['/user/security/logout'], 'post');
                            echo Html::submitButton(
                                'Выход (' . Yii::$app->user->identity->username . ')',
                                ['class' => 'btn-link logout', "style" => "color: white"]
                            );
                            echo Html::endForm();
                        }
                        ?>
                        <? //<a href="/admin/enter.html" class="controls__enter"><i class="controls__i sprite-img sp-sprite sp-sprite__enter"></i></a> ?>
                    </div>
                </div>
                <!--/ controls -->
            </div>
        </div>
    </div>
</div>
<?php Sidebar::begin(["id" => "city", "modif" => "search"]); ?>
<?php require_once "sidebarcity.php"; ?>
<?php Sidebar::end(); ?>
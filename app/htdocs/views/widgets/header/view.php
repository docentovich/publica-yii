<?
use yii\helpers\Html;
use Helpers\Helpers;

?>
<div class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-24">
                <?= Html::a(Helpers::i("sprite", $logo, ["header__i"]), "/", ["class" => "header__logo"]); ?>
                <? //<a href="/" class="header__logo"><i class="header__i sprite-img sp-sprite sp-sprite__publica"></i></a> ?>
                <div class="header__controls"><!-- controls -->
                    <div class="controls">
                        <? /*
                        <div class="controls__control">
                            <div class="controls__lang">
                                <i class="controls__i sprite-img sp-sprite sp-sprite__flagrus"></i>
                            </div>
                        </div>
                        <div class="controls__control">
                            <div class="controls__city">
                                <i class="controls__i sprite-img sp-sprite sp-sprite__city"></i>
                            </div>
                        </div>*/ ?>
                        <div class="controls__control">
                            <?
                            if (Yii::$app->user->isGuest) {
                                Html::a( Helpers::i("sprite", "enter", ["header__i"]) , "/backend", ["class" => "header__logo header__logo"]);
                            } else {
                                echo Html::beginForm(['/site/logout'], 'post');
                                echo Html::submitButton(
                                    'Logout (' . Yii::$app->user->identity->username . ')',
                                    ['class' => 'btn btn-link logout']
                                );
                                echo Html::endForm();
                            }
                            ?>
                            <? //<a href="/admin/enter.html" class="controls__enter"><i class="controls__i sprite-img sp-sprite sp-sprite__enter"></i></a> ?>
                        </div>
                    </div><!--/ controls -->
                </div>
            </div>
        </div>
    </div>
</div><!--/ header -->
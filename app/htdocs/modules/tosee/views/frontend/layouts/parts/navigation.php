<div class="row">
    <div class="col-xs-24">
        <!-- navigation -->
        <div class="navigation">
            <div class="navigation__col navigation__col_center"><?= Yii::$app->view->params['navigation_label'] ?></div>
            <a href="<?= Yii::$app->view->params['prev_url'] ?>" class="navigation__col navigation__col_left">
                <span class="navigation__svg-wrapper">
                    <img src="<?= $bundle->baseUrl; ?>/images/svg/ar-left-w.svg" class="navigation__svg" alt="" role="presentation"/>
                </span>
            </a>
            <a href="<?= Yii::$app->view->params['next_url'] ?>" class="navigation__col navigation__col_right">
                <span class="navigation__svg-wrapper">
                    <img src="<?= $bundle->baseUrl; ?>/images/svg/ar-right-w.svg" class="navigation__svg" alt="" role="presentation"/>
                </span>
            </a>
        </div>
        <!--/ navigation -->
    </div>
</div>

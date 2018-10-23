<div class="row">
    <div class="col-xs-24">
        <!-- navigation -->
        <div class="navigation">
            <div class="navigation__col navigation__col_center"><?= Yii::$app->view->params['navigation_label'] ?></div>

            <?php if (isset(Yii::$app->view->params['next_url'])) { ?>

                <a href="<?= Yii::$app->view->params['prev_url'] ?>" class="navigation__col navigation__col_left">
                <span class="navigation__svg-wrapper">
                    <span class="navigation__svg">
                          <svg id="Layer_1" xmlns="http://www.w3.org/2000/svg" data-name="Layer 1"
                               viewBox="0 0 94.12 168.42">
                            <path d="M279.6,163.5a9.9,9.9,0,0,0-14,0l-74.3,74.3a9.9,9.9,0,0,0,0,14l74.3,74.3a9.9,9.9,0,0,0,14-14l-67.3-67.3,67.3-67.3A10,10,0,0,0,279.6,163.5Z"
                                  transform="translate(-188.4 -160.6)" class="cls-1"></path>
                          </svg>
                    </span>
                </span>
                </a>

            <?php } ?>

            <?php if (isset(Yii::$app->view->params['next_url'])) { ?>

                <a href="<?= Yii::$app->view->params['next_url'] ?>" class="navigation__col navigation__col_right">
                <span class="navigation__svg-wrapper">
                    <span class="navigation__svg">
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 94.12 168.42">
                            <path d="M210,326.1a9.9,9.9,0,0,0,14,0l74.3-74.3a9.9,9.9,0,0,0,0-14L224,163.5a9.9,9.9,0,0,0-14,14l67.3,67.3L210,312.1A10,10,0,0,0,210,326.1Z"
                                  transform="translate(-207.08 -160.57)" class="cls-1"></path>
                          </svg>
                    </span>
                </span>
                </a>

            <?php } ?>
        </div>
        <!--/ navigation -->
    </div>
</div>

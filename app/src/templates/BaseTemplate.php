<?php

namespace app\templates;


use yii\web\AssetBundle;
use yii\web\View;

class BaseTemplate
{
    /** @var View */
    private $view;
    /** @var AssetBundle */
    private $bundle;

    public function __construct(View $view, AssetBundle $bundle)
    {
        $this->view = $view;
        $this->bundle = $bundle;
        CommonAsset::register($view);
        ob_start();
    }

    public function end()
    {
        $content = ob_get_clean();

        ob_start();
        ?>
        <?php $this->view->beginPage(); ?>
        <html lang="<?= \Yii::$app->language ?>">
        <head>
            <meta charset="<?= \Yii::$app->charset ?>">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <?= \yii\helpers\Html::csrfMetaTags() ?>
            <title><?= \yii\helpers\Html::encode($this->view->title) ?></title>
            <script>
                var language = '<?= \Yii::$app->language; ?>';
                var lang = '<?= \Yii::$app->language; ?>';
            </script>
            <?php $this->view->head() ?>
        </head>
        <body class="pageload">
        <?php $this->view->beginBody() ?>

        <div class="main-wrapper">
            <?= $content ?>
        </div>

        <?php $this->view->endBody() ?>
        </body>
        </html>
        <?php $this->view->endPage() ?>
        <?php

        return ob_get_clean();
    }
}
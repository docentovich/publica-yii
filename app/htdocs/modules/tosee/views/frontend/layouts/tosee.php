<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

// use yii\bootstrap\Nav;
// use yii\bootstrap\NavBar;
// use yii\widgets\Breadcrumbs;
use modules\tosee\assets\frontend\AppAsset;
use modules\tosee\assets\frontend\AppAssetIE9;
use app\components\Header;

// use common\widgets\Alert;

$bundle = AppAsset::register($this);
AppAssetIE9::register($this);
?>
<?php $this->beginPage(); ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <script>
            var queryDate = '<?= Yii::$app->view->params['current_date'] ?? date("Y-m-d"); ?>';
        </script>
    </head>


    <body class="pageload no-js">
    <?php $this->beginBody() ?>

    <?php require_once "parts/header.php"; ?>

    <!-- content -->
    <div class="content">
        <div class="container-fluid">
            <?php require_once "parts/navigation.php"; ?>
            <?= $content ?>
            <?php require_once "parts/pagination.php"; ?>
        </div>
    </div>
    <!--/ content -->

    <?php require_once "parts/footer.php"; ?>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>
<?php

namespace tosee;

use app\services\BaseSearchService;
use tosee\controllers\AuthorController;
use tosee\controllers\FrontPostController;
use tosee\services\ToseeImagesService;
use tosee\services\ToseePostService;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap ( $app )
    {
        $app->urlManagerFrontEnd->addRules(ToseeUrls::frontUrls());
        \Yii::$container->setSingleton('PostService', [
            'class' => ToseePostService::class,
            'searchService' => \Yii::$container->get('SearchService')
        ]);
        \Yii::$container->set(FrontPostController::class, [
            'imagesService' => \Yii::$container->get('ImagesService'),
            'postService' => \Yii::$container->get('PostService'),
        ]);
        \Yii::$container->set(AuthorController::class, [
            'postService' => \Yii::$container->get('PostService'),
        ]);
    }
}
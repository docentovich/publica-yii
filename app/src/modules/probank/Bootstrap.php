<?php

namespace probank;

use probank\controllers\FrontSpecialistsController;
use probank\controllers\ModelController;
use probank\controllers\OrdersController;
use probank\controllers\PhotographerController;
use probank\services\ProbankImagesService;
use probank\services\ProbankSpecialistsService;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        $app->urlManagerFrontEnd->addRules(ProbankUrls::frontUrls());


        \Yii::$container->setSingleton('SpecialistsService', [
            'class' => ProbankSpecialistsService::class,
            'searchService' => \Yii::$container->get('SearchService')
        ]);

        $specialistsService = \Yii::$container->get('SpecialistsService');
        \Yii::$container->setDefinitions([
            PhotographerController::class => ['specialistsService' => $specialistsService],
            FrontSpecialistsController::class => [
                'specialistsService' => $specialistsService,
                'imagesService' => \Yii::$container->get('ImagesService')
            ],
            ModelController::class => ['specialistsService' => $specialistsService],
            PhotographerController::class => ['specialistsService' => $specialistsService],
            OrdersController::class => [
                'specialistsService' => $specialistsService,
                'ordersService' => $specialistsService = \Yii::$container->get('ordersService')
            ]
        ]);
    }
}
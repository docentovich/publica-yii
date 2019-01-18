<?php

namespace shootme;

use shootme\controllers\FrontController;
use shootme\controllers\OrdersController;
use shootme\services\ShootmeSpecialistsService;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap ( $app )
    {
        $app->urlManagerFrontEnd->addRules(ShootmeUrls::frontUrls());


        \Yii::$container->setSingleton('SpecialistsService', [
            'class' => ShootmeSpecialistsService::class,
            'searchService' => \Yii::$container->get('SearchService')
        ]);

        $specialistsService = \Yii::$container->get('SpecialistsService');
        \Yii::$container->setDefinitions([
            FrontController::class => [
                'specialistsService' => $specialistsService,
                'imagesService' => \Yii::$container->get('ImagesService')
            ],
            OrdersController::class => [
                'specialistsService' => $specialistsService,
                'ordersService' => $specialistsService = \Yii::$container->get('ordersService')
            ]
        ]);
    }
}
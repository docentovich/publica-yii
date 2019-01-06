<?php

namespace probank;

use probank\controllers\FrontSpecialistsController;
use probank\controllers\ModelController;
use probank\controllers\PhotographerController;
use probank\services\ProbankImagesService;
use probank\services\ProbankSpecialistsService;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap ( $app )
    {
        $app->urlManagerFrontEnd->addRules(ProbankUrls::frontUrls());

        \Yii::$container->setSingleton('SpecialistsService', [
            'class' => ProbankSpecialistsService::class,
            'searchService' => \Yii::$container->get('SearchService')
        ]);

        \Yii::$container->set(PhotographerController::class, [
            'specialistsService' => \Yii::$container->get('SpecialistsService'),
        ]);
        \Yii::$container->set(FrontSpecialistsController::class, [
            'specialistsService' => \Yii::$container->get('SpecialistsService'),
        ]);
        \Yii::$container->set(ModelController::class, [
            'specialistsService' => \Yii::$container->get('SpecialistsService'),
        ]);
    }
}
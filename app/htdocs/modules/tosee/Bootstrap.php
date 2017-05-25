<?php
namespace modules\tosee;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        $app->getUrlManager()->addRules(
            [
                // объявление правил здесь
                '' => 'tosee/site/index',
                'tosee/<action:\w+>/<id:\w+>' => 'tosee/site/<action>'
            ]
        );
    }
}
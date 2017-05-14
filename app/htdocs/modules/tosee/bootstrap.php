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
                '' => 'tosee/default/index',
                '<_a:(about|contacts)>' => 'tosee/site/<_a>'
            ]
        );
    }
}
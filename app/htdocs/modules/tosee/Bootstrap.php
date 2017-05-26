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
                '<page:\d+>'                                                                  => 'tosee/site/index',
                '<date:[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])>'              => 'tosee/site/date',
                '<date:[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])>/<page:\d+>'   => 'tosee/site/date',
                'past'                                                                        => 'tosee/site/past',
                'past/<page:\d+>'                                                             => 'tosee/site/index',
                '<action:\w+>/<id:\d+>'                                                       => 'tosee/site/<action>'
            ]
        );
    }
}